<?php
include 'functions.php';
session_start();
if(!isset($_SESSION['user'])){
    header("location:../index.php");
}else{
    $conn = new mysqli('localhost','root','','zeszytpolski');
    $getId = "SELECT id_uzytkownika FROM uzytkownicy WHERE login ='".$_SESSION['user']."'"; //Tutaj pobieram id
    $result = $conn->query($getId);
    while($row = $result -> fetch_row()){
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
    <title>Main page</title>
</head>

<body>
    <header>
        <h1>Kompedium wiedzy z języka polskiego</h1>
        <h2>Klasy IIIPB</h2>
    </header>
    <nav>
        <a href='logout.php'>Wyloguj się</a>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'zeszytpolski');
        if(czyAdmin($conn, $_SESSION['id'])){
            echo "<a href='adminPanel.php'>Panel administratora</a>";
        }
        $conn->close();
        ?>
        <form method='POST'>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'zeszytpolski');
            generujSelect($conn, "id_epoka", "epoki", "nazwa", "epoki");
            generujSelect($conn, "id_klasa", "klasy", "nazwa", "klasy");
            generujSelect($conn, "id_kategoria", "kategorie", "nazwa", "kategorie");
            echo "<button name='submitButton'>Filtruj</button>";
            $conn->close();
            ?>
        </form>
    </nav>
    <main>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'zeszytpolski');
        if (isset($_POST['submitButton'])) {
            $q = "SELECT notatka.nazwa FROM notatka INNER JOIN epoki ON notatka.id_epoka = epoki.id_epoka INNER JOIN kategorie ON kategorie.id_kategoria = notatka.id_kategoria INNER JOIN klasy ON klasy.id_klasa = notatka.id_klasa WHERE 1=1";
            if (isset($_POST['epoki']) && $_POST['epoki'] !== '') {
                $q .= " AND notatka.id_epoka=" . (int)$_POST['epoki'];
            }
            if (isset($_POST['klasy']) && $_POST['klasy'] !== '') {
                $q .= " AND notatka.id_klasa=" . (int)$_POST['klasy'];
            }
            if (isset($_POST['kategorie']) && $_POST['kategorie'] !== '') {
                $q .= " AND notatka.id_kategoria=" . (int)$_POST['kategorie'];
            }
            $result = $conn->query($q);
            while($row = $result->fetch_assoc()){
                echo $row['nazwa']."<br>";
            }
        } else {
            $q = $conn->query("SELECT id_notatki, nazwa FROM notatka");
            while ($row = $q->fetch_assoc()) {
                echo "<a href = 'notatka.php?id_notatki=".$row['id_notatki']."'>".$row['nazwa']."</a><br>";
            }
        }

        ?>
    </main>
    <footer>
        Autorzy :
    </footer>
</body>

</html>