<!DOCTYPE html>
<html>
    <head>
        <title>Rejestracja klienta</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Rejestracja klienta</h1>
        <form action="RejestracjaKlienta.php" method="post">
            <table>
                <tr>
                    <td><b>Login:</b></td>
                    <td><input type="text" name="login" placeholder="Login" required></td>
                </tr>
                <tr>
                    <td><b>Hasło:</b></td>
                    <td><input type="password" name="haslo" placeholder="Hasło" required></td>
                </tr>
                <tr>
                    <td><b>Imię:</b></td>
                    <td><input type="text" name="imie" placeholder="Imię" required></td>
                </tr>
                <tr>
                    <td><b>Nazwisko:</b></td>
                    <td><input type="text" name="nazwisko" placeholder="Nazwisko" required></td>
                </tr>
                <tr>
                    <td colspan="2"><center><input type="submit" value="Zarejestruj"></center></td>
                </tr>
            </table>
        </form>
        <p>
        <a href="index.php">Powrót do strony głównej</a>
        </p>
    </body>
</html>