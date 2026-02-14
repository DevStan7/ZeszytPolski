<?php
session_start();

if(!isset($_SESSION['user'])){
    header("location:../index.php");
}else{
    $conn = new mysqli('localhost','root','','zeszytpolski');
    $getId = "SELECT id_uzytkownika FROM uzytkownicy WHERE login ='".$_SESSION['user']."'";
    $result = $conn->query($getId);

    while($row = $result->fetch_row()){
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
    <link rel='stylesheet' href='../CSS/adminPanel.css'>
    <link rel='stylesheet' href='../CSS/notatka.css'>
</head>

<body>

<div class="letters-bg"></div>

<nav class="top-nav">
    <a href='main.php'>← Powrót</a>
    <a href='logout.php'>Wyloguj się</a>
</nav>

<div class="container">
    <div class="note-card">

<?php
include "functions.php";

$conn = new mysqli('localhost', 'root', '', 'zeszytpolski');

$id = $_GET['id_notatki'];

pokazNotatke($conn, $id);

/* ===== PRZYCISKI ADMINA ===== */

if (czyAdmin($conn, $_SESSION['id'])) {

    echo "
    <div class='note-actions'>

        <form method='GET' action='edytujNotatke.php'>
            <button type='submit' class='edit-btn'>Modyfikuj notatkę</button>
        </form>

        <form method='POST'>
            <button name='usunButton' class='delete-btn'>Usuń notatkę</button>
        </form>

    </div>
    ";
}

/* ===== USUWANIE ===== */

if(isset($_POST['usunButton'])){
    $usunQuery = "DELETE FROM notatka WHERE id_notatki = $id";
    $conn->query($usunQuery);
    header("location:main.php");
}

$conn->close();
?>

    </div>
</div>

</body>
</html>