<?php require_once "pages/header.php"?>
<?php if(empty($_SESSION["cLogin"])){
    header("Location: login.php");
}
?>
    <div class="container">
        <h1>Meus anúncios</h1>
    
            <a href="add-anuncio.php" class="btn btn-secondary">Adicionar anúncios</a>

            <br><br>
        
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Título</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
        <?php
        require_once "classes/anuncios.class.php";
        $anuncios = new Anuncios();
        $anuncios = $anuncios->getMeusAnuncios();

        foreach($anuncios as $anuncio):
            ?>
            <tr>
                <td>
                <?php if(empty($anuncio["url"]) == false):?>
                    <img height="100" src="assets/images/anuncios/<?php echo $anuncio["url"];?>">
                <?php else:?>
                    <img src="assets/images/default.jpg" height="100" alt="image-default">
                <?php endif;?>
                </td>
                    <td><?php echo $anuncio["titulo"];?></td>
                    <td><?php echo $anuncio["valor"];?></td>
                <td>
                    <a style="margin:0; padding:10px 10px 10px 10px;" class="btn btn-primary" href="editar-anuncio.php?id=<?php echo $anuncio["id"];?>">Editar</a>
                    <a style="margin:0; padding:10px 10px 10px 10px;" class="btn btn-danger" href="excluir-anuncio.php?id=<?php echo $anuncio["id"];?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </div>
<?php require_once "pages/footer.php"?>
</table>