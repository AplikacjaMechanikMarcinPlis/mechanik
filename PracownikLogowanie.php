<?php

session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
    header('Location: index.php');
    exit();
}
require_once 'Polaczenie.php';
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Błąd ".$polaczenie->connect_errno;
} else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $sql = "SELECT * FROM PRACOWNIK WHERE LOGIN='$login' AND HASLO='$haslo'";
    $wynik = @$polaczenie->query($sql);
    if($wynik) {
        $ilu = $wynik->num_rows;
        if($ilu == 1) {
            $user = $wynik->fetch_assoc();
            $_SESSION['zalogowany'] = true;
            $_SESSION['id'] = $user['ID_PRACOWNIKA'];
            $_SESSION['login'] = $user["LOGIN"];
            $_SESSION["imie"] = $user["IMIE"];
            $_SESSION["nazwisko"] = $user["NAZWISKO"];
            unset($_SESSION['blad']);
            $wynik->free_result();
            header("Location: MechanikGlowna.php");
        }
        else {
            $_SESSION["blad"] = "Nieprawidlowy login lub haslo!";
            header("Location: PanelMechanika.php");
        }
    }
}
$polaczenie->close();
?>
