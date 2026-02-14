<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel='stylesheet'>
</head>
<body>
    <div class='container'>
    <h1>Kompedium wiedzy z języka polskiego</h1>
    <form method='post' >
    <input type='text' name='login' placeholder='Login'><br>
    <input type='password' name='password' placeholder='Password'><br>
    <button name='logIn'>Zaloguj się</button>
    <a href='PHP/register.php'>Zarejestruj się</a>
    </div>

    </form>
    <?php
        if(isset($_POST['logIn'])){
        $conn = new mysqli('localhost','root','','zeszytpolski');
        $myLogin = $_POST['login'];
        $myPassword = $_POST['password'];
        $hashPassword = md5($myPassword);
        $checkLogin = "SELECT id_uzytkownika FROM uzytkownicy WHERE login = '".$myLogin."' AND haslo = '".$hashPassword."';";
        $result = $conn->query($checkLogin);
        if($result->num_rows > 0){
            session_start();
            $_SESSION['user'] = $myLogin;
            header("location:PHP/main.php");
        }else{
            echo "Wrong password or login";
        }
        $conn->close();
    }
    ?>
</body>
</html>