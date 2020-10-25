<?php
require_once ROOT_PATH . "/src/classes/Membership.php";

class MembershipManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {

        // on ne récupère que les adhésions des membres actifs
        $sql = "SELECT membership.id, startingDate, endingDate, memberId
        FROM membership 
        LEFT JOIN member ON memberId = member.id 
        WHERE membership.active = 1 
        AND member.active = 1 
        ORDER BY startingDate DESC";

        $request = $this->pdo->prepare($sql);
        $request->execute();
    
        return $request->fetchAll();        

    }

    public function getMemberMembership($memberId) {

        $allMembership = [];

        $sql = "SELECT *
            FROM membership
            WHERE memberId = ?
            AND active = 1
            ORDER BY startingDate DESC;";

        $request = $this->pdo->prepare($sql);
        $request->execute([$memberId]);
    
        $results = $request->fetchAll();

        foreach($results as $row) {

            $row['member'] = $memberId;
            $membership = new Membership();
            
            $membership->hydrate($row);
            array_push($allMembership, $membership);
        }

        return $allMembership;        

    }

    public function createMembership($membership) {

        $sql = "INSERT INTO membership(startingDate, endingDate, memberId) 
            VALUES(:startingDate, :endingDate, :memberId)";

		$request = $this->pdo->prepare($sql);
		$request->execute(
			[
				":startingDate" => $membership->getStartingDate(),
				":endingDate" => $membership->getEndingDate(),
                ":memberId" => $membership->getMember(),
			]
		);

        return $this->pdo->lastInsertId();
        
    }

    public function updateMembership($membership) {

        $sql = "UPDATE membership
            SET startingDate = :startingDate, endingDate = :endingDate
            WHERE id = :id";

        $request = $this->pdo->prepare($sql);
        $request->execute(
            [
				":startingDate" => $member->getStartingDate(),
				":endingDate" => $member->getEndingDate(),
			]
        );
        
    }
    
    /*  j'ai choisi de créer une colonne 'active' afin de simuler la suppression de l'adhésion
        avec un DELETE cela donnerait :
            "DELETE from membership
            WHERE id = ?"
    */
    public function deleteMembership($id) {

        $sql = "UPDATE membership
            SET active = 0
            WHERE id = ?";

        $request = $this->pdo->prepare($sql);
        $request->execute([$id]);        
    }

    /*  retourne l'adhésion sur la même période que l'adhésion 
        passée en argument si elle existe */
    public function findOverlapMembership($membership) {

        $sql = "SELECT *
            FROM membership
            WHERE memberId = :memberId
            AND active = 1
            AND startingDate <= :endingDate
            AND endingDate >= :startingDate
            LIMIT 1";

        $request = $this->pdo->prepare($sql);
        $request->execute(
            [
				":startingDate" => $membership->getStartingDate(),
				":endingDate" => $membership->getEndingDate(),
				":memberId" => $membership->getMember(),
			]
        );
    
        return $request->fetch(PDO::FETCH_ASSOC);
    }
    // récupère la dernière adhésion en fonction d'un id de membre donné
    public function getLastMembership($memberId) {

        $sql = "SELECT *, MAX(startingDate)
            FROM membership 
            WHERE memberId = ? 
            AND active = 1";

        $request = $this->pdo->prepare($sql);
        $request->execute([$memberId]);

        $result = $request->fetch(PDO::FETCH_ASSOC);

        $membership = new Membership();
        $membership->hydrate($result);
    
        return $membership;

    }
    /*  récupère l'adhésion en cours en fonction d'un id de membre donné 
        si elle existe, sinon retourne NULL */
    public function ongoingMembership($memberId) {

        $sql = "SELECT * 
            FROM membership 
            WHERE memberId = ?
            AND NOW() BETWEEN startingDate and endingDate
            AND active = 1";

        $request = $this->pdo->prepare($sql);
        $request->execute([$memberId]);
    
        $result = $request->fetch(PDO::FETCH_ASSOC);

        if (!$result) return NULL;

        $membership = new Membership();
        $membership->hydrate($result);
    
        return $membership;

    }
}