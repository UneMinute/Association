<?php
require_once "../src/lib/config.php";
require_once ROOT_PATH . "/src/lib/connect.php";
require_once ROOT_PATH . "/src/classes/Session.php";
require_once ROOT_PATH . "/src/classes/MemberManager.php";
require_once ROOT_PATH . "/src/classes/MemberFactory.php";

$session = new Session();
$memberManager = new MemberManager($pdo);

$data = $_POST;
/*  on ajoute aux données récupérées une valeur member_type
    qui permet de déterminer si le membre est du bureau ou non */
if (isset($data['office']))
    $data['member_type'] = 1;
else 
    $data['member_type'] = 0;

// on instancie le membre par l'intermédiaire de la fabrique
$member = MemberFactory::create($data);    

$id = isset($data["id"]) ? $data["id"] : NULL;

// si un id existe, on modifie le membre
if ($id) {

    // si le membre est de bureau
    if($data['member_type'] === 1)
        $members = $memberManager->updateOfficeMember($member);
    else // sinon
        $members = $memberManager->updateMember($member);
    
    $session->setMessage("Membre modifié avec succès", "success");

}
// sinon on crée le membre
else {

    // si le membre est de bureau
    if($data['member_type'] === 1)
        $id = $memberManager->createOfficeMember($member);
    else // sinon
        $id = $memberManager->createMember($member);

    $session->setMessage("Membre créé avec succès", "success");

}
// on redirige vers la fiche du membre en question
header("Location: ../member.php?id={$id}");