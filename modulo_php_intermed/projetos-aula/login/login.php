<?php
    session_start();

    if (isset($_POST['email']) && empty($_POST['email']) == false) {
        
        $email = addslashes($_POST['email']);
        $senha = md5(addslashes($_POST['senha']));
       
        $dsn = "mysql:dbname=blog;host=127.0.0.1";
        $dbuser = "root";
        $dbpsw = "";

        try {
            $db = new PDO($dsn, $dbuser, $dbpsw);

            $sql = $db->query("SELECT * FROM usuarios WHERE email = '$email' AND  senha = '$senha'");

            if ($sql->rowCount() > 0) {
                
                $dado = $sql->fetch();                    
                $_SESSION['id'] = $dado['id'];
                header ("Location: index.php");
            }
            
        } catch (PDOException $e) {
            echo "Falhou:".$e->getMessage();
        }
    }
?>
<form method="post">
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email">
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha">
    <input type="submit" value="Login">
</form>
