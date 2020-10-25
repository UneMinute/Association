<?php 

class Member {

    protected $id;
    protected $name;
    protected $firstname;
    protected $subscriptionDate; 
    protected $member_type; 
    protected $active;     
    protected $membership;

    public function hydrate($data) {

        $id = isset($data["id"]) ? $data["id"] : NULL;        
        $subscriptionDate = isset($data["subscriptionDate"]) ? $data["subscriptionDate"] : date("Y-m-d H:i:s");
        $membership = isset($data["membership"]) ? $data["membership"] : NULL;

        $this->setId($id);
        $this->setName($data["name"]);
        $this->setFirstname($data["firstname"]);
        $this->setSubscriptionDate($subscriptionDate);
        $this->setMemberType($data["member_type"]);
        $this->setActive(1);
        $this->setMembership($membership);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setSubscriptionDate($subscriptionDate) {
        $this->subscriptionDate = $subscriptionDate;
    }

    public function setMemberType($memberType) {
        $this->member_type = $memberType;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setMembership($membership) {
        $this->membership = $membership;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getSubscriptionDate() {
        return $this->subscriptionDate;
    }

    public function getMemberType() {
        return $this->member_type;
    }

    public function getActive() {
        return $this->active;
    }

    public function getMembership() {
        return $this->membership;
    }
}