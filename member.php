<?php

require_once "./src/lib/config.php";
require_once ROOT_PATH . "/src/lib/connect.php";
require_once ROOT_PATH . "/src/classes/Session.php";
require_once ROOT_PATH . "/src/classes/MemberManager.php";
require_once ROOT_PATH . "/src/classes/MembershipManager.php";
require_once ROOT_PATH . "/src/classes/MemberFactory.php";

// on instancie une session pour les messages d'erreur
$session = new Session();

// si un id est passé, on récupère les données relatives au membre
if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $memberManager = new MemberManager($pdo);
    $membershipManager = new MembershipManager($pdo);

    $result = $memberManager->getMember($id);
    // on ajoute toutes les adhésions retournées sous forme d'objet dans un tableau d'objet
    $result['membership'] = array(
        'all' => $membershipManager->getMemberMembership($id),
    );

    // on instancie le membre par l'intermédiaire d'une fabrique
    $member = MemberFactory::create($result);

    // on détermine si le membre fait partie du bureau (pour la vue)
    $isFromOffice = $member->getMemberType() === 1 ? true : false;

}
include ROOT_PATH . "/src/views/member.php";