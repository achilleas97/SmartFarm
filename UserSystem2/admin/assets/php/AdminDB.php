<?php
require_once 'AdminConfig.php';
class Admin extends Database{
    public function admin_login($username,$password){
        $sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username'=>$username, 'password'=>$password]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function users(){
        $sql = "SELECT id, name, email, created_at, verified, deleted FROM users";
        $stmt = $this-> conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function userCheck($id){
        $sql = "SELECT id, name, email, created_at, verified, deleted, token FROM users WHERE id=:id";
        $stmt = $this-> conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete_user($id){
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this-> conn->prepare($sql);
        $stmt-> execute(['id'=>$id]);
        return true;
    }

    public function updateUser($id, $deleted){  
        $sql = "UPDATE users SET deleted = :deleted WHERE id = :id";
        $stmt = $this-> conn-> prepare($sql);
        $stmt-> execute(['id'=>$id, 'deleted'=>$deleted]);
        return true; 
    }

    public function network($uid){
        $sql = "SELECT id, name, position, created_at FROM network WHERE uid = :uid";
        $stmt = $this-> conn->prepare($sql);
        $stmt->execute(['uid'=>$uid]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function countSystem($nid){
        $sql = "SELECT count(id) As systems FROM system WHERE nid = :nid";
        $stmt = $this-> conn->prepare($sql);
        $stmt->execute(['nid'=>$nid]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }


    public function delete_net($id){
        $sql = "DELETE FROM network WHERE id = :id";
        $stmt = $this-> conn->prepare($sql);
        $stmt-> execute(['id'=>$id]);
        return true;
    }
}
?>