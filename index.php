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
    <main>
    <form method='POST'>
    <?php
    $conn = new mysqli('localhost','root','','zeszytpolski');
    $selectEpoki = $conn -> query("SELECT nazwa FROM epoki");
    echo "<select name='epoka'>";
    while($row = $selectEpoki->fetch_assoc()){
        echo "<option value='".$row['nazwa']."'>".$row['nazwa']."</option>";
    }
    echo "</select>"
    ?>
    </form>
    </main>
    <footer>
        Autorzy : 
    </footer>
</body>
</html>