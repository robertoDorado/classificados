<?php
require_once "pages/header.php";
require_once "classes/anuncios.class.php";
require_once "classes/usuarios.class.php";
$anuncios = new Anuncios();
$usuarios = new Usuarios();


$total_anuncios = $anuncios->getTotalAnuncios();
$total_usuarios = $usuarios->getTotalUsuarios();

$p = 1;
if(isset($_GET['p']) && empty($_GET['p']) == false){
    $p = addslashes($_GET['p']);
}
$porPagina = 2;
$total_de_paginas = ceil($total_anuncios / $porPagina);


$itemAnuncio = $anuncios->getUltimosAnuncios($p, $porPagina);
?>

    <div class="container-fluid">
        <div class="jumbotron chamada">
            <h2>Hoje nós temos <?php echo $total_anuncios;?> anúncios</h2>
            <p>E mais de <?php echo $total_usuarios;?> usuarios cadastrados</p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <h5>Pesquisa Avançada</h5>
        </div>
        <div class="col-sm-9">
            <h5>Últimos anúncios</h5>
            <table class="table table-dark">
                <tbody>
                    <?php foreach($itemAnuncio as $item):?>
                        <tr>
                            <td>
                                <?php if(empty($item["url"]) == false):?>
                                <img height="100" src="assets/images/anuncios/<?php echo $item["url"];?>">
                                <?php else:?>
                                <img src="assets/images/default.jpg" height="100" alt="image-default">
                                <?php endif;?>
                            </td>
                            <td>
                                <a href="produto.php?id=<?php echo $item['id'];?>"><?php echo $item['titulo'];?></a><br>
                                <?php echo utf8_encode($item['categoria']);?>
                            </td>
                            <td><?php echo $item["valor"];?></td>
                            <td></td>
                        </tr>
                    
                    <?php endforeach;?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php for($q=1; $q<=$total_de_paginas; $q++):?>
                    <li class="page-item <?php echo ($p==$q)?'active':'' ?>"><a class="page-link" href="index.php?p=<?php echo $q?>"><?php echo $q;?></a></li>
                <?php endfor;?>
            </ul>
        </div>
    </div>
<?php require_once "pages/footer.php";?>