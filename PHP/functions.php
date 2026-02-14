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
function pokazNotatke($conn,$id){
    $result = $conn -> query("SELECT notatka.nazwa, kategorie.nazwa, epoki.nazwa, klasy.nazwa, notatka.tresc FROM notatka INNER JOIN kategorie ON kategorie.id_kategoria = notatka.id_kategoria INNER JOIN epoki ON epoki.id_epoka = notatka.id_epoka INNER JOIN klasy ON klasy.id_klasa = notatka.id_klasa WHERE notatka.id_notatki = $id");
    while($row = $result -> fetch_row()){
        echo $row[0]."<br>";
        echo $row[4]."<br>";
        echo $row[1]."<br>";
        echo $row[3]."<br>";
        echo $row[2]."<br>";
    }
}