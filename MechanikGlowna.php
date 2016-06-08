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
            require_once 'Polaczenie.php';
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $pom = $_SESSION['id'];
            $sql = "SELECT * FROM WIZYTA WHERE ID_PRACOWNIKA = '$pom';";
            $naprawy = $polaczenie->query($sql);
            if ($naprawy->num_rows > 0) {
                while ($row = $naprawy->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>";
                    echo $row['ID_WIZYTY'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['DATA'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['STATUS'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['OPIS'];
                    echo "</td>";
                    echo "<td>";
                    $pom = $row['CZESCI'];
                    $sql = "SELECT NAZWA FROM CZESCI WHERE ID_CZESCI='$pom'";
                    $nazwaSzukanej = $polaczenie->query($sql)->fetch_assoc();
                    echo $nazwaSzukanej['NAZWA'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['CENA'];
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
                    $idEdit = $row['ID_WIZYTY'];
                    echo "<a href='EdytujWizyte.php?id=$idEdit'>Zmień</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            $polaczenie->close();
            ?>
        </tbody>
    </table>
        <p>
            <?php
            if(isset($_SESSION['msg']))
                echo $_SESSION['msg'];
            ?>
        </p>
    <br>
    <a href='Wyloguj.php'>Wyloguj</a>
</body>
</html>
