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
        <title>Panel klienta</title>
    </head>
    <body>
        <?php
        echo "<p>Zalogowany jako " . $_SESSION["login"] . "</p>";
        echo "<p>Twoje dane osobowe:<br />";
        echo $_SESSION["imie"] . " " . $_SESSION["nazwisko"];
        echo "</p>";
        echo "<h2>Twoje naprawy:</h2>";
        echo "<br>";
        ?>
        <table border="1">
            <thead>
            <td>ID</td>
            <td>Data naprawy</td>
            <td>Status naprawy</td>
            <td>Opis</td>
            <td>Części zakupione do usunięcia usterki</td>
            <td>Należność</td>
            <td>Mechanik</td>
            <td>Samochód</td>
        </thead>
        <tbody>
            <?php
            require_once 'Polaczenie.php';
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $pom = $_SESSION['id'];
            $sql = "SELECT * FROM WIZYTA WHERE ID_KLIENTA = '$pom';";
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
                    echo $row['CZESCI'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['CENA'];
                    echo "</td>";
                    echo "<td>";
                    $mech = $row['ID_PRACOWNIKA'];
                    $sql = "SELECT IMIE, NAZWISKO FROM PRACOWNIK WHERE ID_PRACOWNIKA = '$mech'";
                    $mech = $polaczenie->query($sql)->fetch_assoc();
                    $mechImie = $mech['IMIE'];
                    $mechNazwisko = $mech['NAZWISKO'];
                    echo $mechImie." ".$mechNazwisko;
                    echo "</td>";
                    echo "<td>";
                    echo $row['SAMOCHOD'];
                    echo "</td>";
                    echo "</tr>";
                }
            }
                $polaczenie->close();
                ?>
        </tbody>
    </table>
        <a href='ZglosNaprawe.php'>Zgłoś naprawę</a>
        <a href='Wyloguj.php'>Wyloguj</a>
</body>
</html>
