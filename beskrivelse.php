<?php
include "topp.inc.php";
include "funcs.inc.php";
?>

<?php
$testarr = array();
 $db = kobleTil();

$sql = "SHOW TABLES";
$resultat = $db->query($sql);
echo "<h2>Følgende navn finnes i databasen:</h2>";

while ($tables = $resultat->fetch_array()){
    echo ucfirst($tables[0])."<br>";
    array_push($testarr, $tables[0]);
}
echo "<p>Savner du et navn må du gå tilbake og opprette dette.</p>";
$db->close();
?>

<h1>Skriv inn beskrivelsene dine her:</h1>

<form action="" method="post">
    <div>
        <label for="hvem">Hvem beskriver du?:</label>
        <select name="hvem" id="hvem">
            <?php
            //legger til alle tabellnavn som dropdown meny. Gjør det lettere for bruker og minimerer risiko for feilinput da denne verdien benyttes til spørringen også.
            foreach ($testarr as $person){
                echo "<option value='$person'>".ucfirst($person)."</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <!---- Setter required for å unngå tomme felt --->
        <label for="besk1">Beskrivende ord</label>
        <input type="text" name="besk1" required>
    </div>
    <div>
        <label for="besk2">Beskrivende ord</label>
        <input type="text" name="besk2" required>
    </div>
    <div>
        <label for="besk3">Beskrivende ord</label>
        <input type="text" name="besk3" required>
    </div>
    <input type="submit" name="leggtil" id="leggtil">
</form>

<?php

if (isset($_POST['leggtil'])){
    //Sørger for at kun første bokstav er stor (OBS:Berører ikke særnorske bokstaver)
    $hvem = $_POST['hvem'];
    $hvem = strtolower($hvem);

    $besk1 = $_POST['besk1'];
    $besk1 = strtolower($besk1);
    $besk1 = ucfirst($besk1);
    $besk2 = $_POST['besk2'];
    $besk2 = strtolower($besk2);
    $besk2 = ucfirst($besk2);
    $besk3 = $_POST['besk3'];
    $besk3 = strtolower($besk3);
    $besk3 = ucfirst($besk3);

    #Benytter meg av prepared statement.
    $db = kobleTil();

    $sql = "INSERT INTO ".$hvem."
    (beskrivelse1, beskrivelse2, beskrivelse3)
    VALUES
    (?,?,?)
    ";

    $statement = $db->prepare($sql);
    $statement->bind_param("sss", $besk1,$besk2,$besk3);

    $statement->execute();
    echo "<p>Tabellen er oppdatert med nytt innhold!</p>";
    echo "<p> $besk1, $besk2 og $besk3 er lagt til som beskrivelse til ".ucfirst($hvem)."";

    $statement->close();
    $db->close();
}

?>



<a href="index.php">Tilbake til startsiden</a>
<?php
include "bunn.inc.php";
?>