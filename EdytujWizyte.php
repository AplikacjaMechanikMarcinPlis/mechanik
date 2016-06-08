<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo "<p>Zalogowany jako " . $_SESSION["login"] . "</p>";
        echo "<p>Twoje dane osobowe:<br />";
        echo $_SESSION["imie"] . " " . $_SESSION["nazwisko"];
        echo "</p>";
        ?>
        <h2>Zgłoszenia napraw:</h2>
        <table border="1">
            <thead>
            <td>ID</td>
            <td>Data naprawy</td>
            <td>Status naprawy</td>
            <td>Opis</td>
            <td>Części zakupione do usunięcia usterki</td>
            <td>Należność</td>
            <td>Klient</td>
            <td>Samochód</td>
            <td></td>
        </thead>
        <tbody>
            <?php
            $pom = $_GET['id'];
            echo "<form method='post' action='Edycja.php?id=$pom'>";
            require_once 'Polaczenie.php';
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $pom = $_GET['id'];
            $sql = "SELECT * FROM WIZYTA WHERE ID_WIZYTY = '$pom';";
            $naprawy = $polaczenie->query($sql);
            if ($naprawy->num_rows > 0) {
                while ($row = $naprawy->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>";
                    echo $row['ID_WIZYTY'];
                    echo "</td>";
                    echo "<td>";
                    echo "<input type ='date' name='data_naprawy'>";
                    echo "</td>";
                    echo "<td>";
                    echo "<select name='status'>";
                    echo "<option>zgłoszona</option>";
                    echo "<option>naprawa w toku</option>";
                    echo "<option>zakończona</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td>";
                    echo $row['OPIS'];
                    echo "</td>";
                    echo "<td>";
                    echo "<select name ='czesci'>";
                    $czesci = $polaczenie->query("SELECT * FROM CZESCI");
                    while ($czesc = $czesci->fetch_assoc()) {
                        $idCzesci = $czesc['ID_CZESCI'];
                        $nazwa = $czesc['NAZWA'];
                        echo "<option value='$idCzesci'>$nazwa</option>";
                    }
                    echo "</td>";
                    echo "<td>";
                    echo "<input type='number' step='0.50' min='1000.00' name='naleznosc'>";
                    echo "</td>";
                    echo "<td>";
                    $kl = $row['ID_KLIENTA'];
                    $sql = "SELECT IMIE, NAZWISKO FROM KLIENT WHERE ID_KLIENTA = '$kl'";
                    $kl = $polaczenie->query($sql)->fetch_assoc();
                    $klImie = $kl['IMIE'];
                    $klNazwisko = $kl['NAZWISKO'];
                    echo $klImie . " " . $klNazwisko;
                    echo "</td>";
                    echo "<td>";
                    echo $row['SAMOCHOD'];
                    echo "</td>";
                    echo "<td>";
                    echo "<input type='submit' value='Zapisz zmiany'>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</form>";
                }
            }
            $polaczenie->close();
            ?>
        </tbody>
    </table>
    <br>
    <a href="MechanikGlowna.php">Powrót do panelu mechanika</a>
    </body>
</html>