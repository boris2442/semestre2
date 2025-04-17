<?php
define('DBHOST', "localhost");
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'bureau_etude');
$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('erreur de connexion:' . $e->getMessage());
}
