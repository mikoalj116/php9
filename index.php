<?php
$coonnect = new mysqli('localhost','root','','antyki');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sprzedaż antyków</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Najlepsze antyki w miescie</h1>
</header>

<main>
    <section>
        <h2>- Sofy -</h2>
<?php
$kategoria = 1;

$sql = "SELECT * FROM meble WHERE kategoria = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $kategoria);
mysqli_stmt_execute($stmt);

$wynik = mysqli_stmt_get_result($stmt);

while ($wiersz = mysqli_fetch_assoc($wynik)) {
    echo "<div class='mebel'>";

    echo "<div class='obraz'>";
    echo "<img src='sofy/" . htmlspecialchars($wiersz['zdjecie']) . "' alt='mebel'>";
    echo "</div>";

    echo "<div>";
    echo "<h3>" . htmlspecialchars($wiersz['nazwa']) . "</h3>";
    echo "<h4>styl " . htmlspecialchars($wiersz['styl']) . "</h4>";
    echo "<h3>CENA: " . htmlspecialchars($wiersz['cena']) . " zł</h3>";

    echo "<form method='post' action='index.php'>";
    echo "<button type='submit' name='kup' value='" . $wiersz['idMeble'] . "'>KUP</button>";
    echo "</form>";

    echo "</div>";

    echo "<div class='opis'>";
    echo htmlspecialchars($wiersz['opis']);
    echo "</div>";

    echo "</div>";
}

mysqli_stmt_close($stmt);
?>
        

        <h2>- Fotele -</h2>
<?php
$kategoria = 2;

$sql = "SELECT * FROM meble WHERE kategoria = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $kategoria);
mysqli_stmt_execute($stmt);

$wynik = mysqli_stmt_get_result($stmt);

while ($wiersz = mysqli_fetch_assoc($wynik)) {
    echo "<div class='mebel'>";

    echo "<div class='obraz'>";
    echo "<img src='fotele/" . htmlspecialchars($wiersz['zdjecie']) . "' alt='mebel'>";
    echo "</div>";

    echo "<div>";
    echo "<h3>" . htmlspecialchars($wiersz['nazwa']) . "</h3>";
    echo "<h4>styl " . htmlspecialchars($wiersz['styl']) . "</h4>";
    echo "<h3>CENA: " . htmlspecialchars($wiersz['cena']) . " zł</h3>";

    echo "<form method='post' action='index.php'>";
    echo "<button type='submit' name='kup' value='" . $wiersz['idMeble'] . "'>KUP</button>";
    echo "</form>";

    echo "</div>";

    echo "<div class='opis'>";
    echo htmlspecialchars($wiersz['opis']);
    echo "</div>";

    echo "</div>";
}

mysqli_stmt_close($stmt);
?>
        

        <h2>- Komody -</h2>

    <?php
$kategoria = 3;

$sql = "SELECT * FROM meble WHERE kategoria = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $kategoria);
mysqli_stmt_execute($stmt);

$wynik = mysqli_stmt_get_result($stmt);

while ($wiersz = mysqli_fetch_assoc($wynik)) {
    echo "<div class='mebel'>";

    echo "<div class='obraz'>";
    echo "<img src='komody/" . htmlspecialchars($wiersz['zdjecie']) . "' alt='mebel'>";
    echo "</div>";

    echo "<div>";
    echo "<h3>" . htmlspecialchars($wiersz['nazwa']) . "</h3>";
    echo "<h4>styl " . htmlspecialchars($wiersz['styl']) . "</h4>";
    echo "<h3>CENA: " . htmlspecialchars($wiersz['cena']) . " zł</h3>";

    echo "<form method='post' action='index.php'>";
    echo "<button type='submit' name='kup' value='" . $wiersz['idMeble'] . "'>KUP</button>";
    echo "</form>";

    echo "</div>";

    echo "<div class='opis'>";
    echo htmlspecialchars($wiersz['opis']);
    echo "</div>";

    echo "</div>";
}

mysqli_stmt_close($stmt);

if (isset($_POST['kup'])) {

    $idMeble = $_POST['kup'];

    $sql = "INSERT INTO zakupy (idKlienta, idMeble)
            VALUES (1, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idMeble);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>
?>

        
    </section>

    <aside>
        <h2>Koszyk</h2>

        <p>Zalogowano: Anna Kowalska</p>

        <?php

$sql = "SELECT meble.nazwa, meble.cena
        FROM meble
        INNER JOIN zakupy
        ON meble.idMeble = zakupy.idMeble
        WHERE zakupy.idKlienta = 1";

$wynik = mysqli_query($conn, $sql);

$koszt = 0;

echo "<ol>";

while ($wiersz = mysqli_fetch_assoc($wynik)) {

    echo "<li>";
    echo htmlspecialchars($wiersz['nazwa']);
    echo ", cena: ";
    echo htmlspecialchars($wiersz['cena']);
    echo "</li>";

    $koszt += $wiersz['cena'];
}

echo "</ol>";

echo "<p>Koszt całkowity: " . $koszt . "</p>";
?>

    </aside>
</main>

<footer>
    <p>Strone wykonal: Tom Pearl</p>
</footer>

</body>
</html>