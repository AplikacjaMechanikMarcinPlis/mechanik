<?php

session_start();

require_once 'Polaczenie.php';
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Błąd ".$polaczenie->connect_errno;
} else {
    $data = $_POST['data_naprawy'];
    $status = $_POST['status'];
    $czesci = $_POST['czesci'];
    $naleznosc = $_POST['naleznosc'];
    $id = $_GET['id'];
    $sql = "UPDATE WIZYTA SET DATA='$data', STATUS='$status', CENA='$naleznosc', CZESCI='$czesci' WHERE ID_WIZYTY='$id'";
    $wynik = @$polaczenie->query($sql);
    if($wynik)
        $_SESSION['msg'] = "Szczegóły dotyczące naprawy zaaktualizowane pomyślnie.";
    else
        $_SESSION['msg'] = "Błąd przy aktualizacji naprawy!";
    header("Location: MechanikGlowna.php");
}
$polaczenie->close();
?>
