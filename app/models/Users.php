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
        $db->select(['id','username','email'])->from('users')->where('id',$id);
        return $db->execute()->fetch_assoc();
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
    
    public function hashPassword($password){
        return md5(md5($password).md5(salt));
    }
}