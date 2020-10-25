<?php
require_once "../src/lib/config.php";
require_once ROOT_PATH . "/src/lib/connect.php";
require_once ROOT_PATH . "/src/classes/Session.php";
require_once ROOT_PATH . "/src/classes/MemberManager.php";

$session = new Session();
$memberManager = new MemberManager($pdo);

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $members = $memberManager->deleteMember($id);

    $session->setMessage("Membre supprimé avec succès", "success");

}

header("Location: ../");