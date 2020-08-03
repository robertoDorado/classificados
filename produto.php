<?php
require_once "pages/header.php";
require_once "classes/anuncios.class.php";
require_once "classes/usuarios.class.php";
$anuncios = new Anuncios();
$usuarios = new Usuarios();

if(isset($_GET['id']) && empty($_GET['id']) == false){
    $id = addslashes($_GET['id']);
}else{
    header("Location: index.php");
}

$info = $anuncios->getAnuncio($id); 
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-5">
                <section>
                    <div class="slider" data-arrows="true" data-paging="true">
                        <ul class="slides">
                            <?php foreach($info['fotos'] as $chave => $foto): ?>
                                <li> <img alt="Image" src="assets/images/anuncios/<?php echo $foto['url']; ?>"> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </section>
            </div>
                

            <div class="col-sm-7 col-md-7">
                <section>
                    <h1><?php echo $info['titulo'];?></h1>
                    <h4><?php echo utf8_encode($info['categoria']); ?></h4>
                    <p><?php echo utf8_decode($info['descricao']); ?></p><br>
                    <h4><?php echo $info['valor'];?></h4><br>
                    <p>Telefone:</p>    
                    <p><?php echo $info['telefone'];?></p>
                </section>
            </div>
    </div>
<?php require_once "pages/footer.php";?>