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
