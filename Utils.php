<?php
//Connessione DB
$db = new mysqli("127.0.0.1","root","","questionario");

//QUERY
$queryCat = "SELECT categoria FROM domanda";
$resultCat = $db->query($queryCat);


?>