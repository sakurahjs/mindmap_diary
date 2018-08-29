<?php
namespace App\Services;
use App\Friend;
use App\Mindmap;
use App\Node;
use App\Share;
use App\User;

class PeopleService {
    public function search($text = null) {

    }

    public function getPeopleList($friendOf = null)
    {
        # code...
    }

    public function getPersonDetail($userId) {

    }

    public function requestFriend($fromId, $toId) {

    }

    public function acceptFriend($fromId, $toId) {

    }

    public function cancelFriend($fromId, $toId) {

    }

    // public function modifyEmail($userId, $email) {

    // }
    
    public function uploadPhoto($userId, $photo) {

    }

    public function modifyName($userId, $name) {

    }

    public function modifyIntroduction($userId, $introduction) {

    }
}