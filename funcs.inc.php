<?php
#Funksjon som tar seg av oppkobling til database.

function kobleTil ($databasenavn="beskrivelser"){
    $db = new mysqli("localhost", "root", "root", $databasenavn);
    return $db;
}

?>