<?php
require_once ROOT_PATH . "/src/classes/Member.php";
require_once ROOT_PATH . "/src/classes/OfficeMember.php";

class MemberManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {

        $sql = "SELECT *
            FROM member
            WHERE active = 1
            ORDER BY name ASC";

        $request = $this->pdo->prepare($sql);
        $request->execute();
    
        return $request->fetchAll();       

    }

    public function getMember($id) {

        $sql = "SELECT *
            FROM member
            WHERE id = ?";

        $request = $this->pdo->prepare($sql);
        $request->execute([$id]);
    
        return $request->fetch(PDO::FETCH_ASSOC);      

    }

    /*  pour simplifier le processus, j'aurais pu créer une méthode de 
        type fabrique qui, afin de créer le membre, appelerait l'une 
        des deux méthodes ci-dessous en fonction du type de membre passé  */
    public function createMember($member) {

        $sql = "INSERT INTO member(name, firstname, member_type) 
            VALUES(:name, :firstname, :memberType)";

		$request = $this->pdo->prepare($sql);
		$request->execute(
			[
				":name" => $member->getName(),
				":firstname" => $member->getFirstname(),
				":memberType" => $member->getMemberType(),
			]
		);

        return $this->pdo->lastInsertId();
        
    }

    public function createOfficeMember($member) {

        $sql = "INSERT INTO member(name, firstname, member_type, position) 
            VALUES(:name, :firstname, :memberType, :position)";

		$request = $this->pdo->prepare($sql);
		$request->execute(
			[
				":name" => $member->getName(),
				":firstname" => $member->getFirstname(),
				":memberType" => $member->getMemberType(),
				":position" => $member->getPosition(),
			]
		);

        return $this->pdo->lastInsertId();
        
    }

    /*  pour simplifier le processus, j'aurais pu créer une méthode de 
        type fabrique qui, afin de mettre à jour le membre, appelerait l'une 
        des deux méthodes ci-dessous en fonction du type de membre passé  */
    public function updateMember($member) {

        $sql = "UPDATE member
            SET name = :name, firstname = :firstname, member_type = :memberType
            WHERE id = :id";

        $request = $this->pdo->prepare($sql);
        $request->execute(
            [
				":name" => $member->getName(),
				":firstname" => $member->getFirstname(),
				":memberType" => $member->getMemberType(),
				":id" => $member->getId(),
			]
        );
        
    }

    public function updateOfficeMember($member) {

        $sql = "UPDATE member
            SET name = :name, firstname = :firstname, member_type = :memberType, position = :position
            WHERE id = :id";

        $request = $this->pdo->prepare($sql);
        $request->execute(
            [
				":name" => $member->getName(),
				":firstname" => $member->getFirstname(),
				":memberType" => $member->getMemberType(),
				":position" => $member->getPosition(),
				":id" => $member->getId(),
			]
        );
        
    }

    /*  j'ai choisi de créer une colonne 'active' afin de simuler la suppression du membre
        avec un DELETE cela donnerait :
            "DELETE from member
            WHERE id = ?"
    */
    public function deleteMember($id) {

        $sql = "UPDATE member
            SET active = 0
            WHERE id = ?";

        $request = $this->pdo->prepare($sql);
        $request->execute([$id]);        
    }
    
}