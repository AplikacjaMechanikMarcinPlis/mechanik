<?php
session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
    header('Location: MechanikGlowna.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel Mechanika - logowanie</title>
    </head>
    <body>
        <a href="index.php">Strona główna</a>
        <p>
            Zaloguj się do panelu pracownika:
        <form action="PracownikLogowanie.php" method="post">
            Login: <br /> <input type="text" name="login" /> <br />
            Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
            <input type="submit" value="Zaloguj się" />
        </form>
    </p>
<?php
require 'Polaczenie.php';
?>
</body>
</html>
