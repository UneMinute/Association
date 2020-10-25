<?php
require_once "../src/lib/config.php";
require_once ROOT_PATH . "/src/lib/connect.php";
require_once ROOT_PATH . "/src/classes/Session.php";
require_once ROOT_PATH . "/src/classes/Membership.php";
require_once ROOT_PATH . "/src/classes/MembershipManager.php";

$session = new Session();

$data = $_POST;
// on instancie l'adhésion
$membership = new Membership();
// que l'on alimente avec les données du formulaire
$membership->hydrate($data);

$membershipManager = new MembershipManager($pdo);

// s'il existe une adhésion sur la même période que l'adhésion à ajouter
if ($membershipManager->findOverlapMembership($membership)) {

    // alors on retourne un message d'erreur
    $session->setMessage("Une adhésion pour ce membre est déjà en cours durant cette période", "danger");

} else {

    // sinon on l'ajoute
    $membership = $membershipManager->createMembership($membership);
    // et on lance un message d'erreur
    $session->setMessage("Nouvelle adhésion bien ajoutée !", "success");
}
// on redirige vers la fiche membre
header("Location: ../member.php?id={$data['member']}");

