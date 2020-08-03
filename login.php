<?php require_once "pages/header.php";?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Login</h1>
                <form method="post">

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <small class="form-text text-muted">Não se preocupe, seus dados estão seguros</small>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                        <input type="submit" value="Entrar" class="enviar btn btn-default">

                    </form><br>

                    <?php
                    require_once "classes/usuarios.class.php";
                    $usuarios = new Usuarios();
                    if(isset($_POST["email"]) && empty($_POST["email"]) === false){
                        $email = addslashes($_POST["email"]);
                        $senha = md5($_POST["senha"]);

                        if($usuarios->login($email, $senha)){
                            header("Location: index.php");
                        }else{
                            ?>
                                <div class="alert alert-danger">
                                    <span>Usuário ou senha incorreto!</span>
                                </div>
                            <?php
                        }

                    }
                ?>
            </div>
            
        </div>
    </div>

    <style>
    .enviar{
    background:gray;
    color:white;
    }
    .enviar:hover{
    border:1px solid black;
    background:white;
    color:black;
    transition:0.3s;
    }
    
    </style>

<script src="script.js"></script>



<?php require_once "pages/footer.php";?>