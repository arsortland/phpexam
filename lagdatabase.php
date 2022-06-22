<?php
include "topp.inc.php";
//Velger at denne skal være hardkodet. Dette gjør det lettere å legge inn tabeller riktig.
//Utføres bare en gang.
?>
<h1>Opprett Database:</h1><br>
<div class="dbform">
    <form action="" method="post">
        <label for="dbnavn">Klikk for å opprette:</label>
        <input type="submit" value="Opprett DB" name="dbnavn">
    </form>
</div>

<?php

if (isset($_POST['dbnavn'])){

    $databasen = new mysqli("localhost", "root", "root");
    $databasen->query("CREATE DATABASE beskrivelser");
?>
    <br><h3>Databasen "beskrivelser" ble opprettet</h3><br>
<?php
}
echo "<a href='index.php'>Gå tilbake til startsiden</a>";
include "bunn.inc.php";
?>