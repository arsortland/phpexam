<?php
include "topp.inc.php";
include "funcs.inc.php";

$personarr = array();
$beskrivelsearr = array();

$db = kobleTil();

$sql = "SHOW TABLES";
$resultat = $db->query($sql);
echo "<h2>Hvem vil du se ordskyen/data fra?:</h2>";


while ($tables = $resultat->fetch_array()){
   array_push($personarr, $tables[0]);
}
$db->close();
?>

<form action="" method="post">
    <div>
        <label for="person">Velg person:</label>
        <select name="person" id="person">
            <?php
            foreach ($personarr as $person){
                echo "<option value='$person'>".ucfirst($person)."</option>";
            }
            ?>
        </select>
    </div><br>
    <label for="vismeg">Vis data:</label>
    <input type="submit" value="   Vis   " name="vismeg">
</form>

<?php

if (isset($_POST['vismeg'])){

    $person = $_POST['person'];

    $db = kobleTil();

    $sql = "SELECT * FROM ".$person."";
    $resultat = $db->query($sql);

    echo "<h3> Viser data for ".ucfirst($person).":</h3>";
    echo "<p>Jo større ordet er jo flere ganger har det blitt benyttet som beskrivelse</p>";
    while ($nesterad = $resultat->fetch_assoc()){
        array_push($beskrivelsearr, $nesterad['beskrivelse1']);
        array_push($beskrivelsearr, $nesterad['beskrivelse2']);
        array_push($beskrivelsearr, $nesterad['beskrivelse3']);
    }
}

$antallarr = array_count_values($beskrivelsearr);


foreach ($antallarr as $key=>$value){
    //Lager en randomisert farge til hvert html element.
    $color = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
    //setter størrelse i rem basert på antall ganger beskrivelsen forekommer.
    echo "<span style=font-size:".$value."rem;color:#".$color.";>".$key." ";
}
echo "</span>";

?>


<br><br><a href="index.php">Tilbake til startsiden</a>

<?php
include "bunn.inc.php";
?>