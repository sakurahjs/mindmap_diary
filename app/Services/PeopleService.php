<?php
namespace App\Services;
use App\FriendRelation;
use App\Mindmap;
use App\Node;
use App\Share;
use App\User;

use App\Constants\FriendConstants;
use App\DB\BaseQueries;

class PeopleService {
    protected $baseQueries;

    public function __construct(BaseQueries $baseQueries) {
        $this->baseQueries = $baseQueries;
    }

    public function search($text = null) {
        $query = $this->baseQueries->getUserBaseQuery();
        
        if ($text === null) {
            return $query->orderBy('updated_at', 'desc')->get();
        } else {
            return $query->where('name', 'like', '%'.$text.'%')->orWhere('email', 'like', '%'.$text.'%')->orderBy('name', 'asc')->get();
        }
    }

    public function getPeopleList($friendOf = null)
    {
        if ($friendOf === null) {
            return $this->baseQueries->getUserBaseQuery()->orderBy('updated_at', 'desc')->get();
        } else {
            $me = User::find($friendOf);

            $query =  $this->baseQueries->getFriendBaseQuery();
            return $query->where('state', '=', FriendConstants::ACCEPTED)
                ->where('email', '<>', $me->email)
                ->where(function($q) {
                            $q->where('user_id', '=', $friendOf)
                            ->orWhere('friend_id', '=', $friendOf);
                        })
                ->orderBy('name', 'asc')->get();
             
        }
    }

    public function getPersonDetail($userId) {
        return User::find($userId);
    }

    public function requestFriend($fromId, $toId) {
        $friendRelation = new FriendRelation;
        $friendRelation->user_id = $toId;
        $friendRelation->from_id = $fromId;
        $friendRelation->state = FriendConstants::REQUESTED;
        $friendRelation->save();

        return $friendRelation->id;
    }

    public function acceptFriend($friend_relation_id) {
        $friendRelation = FriendRelation::find($friend_relation_id);
        $friendRelation->state = FriendConstants::ACCEPTED;
        $friendRelation->save();

        return $friendRelation->id;
    }

    public function cancelFriend($friend_relation_id) {
        FriendRelation::destroy($friend_relation_id);
    }

    // public function modifyEmail($userId, $email) {

    // }
    
    public function uploadPhoto($userId, $photo) {
        $user = User::find($userId);
        $user->photo_url = $photo;
        $user->save();

        return $user->id;
    }

    public function modifyName($userId, $name) {
        $user = User::find($userId);
        $user->name = $name;
        $user->save();

        return $user->id;
    }

    public function modifyIntroduction($userId, $introduction) {
        $user = User::find($userId);
        $user->introduction = $introduction;
        $user->save();

        return $user->id;
    }
}