<?php 
require_once "./src/lib/config.php";
require_once ROOT_PATH . "/src/lib/connect.php";
require_once ROOT_PATH . "/src/classes/Session.php";
require_once ROOT_PATH . "/src/classes/MemberManager.php";
require_once ROOT_PATH . "/src/classes/MembershipManager.php";
require_once ROOT_PATH . "/src/classes/MemberFactory.php";

$session = new Session();
$membershipManager = new MembershipManager($pdo);
$memberManager = new MemberManager($pdo);

// on récupère les données liées aux adhésions
$results = $membershipManager->getAll();

$allMembership = [];

foreach($results as $row) {

    // on ajoute aux données retournées un objet Membre lié à chaque adhésion
    $memberData = $memberManager->getMember($row['memberId']);
    $row['member'] = MemberFactory::create($memberData);

    // on instancie l'adhésion
    $membership = new Membership();
    $membership->hydrate($row);
    array_push($allMembership, $membership);

}

include ROOT_PATH . "/src/views/membership.php";