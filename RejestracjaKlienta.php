<?php

require_once 'Polaczenie.php';

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Błąd " . $polaczenie->connect_errno;
} else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $uprawnienia = "klient";
    $sql = "SELECT * FROM KLIENT WHERE LOGIN='$login'";
    $wynik = @$polaczenie->query($sql);
    if (!$wynik)
        throw new Exception($polaczenie->error);
    $ilu = $wynik->num_rows;
    if ($ilu > 0) {
        echo "Istnieje już konto o takim loginie, proszę wybrać inny.";
    } else {
        $sql = "INSERT INTO KLIENT VALUES (null,'$imie','$nazwisko','$login','$haslo','$uprawnienia');";
        $wynik = @$polaczenie->query($sql);
        if ($wynik) {
            echo "Użytkownik $login zarejestrowany pomyślnie.";
        } else {
            echo "Nieoczekiwany błąd przy rejestracji.";
        }
    }
    echo '<p><a href="rejestracjaklienta.html">Powrót do formularza rejestracyjnego</a>';
    echo '<p><a href="index.php">Strona główna</a>';
    $polaczenie->close();
}
?>