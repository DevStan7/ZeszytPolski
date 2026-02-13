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
        <form method='POST'>
            <?php
            include 'PHP/functions.php';
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
            $q = $conn->query("SELECT nazwa FROM notatka");
            while ($row = $q->fetch_assoc()) {
                echo $row['nazwa'] . "<br>";
            }
        }

        ?>
    </main>
    <footer>
        Autorzy :
    </footer>
</body>

</html>