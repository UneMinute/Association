<?php 

require_once "./src/lib/config.php";
require_once ROOT_PATH . "/src/lib/connect.php";
require_once ROOT_PATH . "/src/classes/Session.php";
require_once ROOT_PATH . "/src/classes/MemberManager.php";
require_once ROOT_PATH . "/src/classes/MembershipManager.php";
require_once ROOT_PATH . "/src/classes/MemberFactory.php";

// on instancie une session pour les messages d'erreur
$session = new Session();

// on instancie les managers
$memberManager = new MemberManager($pdo);
$membershipManager = new MembershipManager($pdo);

$members = [];
$officeMembers = [];

// on récupère tous les membres
foreach($memberManager->getAll() as $row) {

    // auxquels on ajoute :
    $memberId = $row['id'];
    $row['membership'] = array(
        // l'objet Membership retourné de la dernière adhésion
        'last'    => $membershipManager->getLastMembership($memberId),
        // l'objet Membership retourné de l'adhésion en cours si elle existe
        'ongoing' => $membershipManager->ongoingMembership($memberId),
    );

    // puis on insère chaque élément dans le tableau correspondant à leur type (bureau ou non)
    switch ($row['member_type']) {
        case 0:        
            array_push($members, MemberFactory::create($row));
            break;
        case 1:        
            array_push($officeMembers, MemberFactory::create($row));
            break;
    }
}
// on affiche la vue
include ROOT_PATH . "/src/views/index.php";
