<?php 
require_once ROOT_PATH . "/src/classes/Member.php";

class OfficeMember extends Member {

    private $position;
   
    public function hydrate($data) {

        $id = isset($data["id"]) ? $data["id"] : NULL;        
        $subscriptionDate = isset($data["subscriptionDate"]) ? $data["subscriptionDate"] : date("Y-m-d H:i:s");
        $membership = isset($data["membership"]) ? $data["membership"] : NULL;

        $this->setId($id);
        $this->setName($data["name"]);
        $this->setFirstname($data["firstname"]);
        $this->setSubscriptionDate($subscriptionDate);         
        $this->setMemberType($data["member_type"]);       
        $this->setPosition($data["position"]);
        $this->setActive(1);
        $this->setMembership($membership);
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function getPosition() {
        return $this->position;
    }
}