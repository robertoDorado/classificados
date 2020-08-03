<?php
require_once "config.php";

class Usuarios{

    
    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;
        if($this->verificarEmailSenha($email) == false){
            $sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, telefone = :telefone,
            email = :email, senha = :senha");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", $senha);
            $sql->execute();
            
            return true;
        }
    }
    
    
    private function verificarEmailSenha($email){
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }
        
    }

    public function login($email, $senha){
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();
            $_SESSION["cLogin"] = $dado["id"];
            return true;
        }else{
            return false;
        }
    }


    public function getTotalUsuarios(){
        global $pdo;

        $sql = $pdo->query("SELECT COUNT(*) as c FROM usuarios");
        $row = $sql->fetch();

        return $row['c'];
    }

}

