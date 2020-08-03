<?php require_once "pages/header.php";?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Cadastre-se</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="nome">Seu Nome:</label>
                        <input type="text" name="nome" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Seu E-mail:</label>
                        <small class="form-text text-muted">Não se preocupe, seus dados estão seguros</small>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Seu Telefone:</label>
                        <input data-js="telefone" type="text" name="telefone" class="form-control required" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Sua Senha:</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                        <input type="submit" value="Cadastrar" class="enviar btn btn-default">

                    </form><br>

                    <?php
                    require_once "classes/usuarios.class.php";
                    $usuarios = new Usuarios();
                    if(isset($_POST["nome"]) && empty($_POST["nome"]) === false){
                        $nome = addslashes($_POST["nome"]);
                        $email = addslashes($_POST["email"]);
                        $telefone = addslashes($_POST["telefone"]);
                        $senha = md5($_POST["senha"]);

                        if($usuarios->cadastrar($nome, $telefone, $email, $senha)){
                            ?>
                                <div class="alert alert-success">
                                    <span>Parabéns! </span><a href="login.php">Faça o seu login agora</a>
                                </div>
                            <?php
                        }else{
                            ?>
                                <div class="alert alert-warning">
                                    <span>Usuário já cadastrado! </span><a href="login.php">Faça o seu login agora</a>
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
<?php require_once "pages/footer.php"?>