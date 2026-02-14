<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel='stylesheet' href='../CSS/style.css'>
    <link rel='stylesheet' href='../CSS/adminPanel.css'>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="letters-bg"></div>
<div class='container'>
    <form method='post'>
        <h1>Wirtualny Zeszyt</h1>
        <label>Login</label>
        <input type='text' name='login' placeholder='Wpisz login' required>
        <label>Hasło</label>
        <input type='password' name='password' placeholder='Wpisz hasło' required>
        <button name='signIn'>Zarejestruj się</button>
        <a href='../index.php' class="register-link">Masz konto? Zaloguj się</a>
    </form>
</div>
<?php
if(isset($_POST['signIn'])){
    $conn = new mysqli('localhost','root','','zeszytpolski');
    $registerLogin = $_POST['login'];
    $registerPassword = $_POST['password'];
    $checkLogin = "SELECT login FROM uzytkownicy WHERE login='$registerLogin'";
    $result = $conn->query($checkLogin);
    if($result->num_rows > 0){
        echo "<p class='error-msg'>Użytkownik $registerLogin już istnieje</p>";
    }else{
        $signInQuery = $conn->prepare("INSERT INTO uzytkownicy(login,haslo) VALUES(?,?)");
        $hashPassword = md5($registerPassword);
        $signInQuery->bind_param("ss",$registerLogin,$hashPassword);
        $signInQuery->execute();
        session_start();
        $_SESSION['user'] = $registerLogin;
        header("location:main.php");
    }
    $conn->close();
}
?>
<script src='../JS/styleScript.js'></script>
</body>
</html>