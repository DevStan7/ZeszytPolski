<?php
include 'functions.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("location:../index.php");
} else {
    $conn = new mysqli('localhost', 'root', '', 'zeszytpolski');
    $getId = "SELECT id_uzytkownika FROM uzytkownicy WHERE login ='" . $_SESSION['user'] . "'"; //Tutaj pobieram id
    $result = $conn->query($getId);
    while ($row = $result->fetch_row()) {
        $_SESSION['id'] = $row[0];
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notatka</title>
    <link rel='stylesheet' href='../CSS/style.css'>
</head>

<body>
    <nav>
        <a href='main.php'>Main</a>
        <a href='logout.php'>Wyloguj się</a>
    </nav>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'zeszytpolski');
    $id = $_GET['id_notatki'];
    pokazNotatke($conn, $id);
    if (czyAdmin($conn, $_SESSION['id'])) {
        echo "<form method='POST'><button name='usunButton'>Usuń notatke</button></form>";
    }
    if(isset($_POST['usunButton'])){
        $usunQuery = "DELETE FROM notatka WHERE id_notatki = $id";
        $conn -> query($usunQuery);
        header("location:main.php");
    }
    $conn->close();
    ?>
</body>

</html>