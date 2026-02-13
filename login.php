<?php
    session_start();
    if(isset($_SESSION['login']) || isset($_SESSION['haslo'])){
        session_unset();
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj się</title>
</head>
<body>
    <form method="post">
        <input type="text" name="login" id="login" placeholder="Login">
        <input type="password" name="haslo" id="haslo" placeholder="Hasło">
        <button name="wyslij">Zaloguj się</button>
    </form>
    <?php 
        if(isset($_POST['wyslij'])){
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
            $conn = new mysqli('localhost','root','','zeszytpolski');
            $q = "SELECT * FROM uzytkownicy WHERE login=? AND haslo=?";
            $stmt = $conn->prepare($q);
            $stmt-> bind_param("ss",$login,$haslo);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $_SESSION['login'] = $login;
                $_SESSION['haslo'] = $haslo;
                $_SESSION['czyAdmin'] = ($result->fetch_array())[3];
                header('Location: index.php');
            }else{
                echo"<p>Takie konto nie istnieje</p>";
            }
        }
    ?>
</body>
</html>