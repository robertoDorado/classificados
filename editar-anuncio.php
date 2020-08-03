<?php 
require_once "classes/anuncios.class.php";
require_once "pages/header.php";
if(empty($_SESSION["cLogin"])){
    header("Location: login.php");
}
?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php 
    require_once "classes/anuncios.class.php";
    $anuncios = new Anuncios();
    if(isset($_POST["titulo"]) && !empty($_POST["titulo"])){
        $titulo = addslashes($_POST["titulo"]);
        $valor = addslashes($_POST["valor"]);
        $descricao = utf8_encode(addslashes($_POST["descricao"]));
        $categoria = addslashes($_POST["categoria"]);
        $estado = addslashes($_POST["estado"]);
        if(isset($_FILES['fotos'])){
            $fotos = $_FILES['fotos'];
        }else{
            $array = array();
        }
        
        $anuncios->editAnuncios($titulo, $valor, $descricao, $categoria, $estado, $fotos, $_GET['id']);
    }
    
?>

<?php
    if(isset($_GET['id']) && empty($_GET['id']) == false){
        $info = $anuncios->getAnuncio($_GET['id']);
    }
?>


<div class="container">
    <h1>Meus anuncios - Editar Anuncios</h1>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
                <?php
                require_once "classes/categorias.class.php";
                $novasCategorias = new Categorias();
                $categorias = $novasCategorias->getLista();
                foreach($categorias as $categoria){
                    ?>
                    <option <?php
                    echo ($info['id_categoria'] == $categoria["id"])? 'selected="selected"':''; 
                    ?> 
                    value="<?php echo $categoria["id"];?>"><?php echo utf8_encode($categoria["nome"]);?>
                    </option>

                    
                    
                    
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $info['titulo']?>">
        </div>

        <div class="form-group">
            <label for="titulo">Valor:</label>
            <input data-js="dinheiro" id="dinheiro" type="text" class="dinheiro form-control" value="<?php echo $info['valor']?>"  name="valor">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea type="text" class="form-control" name="descricao"><?php echo utf8_decode($info['descricao']);?></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="categoria" class="form-control">
                <option value="0" <?php echo ($info['estado'] == 0)? 'selected="selected"':''?>>Ruim</option>
                <option value="1" <?php echo ($info['estado'] == 1)? 'selected="selected"':''?>>Bom</option>
                <option value="2" <?php echo ($info['estado'] == 2)? 'selected="selected"':'' ?>>Ótimo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="add_foto">Fotos do Anúncio:</label>
            <input type="file" name="fotos[]" multiple style="padding-bottom:40px;"><br><br>
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Fotos do Anúncio</h5>
                    <?php foreach($info['fotos'] as $foto):?>
                        <div class="foto_item">
                            <img src="assets/images/anuncios/<?php echo $foto['url'];?>"
                            class="img-thumbnail"><br>

                            <a class="btn btn-danger" style="padding:10px 10px 10px 10px;" href="excluir-foto.php?id=<?php echo $foto["id"];?>">Excluir Imagem</a>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>

      <input type="submit" value="Salvar">

    </form>
        
    <br>

        <?php
        if(isset($_POST['titulo']) && empty($_POST['titulo']) == false){
            ?>
            <div class="alert alert-success">Produto Editado com sucesso!</div>
            <?php
        }
        ?>
    

    <br>

</div>


<?php require_once "pages/footer.php"?>

<script src="script.js"></script>
<script src="jquery-3.5.1.min.js"></script>
<script src="jquery-mask.js"></script>