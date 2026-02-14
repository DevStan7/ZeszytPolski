<?php
include "functions.php";
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
    <title>Document</title>
</head>

<body>
    <form method='POST'>
        <input type='text' name='tematNotatki'>
        <textarea name='trescNotatki'></textarea>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'zeszytpolski');
        echo "<label>Epoki</label>";
        generujSelect($conn, "id_epoka", "epoki", "nazwa", "epoki");
        echo "<label>Klasy</label>";
        generujSelect($conn, "id_klasa", "klasy", "nazwa", "klasy");
        echo "<label>Kategorie</label>";
        generujSelect($conn, "id_kategoria", "kategorie", "nazwa", "kategorie");
        $conn->close();
        ?>
        <button name='subButton'>Wyślij notatkę</button>
    </form>
    <?php
    if (isset($_POST['subButton'])) {
        $conn = new mysqli('localhost', 'root', '', 'zeszytpolski');
        $tresc = $_POST['trescNotatki'];
        $temat = $_POST['tematNotatki'];
        $id_kategoria = $_POST['kategorie'];
        $id_klasa = $_POST['klasy'];
        $id_epoka = $_POST['epoki'];

        // Podstawowe kolumny (zawsze dodawane)
        $columns = ["nazwa", "tresc"];
        $values = ["?", "?"];
        $params = [$temat, $tresc];
        $types = "ss";

        // Jeśli wybrano kategorię
        if (!empty($id_kategoria) && $id_kategoria != "brak" && $id_kategoria != 0) {
            $columns[] = "id_kategoria";
            $values[] = "?";
            $params[] = $id_kategoria;
            $types .= "i";
        }

        // Jeśli wybrano klasę
        if (!empty($id_klasa) && $id_klasa != "brak" && $id_klasa != 0) {
            $columns[] = "id_klasa";
            $values[] = "?";
            $params[] = $id_klasa;
            $types .= "i";
        }

        // Jeśli wybrano epokę
        if (!empty($id_epoka) && $id_epoka != "brak" && $id_epoka != 0) {
            $columns[] = "id_epoka";
            $values[] = "?";
            $params[] = $id_epoka;
            $types .= "i";
        }

        // Budowanie zapytania
        $sql = "INSERT INTO notatka (" . implode(",", $columns) . ") 
            VALUES (" . implode(",", $values) . ")";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        echo "Dodano notatkę";

        $stmt->close();
        $conn->close();
    }

    ?>
</body>

</html>