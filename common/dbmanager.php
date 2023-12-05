<?php
class DBManager{

    private $access_info;
    
    private $user;
    
    private $password;
    
    private $db = null;

    function __construct(){
        $this->access_info = "mysql:host=localhost;dbname=school";
        $this->user = "root";
        $this->password = "root";
    }
    
    private function connect(){
        $this->db = new PDO($this->access_info, $this->user, $this->password);
    }
    
    private function disconnect(){
        $this->db = null;
    }
    
    function get_allstudents(){
        try{
            $this->connect();
            $stmt = $this->db->prepare("SELECT * FROM student ORDER BY id");
            $res = $stmt->execute();
            if($res){
                $member = $stmt->fetchAll();
                $this-> disconnect();
                return $member;
            }
        } catch(PDOException $e) {
            $this->disconnect();
            return null;
        }
        $this->disconnect();
        return null;
    }

    function get_student($id){
        try{
            $this->connect();
            $stmt = $this->db->prepare("SELECT * FROM student WHERE id = ? ;");
            $stmt->bindParam(1,$id,PDO::PARAM_INT);
            $res = $stmt->execute();
            if($res){
                $member = $stmt->fetchAll();
                $this->disconnect();
                if(count($member) == 0){
                    return null;
                }
                return $member[0];
            }
        } catch(PDOException $e) {
            $this->disconnect();
            return null;
        }
        $this->disconnect();
        return null;
    }

        function if_id_exists($id){
            if ($this->get_student($id) !=null){
                return true;
            }
            return false;
        }

        function insert_student($id, $name, $grade){
            try{
                $this->connect();
                $stmt = $this->db->prepare("INSERT INTO student VALUES(?,?,?);");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->bindParam(2, $name, PDO::PARAM_STR);
                $stmt->bindParam(3, $grade, PDO::PARAM_INT);
                $res = $stmt->execute();
                $this->disconnect();
                return true;
            } catch(PDOException $e) {
                $this->disconnect();
                return false;
            }
            $this->disconnect(); 
            return false;
        }

        function delete_student($id){
            try{
            $this->connect();
                $stmt = $this->db->prepare("DELETE FROM student WHERE id=?;");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $res = $stmt->execute();
                $this->disconnect();
                return true;
            } catch(PDOException $e) {
                $this->disconnect();
                return false;
            }
            $this->disconnect(); 
            return false;
        }

        function update_student($id, $name, $grade, $old_id) {
            try{
                $this->connect();
                $stmt = $this->db->prepare("UPDATE student SET id=?,name=?,grade=?,WHERE id=?;");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->bindParam(2, $name, PDO::PARAM_STR);
                $stmt->bindParam(3, $grade, PDO::PARAM_INT);
                $stmt->bindParam(4, $old_id, PDO::PARAM_INT);
                $res = $stmt->execute();
                return true;
            } catch(PDOException $e) {
                $this->disconnect();
                return false;
            }
            $this->disconnect(); 
            return false;
        }
}
?>

