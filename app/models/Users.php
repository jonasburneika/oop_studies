<?php

namespace App\Models;
use App\Libs\Database;

class Users
{
    public function getUserIdByUserNameAndPassword($username, $password)
    {
        $db = new Database();
        $db->select('id')->from('users')->where('username',$username)->whereAnd('password',$password);
        return (int) $db->execute()->fetch_assoc()['id'];
    }

    public function checkUserName($username){
        $db = new Database();
        $db->select('id')->from('users')->where('username',$username);
        return (int) $db->execute()->fetch_assoc()['id'];
    }

    public function getUserById($id)
    {
        $db = new Database();
        $userData = [];
        $db->select()->from('users')->where('id',$id);
        $basicUserData = $db->execute()->fetch_assoc();
        if (is_array($basicUserData)){
            $userData = array_merge($userData, $basicUserData);
            $db->select(['link','name','icon'])->from('user_social')->leftJoin('soc_networks')->on('user_social.network_id','soc_networks.id')->where('user_id',$id);
            $userData['social'] = mysqli_fetch_all($db->execute(), MYSQLI_ASSOC);
            return $userData;
        } else {
            return false;
        }
    }

    public function addNewUser($parameters)
    {
        
        if ($checkUserExist == false){
            $db = new Database();
            $db->insert('users')->parameters(['username','email','password'])->values([$parameters['username'],$parameters['email'],$parameters['password']]);
            if ($db->execute()) {
                return $this->getUserById($db->lastID());
            } else {
                return false;
            }
        } elseif (is_integer($checkUserExist)){
            return $this->getUserById($checkUserExist);
        } else {
            return false;
        }
    }
    public function getUserSocials($id)
    {
        $db = new Database();
        $db->select()->from('socials')->where('user_id',$id);
        return $db->execute();
    }
    
    public function hashPassword($password){
        return md5(md5($password).md5(salt));
    }
}