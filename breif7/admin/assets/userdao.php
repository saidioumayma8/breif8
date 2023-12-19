<?php
include("connection.php");
include("userpoo.php");


class usersDAO {
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function get_users(){
        $query = "SELECT * FROM users";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $usersData = $stmt->fetchAll();
        $users = array();
        foreach ($usersData as $P) {
            $Products[] = new users(
                $P["email"], $P["usename"], $P["pass"], $P["state"],  $P["role"]
            );
        }
       
    }
    public function insert_users($Product)
    {
           $query = "INSERT INTO users ( email, username, pass, state, role ) 
                  VALUES (:email, :username, :pass, :state, :role )";

        $stmt = $this->db->prepare($query);

        $email = $Product->getemail();        
        $login = $Product->getusername();
        $pass = $Product->getpass();
        $codeBarres = $Product->getstate();
        $img = $Product->getrole();
       

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $username);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':is_admin', $state);
        $stmt->bindParam(':is_approved', $role);
       


        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
       
}
public function update_users($users)
    {
        $query = "UPDATE users SET 
                  email = :email,
                  pass = :pass,
                  state = :state,
                  role = :role,
                  WHERE username = :username";

        $stmt = $this->db->prepare($query);

        $email = $users->getemail();
        $username = $users->getusername();
        $pass = $users->getpass();
        $state = $users->getstate();
        $role = $users->getrole();
        
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':role', $role);
       

        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function delete_users($id)
    {
        $query = "UPDATE users  WHERE email = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            echo "Record deleted successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

?>