<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='../CSS/loginForm.css'>
    <link rel='stylesheet' href='../CSS/style.css'>
</head>
<body>
    <div>
    <h1>Kompedium wiedzy</h1>
    <form method='post'>
    <input type='text' name='login' placeholder='Login'><br>
    <input type='password' name='password' placeholder='Password'><br>
    <button name='signIn'>Zarejestruj się</button>
    <a href='../index.php'>Zaloguj się</a>
    </form>
    </div>
    <?php
        if(isset($_POST['signIn'])){
        $conn = new mysqli('localhost','root','','zeszytpolski');
        $registerLogin = $_POST['login'];
        $registerPassword = $_POST['password'];
        $checkLogin = "SELECT login FROM uzytkownicy WHERE login = '". $registerLogin. "'";
        $result = $conn->query($checkLogin);
        if($result->num_rows > 0){
            echo "Uzytkownik ". $registerLogin. " juz istnieje";
        }else{
            $signInQuery = $conn->prepare("INSERT INTO uzytkownicy(login,haslo) VALUES(?,?)");
            $hashPassword = md5($registerPassword);
            $signInQuery->bind_param("ss",$registerLogin,$hashPassword);
            $signInQuery->execute();
            $newUserId = $conn->insert_id;
            session_start();
            $_SESSION['user'] = $registerLogin;
            header("location:main.php");
        }
        $conn->close();
    }
    ?>
</body>
</html>