<?php
include "topp.inc.php";
include "funcs.inc.php";
?>
<h1>Her kan du opprette tabeller for personer du ønsker å lage ordsky for:</h1>
<form action="" method="post">
    <div>
        <label for="tabellnavn">Navn på person du ønsker ordsky for:</label>
        <input type="text" name="tabellnavn" placeholder="Ola"><br>
    </div>
    <label for="tabell">Klikk for å lage tabell</label>
    <input type="submit" value="Opprett" name="tabell">
</form>
<?php
//Her burde jeg ha hatt bedre feilsikring på input for å sørge for at det er navn og ikke andre ting som blir lagt inn!
if (isset($_POST['tabell'])){
    $tabellnavn = $_POST['tabellnavn'];
    $tabellnavn = strtolower($tabellnavn);
    if ($tabellnavn == ''){
        echo "Du må skrive inn et navn";
        exit;
    }

    $db = kobleTil();

    $sql = "CREATE TABLE ".$tabellnavn." (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        beskrivelse1 VARCHAR ( 50 ) NOT NULL,
        beskrivelse2 VARCHAR ( 50) ,
        beskrivelse3 VARCHAR ( 50)
        )";

    if ($db->query($sql)){
        echo "<p><b>Tabellen ble opprettet!</b></p><br>";
        //Velger å la denne stå nå, men dette burde selvfølgelig ikke vært med om reelle brukere skulle ha benyttet dette.
        echo "<b>Spørring som ble kjørt:</b><pre>$sql</pre>";
    }
    else {
        echo "<p>Tabellen finnes allerede!</p>";
    }
    $db->close();
}

echo "<br><p><a href='index.php'>Tilbake til startsiden</a>";
include "bunn.inc.php";
?>
