<?php require_once "pages/header.php"?>


<div class="container">
    <h1>Meus anuncios - Adicionar Anuncios</h1>

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
                    <option value="<?php echo $categoria["id"];?>"><?php echo utf8_encode($categoria["nome"]);?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo">
        </div>

        <div class="form-group">
            <label for="titulo">Valor:</label>
            <input data-js="dinheiro" id="dinheiro" type="text" class="dinheiro form-control"  name="valor">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea type="text" class="form-control"  name="descricao"></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="categoria" class="form-control">
                <option value="0">Ruim</option>
                <option value="1">Bom</option>
                <option value="2">Ótimo</option>
            </select>
        </div>

        <input type="submit" value="Adicionar" class="btn btn-primary">
    </form>

    

    <br>

    <?php if(empty($_SESSION["cLogin"])){
    header("Location: login.php");
    }

    require_once "classes/anuncios.class.php";
    $anuncios = new Anuncios();
    if(isset($_POST["titulo"]) && !empty($_POST["titulo"])){
    $titulo = addslashes($_POST["titulo"]);
    $valor = addslashes($_POST["valor"]);
    $descricao = utf8_encode(addslashes($_POST["descricao"]));
    $categoria = addslashes($_POST["categoria"]);
    $estado = addslashes($_POST["estado"]);

    $anuncios->addAnuncios($titulo, $valor, $descricao, $categoria, $estado);

    ?>
        <div class="alert alert-success">
            Produto adicionado com sucesso!
        </div>
    <?php
}

?>
</div>


<?php require_once "pages/footer.php"?>

<script src="script.js"></script>
<script src="jquery-3.5.1.min.js"></script>
<script src="jquery-mask.js"></script>