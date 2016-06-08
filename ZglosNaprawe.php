<?php
session_start();
require_once 'Polaczenie.php';
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$res = $polaczenie->query("SELECT * FROM PRACOWNIK");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Zgłaszanie awarii</title>
    </head>
    <body>
        <h1>Zgłoś samochód do naprawy</h1>
        <p>
        <form action="Zgloszenie.php" method="post">
            <table>
                <tr>
                    <td colspan="2"><h2>Podaj informacje o samochodzie</h2></td>
                </tr>
                <tr>
                    <td><b>Numer rejestracyjny</b></td>
                    <td><input type="text" name="nr_rejestracyjny" required></td>
                </tr>
                <tr>
                    <td><b>Marka</b></td>
                    <td><input type="text" name="marka" required></td>
                </tr>
                <tr>
                    <td><b>Model</b></td>
                    <td><input type="text" name="model" required></td>
                </tr>
                <tr>
                    <td><b>Przebieg</b></td>
                    <td><input type="text" name="przebieg" required></td>
                </tr>
                <tr>
                    <td colspan="2"><h2>Szczegóły awarii</h2></td>
                </tr>
                <tr>
                    <td><b>Opis</b></td>
                    <td><textarea rows="10" name="opis"></textarea></td>
                </tr>
                <tr>
                    <td><b>Wybierz mechanika</b></td>
                    <td>
                        <select name="mechanik">
                            <?php
                            while ($mechanicy = $res->fetch_assoc()){
                                echo "<option>".$mechanicy['NAZWISKO']."</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><center><input type="submit" value="Wyślij"></center></td>
                </tr>
            </table>
        </form>
    </p>
    <a href="PanelKlienta.php">Powrot do panelu klienta</a><br>
    <a href='Wyloguj.php'>Wyloguj</a>
</body>
</html>
