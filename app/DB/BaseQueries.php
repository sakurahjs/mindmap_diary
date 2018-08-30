<?php
namespace App\DB;

class BaseQueries {
    protected function getUserBaseQuery() {
        return DB::table('users')->select('id', 'name', 'email', 'photo_url', 'introduce');
    }

    protected function getFriendBaseQuery() {
        $first = DB::table('users')
                ->join('friend_relations', 'users.id', '=', 'friend_relations.user_id');
                    
        $second = DB::table('users')
                ->join('friend_relations', 'users.id', '=', 'friend_relations.friend_id');
                
        $union = $second->union($first);
        
        return $union->select('friend_relations.id as friend_relation_id', 'users.name as name', 'users.email as email', 'users.photo_url as photo_url', 'users.introduce as introduce', 'friend_relations.user_id as user_id', 'friend_relations.friend_id as friend_id', 'friend_relations.state as state');
    }
}