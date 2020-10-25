<?php 

class Membership {

    protected $id;
    protected $startingDate;
    protected $endingDate;
    protected $member;   
    protected $active; 
    protected $isCurrent;

    public function hydrate($data) {

        $id = isset($data["id"]) ? $data["id"] : NULL;
        $member = isset($data["member"]) ? $data["member"] : $data["memberId"];
        $active = isset($data["active"]) ? $data["active"] : NULL;
        
        $this->setId($id);
        $this->setStartingDate($data["startingDate"]);
        $this->setEndingDate($this->calculateEndingDate());        
        $this->setMember($member);
        $this->setActive($active);        
        $this->setIsCurrent($this->checkIfCurrent());
    }
    
    // méthode permettant de calculer la date de fin de l'adhésion
    public function calculateEndingDate() {

        return date('Y-m-d', strtotime('+1 year', strtotime($this->startingDate)));
    }
    // méthode permettant de savoir si l'adhésion est en cours (pour affichage)
    public function checkIfCurrent() {

        $now = date("Y-m-d");
        return (($now >= $this->startingDate) && ($now <= $this->endingDate));

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setStartingDate($date) {
        $this->startingDate = $date;
    }

    public function setEndingDate($date) {
        $this->endingDate = $date;
    }

    public function setMember($data) {
        $this->member = $data;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setIsCurrent($isCurrent) {
        $this->isCurrent = $isCurrent;
    }

    public function getId() {
        return $this->id;
    }

    public function getStartingDate() {
        return $this->startingDate;
    }

    public function getEndingDate() {
        return $this->endingDate;
    }

    public function getMember() {
        return $this->member;
    }
    
    public function getActive() {
        return $this->active;
    }

    public function getIsCurrent() {
        return $this->isCurrent;
    }
}