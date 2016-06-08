<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Zgłaszanie awarii</title>
    </head>
    <body>
        <?php
        session_start();

        if (!isset($_SESSION['zalogowany'])) {
            header('Location: index.php');
            exit();
        }

        require_once 'Polaczenie.php';
        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

        if ($polaczenie->connect_errno != 0) {
            echo "Błąd " . $polaczenie->connect_errno;
        } else {
            $_SESSION['komunikat'] = "Zgłoszenie naprawy samochodu o numerze rejestracyjnym ";
            //dane samochodu klienta
            $nrRejestracyjny = $_POST['nr_rejestracyjny'];
            $marka = $_POST['marka'];
            $model = $_POST['model'];
            $przebieg = $_POST['przebieg'];
            $idKlienta = $_SESSION['id'];
            $mechanik = $_POST['mechanik'];
            $sql = "INSERT INTO SAMOCHOD VALUES ('$nrRejestracyjny', '$marka', '$model', '$przebieg', '$idKlienta');";
            if ($r = $polaczenie->query($sql)) {
                $_SESSION['komunikat'] .= $nrRejestracyjny . " u mechanika $mechanik";
            } else {
                $_SESSION['komunikat'] .= $nrRejestracyjny . " nie powiodło się!";
            }
            //przygotówka do wrzucenia wizyty do bazy
            $opis = $_POST['opis'];
            $sql = "SELECT ID_PRACOWNIKA FROM PRACOWNIK WHERE NAZWISKO = '$mechanik'";
            $res = $polaczenie->query($sql);
            $id = $res->fetch_assoc();
            $idPracownika = $id['ID_PRACOWNIKA'];
            $idKlienta = $_SESSION['id'];
            $sql = "INSERT INTO WIZYTA VALUES (null, null, 'zgłoszona', '$idKlienta', '$opis', null, null, '$idPracownika', '$nrRejestracyjny');";
            if ($r = $polaczenie->query($sql)) {
                $_SESSION['komunikat'] .= " zostało przyjęte pomyślnie i oczekuje na akceptację ze strony mechanika. ";
            } else {
                $_SESSION['komunikat'] .= " nie powiodło się!";
            }
        }
        echo $_SESSION['komunikat'];
        ?>
        <br><br>
        <a href='ZglosNaprawe.php'>Powrót do formularza zgłaszania naprawy</a>
    </body>
</html>