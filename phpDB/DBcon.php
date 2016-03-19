<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'pizza';

try {
    $db = new PDO('mysql:host='.$host. ';dbname='.$database, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("SET SESSION sql_mode = 'ANSI,ONLY_FULL_GROUP_BY'");
}
catch(PDOException $e) {
    $msg = '
        <p>
            Regelnummer: '.$e->getLine().'<br />
            Bestand: '.$e->getFile(). '<br />
            Foutmelding: '.$e->getMessage().'
        </p>
        ';
   trigger_error($msg);
}
?>