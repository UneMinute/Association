<?php
require_once ROOT_PATH . "/src/classes/Member.php";
require_once ROOT_PATH . "/src/classes/OfficeMember.php";

/* classe fabrique permettant d'instancier et d'alimenter 
l'objet membre correspondant au type de membre */

class MemberFactory {
    public static function create($data) 
    {
        switch ($data['member_type']) 
        {
            case 0:
                $member = new Member();
                break;
            case 1:
                $member = new OfficeMember();
                break;
        }
        $member->hydrate($data);
        return $member;
    }

}