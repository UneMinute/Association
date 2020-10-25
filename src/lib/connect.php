<?php

const DBNAME = "association";
const DBUSER = "root";
const DBPASS = "";

const OPTIONS = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_EMULATE_PREPARES   => false,
];

const DSN = "mysql:host=localhost;dbname=" . DBNAME . ";charset=utf8";

try {

	$pdo = new PDO(DSN, DBUSER, DBPASS, OPTIONS);

} catch (Exception $error) {

	die('Erreur : ' . $error->getMessage());
	
}