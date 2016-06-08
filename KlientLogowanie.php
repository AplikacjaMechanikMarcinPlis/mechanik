<?php

session_start();

if ((!isset($_SESSION['zalogowany']))) {
    header('Location: index.php');
}
require_once 'Polaczenie.php';
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$_SESSION = "";

if ($polaczenie->connect_errno != 0) {
    $_SESSION['blad'] .= "<li>Błąd bazy danych - " . $polaczenie->connect_errno . "</li>";
} else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    if ($login == "") {
        $_SESSION['blad'] .= "<li>Pole login nie może być puste!</li>";
        header('Location: index.php');
    } else if ($haslo == "") {
        $_SESSION['blad'] .= "<li>Nie podano hasła!</li>";
        header('Location: index.php');
    } else {
        $sql = "SELECT * FROM KLIENT WHERE LOGIN='$login' AND HASLO='$haslo'";
        $wynik = @$polaczenie->query($sql);
        if ($wynik) {
            $ilu = $wynik->num_rows;
            if ($ilu == 1) {
                $user = $wynik->fetch_assoc();
                $_SESSION['zalogowany'] = true;
                $_SESSION['id'] = $user["ID_KLIENTA"];
                $_SESSION['login'] = $user["LOGIN"];
                $_SESSION["imie"] = $user["IMIE"];
                $_SESSION["nazwisko"] = $user["NAZWISKO"];
                unset($_SESSION['blad']);
                $wynik->free_result();
                header("Location: PanelKlienta.php");
            } else {
                $_SESSION["blad"] .= "<li>Nieprawidlowy login lub haslo!</li>";
                header("Location: index.php");
            }
        }
    }
}
$polaczenie->close();
?>
