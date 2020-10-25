<?php
require_once "../src/lib/config.php";
require_once ROOT_PATH . "/src/lib/connect.php";
require_once ROOT_PATH . "/src/classes/Session.php";
require_once ROOT_PATH . "/src/classes/MembershipManager.php";

$session = new Session();
$membershipManager = new MembershipManager($pdo);

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $membership = $membershipManager->deleteMembership($id);
    
    $session->setMessage("Adhésion supprimée avec succès", "success");

}
// on redirige vers la page des adhésions
header("Location: ../membership.php");