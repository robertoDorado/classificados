<?php
require_once "config.php";
class Anuncios {

    public function getUltimosAnuncios($page, $perPage){
        global $pdo;

        $offset = ($page - 1) * $perPage;

        $array = array();
        $sql = $pdo->prepare("SELECT *, (select anuncios_imagens.url from
        anuncios_imagens where anuncios_imagens.id_anuncios = anuncios.id limit 1) as url,
        (select categorias.nome from
        categorias where categorias.id = anuncios.id_categoria) as categoria  
        FROM anuncios ORDER BY id DESC limit $offset, $perPage");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getMeusAnuncios() {
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("SELECT *, (select anuncios_imagens.url from
        anuncios_imagens where anuncios_imagens.id_anuncios = anuncios.id limit 1) as url 
        FROM anuncios WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $_SESSION["cLogin"]);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function addAnuncios($titulo, $valor, $descricao, $categoria, $estado){
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("INSERT INTO anuncios SET titulo = :titulo, valor = :valor,
        descricao = :descricao, estado = :estado, id_categoria = :id_categoria,
        id_usuario = :id_usuario");
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":estado", $estado);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":id_usuario", $_SESSION["cLogin"]);
        $sql->execute();
    }

    public function editAnuncios($titulo, $valor, $descricao, $categoria, $estado, $fotos, $id){
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("UPDATE anuncios SET titulo = :titulo, valor = :valor,
        descricao = :descricao, estado = :estado, id_categoria = :id_categoria,
        id_usuario = :id_usuario WHERE id = :id");
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":estado", $estado);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":id_usuario", $_SESSION["cLogin"]);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if(count($fotos) > 0){
            for($q=0;$q<count($fotos['tmp_name']);$q++){
                $tipo = $fotos['type'][$q];
                if(in_array($tipo, array('image/jpeg', 'image/png'))){
                    $tmpname = md5(time().rand(0,9999)).'.jpg';
                    move_uploaded_file($fotos['tmp_name'][$q],
                    'assets/images/anuncios/'.$tmpname);
                    
                    list($width_orig, $height_orig) = getimagesize(
                    'assets/images/anuncios/'.$tmpname);
                    $ratio = $width_orig/$height_orig;

                    $width = 500;
                    $height = 500;

                    if($width/$height > $ratio){
                        $width = $height * $ratio;
                    }else{
                        $height = $width/$ratio;
                    }

                    $img = imagecreatetruecolor($width, $height);
                    if($tipo == 'image/jpeg'){
                        $origin = imagecreatefromjpeg('assets/images/anuncios/'.$tmpname);
                    }elseif($tipo == 'image/png'){
                        $origin = imagecreatefrompng('assets/images/anuncios/'.$tmpname);
                    }

                    imagecopyresampled($img, $origin, 0, 0, 0, 0, $width, $height,
                    $width_orig, $height_orig);

                    imagejpeg($img, 'assets/images/anuncios/'.$tmpname, 80);

                    $sql = $pdo->prepare("INSERT INTO anuncios_imagens SET 
                    id_anuncios = :id_anuncios, url = :url");
                    $sql->bindValue(":id_anuncios", $id);
                    $sql->bindValue(":url", $tmpname);
                    $sql->execute();
            }
        }
    }
}

    public function deletarAnuncio($id){
        global $pdo;
        $sql = $pdo->prepare("DELETE FROM anuncios_imagens WHERE id_anuncios = :id_anuncios");
        $sql->bindValue(":id_anuncios", $id);
        $sql->execute();

        $sql = $pdo->prepare("DELETE FROM anuncios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function excluirFoto($id){
        global $pdo;

        $id_anuncio = 0;

        $sql = $pdo->prepare("SELECT id_anuncios FROM anuncios_imagens WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id_anuncio = $row['id_anuncios'];
        }

        $sql = $pdo->prepare("DELETE FROM anuncios_imagens WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $id_anuncio;

    }

    public function getAnuncio($id){
        $array = array();
        global $pdo;

        $sql = $pdo->prepare("SELECT *,
        (select categorias.nome from
        categorias where categorias.id = anuncios.id_categoria) as categoria,
        (select usuarios.telefone from
        usuarios where usuarios.id = anuncios.id_usuario) as telefone
        FROM anuncios WHERE id = :id");
        $sql->bindValue("id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
            $array['fotos'] = array();

            $sql = $pdo->prepare("SELECT id, url FROM anuncios_imagens WHERE
            id_anuncios = :id_anuncios");
            $sql->bindValue("id_anuncios", $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array['fotos'] = $sql->fetchAll();
            }

        }
        return $array;
    }

    public function getTotalAnuncios(){
        global $pdo;

        $sql = $pdo->query("SELECT COUNT(*) as c FROM anuncios");
        $row = $sql->fetch();

        return $row['c'];
    }

}