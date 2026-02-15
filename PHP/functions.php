<?php
function generujSelect($conn, $id_tabela , $tabela, $kolumna, $name){
    $result = $conn->query("SELECT $kolumna, $id_tabela FROM $tabela");

    echo "<select name='$name'>";
    echo "<option value=''>Brak</option>";
    while($row = $result->fetch_assoc()){
        echo "<option value='{$row[$id_tabela]}'>{$row[$kolumna]}</option>";
    }
    echo "</select>";
}

function czyAdmin($conn, $id){ //Sprawdza czy id uzytkownika sesji jest w tabeli administratorzy
    $q = $conn->prepare("SELECT id_administratora FROM administratorzy WHERE id_uzytkownika = ?");
    $q->bind_param("i", $id);
    $q->execute();
    $result = $q->get_result();
    if($result->num_rows > 0){
        return true;
    } else {
        return false;
    }
}
function pokazNotatke($conn, $id){

    $stmt = $conn->prepare("
        SELECT 
            notatka.nazwa AS tytul,
            kategorie.nazwa AS kategoria,
            epoki.nazwa AS epoka,
            klasy.nazwa AS klasa,
            notatka.tresc
        FROM notatka
        INNER JOIN kategorie ON kategorie.id_kategoria = notatka.id_kategoria
        INNER JOIN epoki ON epoki.id_epoka = notatka.id_epoka
        INNER JOIN klasy ON klasy.id_klasa = notatka.id_klasa
        WHERE notatka.id_notatki = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){

        echo "<div class='note-container'>";

        echo "<h1 class='note-title'>" . htmlspecialchars($row['tytul']) . "</h1>";

        echo "<div class='note-meta'>";
        echo "<span><strong>Kategoria:</strong> " . htmlspecialchars($row['kategoria']) . "</span>";
        echo "<span><strong>Klasa:</strong> " . htmlspecialchars($row['klasa']) . "</span>";
        echo "<span><strong>Epoka:</strong> " . htmlspecialchars($row['epoka']) . "</span>";
        echo "</div>";

        echo "<div class='note-content' name='notatkaTekst' id='notatkaTekst'>";
        echo nl2br(htmlspecialchars($row['tresc']));
        echo "</div>";

        echo "</div>";
    }
}