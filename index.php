<?php
session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
    header('Location: PanelKlienta.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mechanik strona główna</title>
    </head>
    <body>
        <a href="Rejestracja.php">Zarejestruj się</a>
        <a href="PanelMechanika.php">Panel mechanika</a>
        <p>
            Zaloguj się jako klient:
        <form action="KlientLogowanie.php" method="post">
            Login: <br /> <input type="text" name="login" /> <br />
            Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
            <input type="submit" value="Zaloguj się" />
        </form>
    </p>
<?php
if(isset($_SESSION['blad'])) {
    echo "<p>".$_SESSION['blad']."</p>";
}
    ?>
</body>
</html>
