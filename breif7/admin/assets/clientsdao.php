<?php
include("connection.php");
include("productpoo.php");


class clientsDAO {
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function get_clients(){
        $query = "SELECT * FROM clients";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $clientsData = $stmt->fetchAll();
        $clients = array();
        foreach ($clientsData as $P) {
            $clients[] = new clients($P["full_name"],$P["username"],$P["email"],  $P["password"],$P["adresse"],$P["ville"],$P["phone"]
            );
        }
        return $clients;

    }
    public function insert_clients($clients)
    {
        $query = "INSERT INTO clients (full_name, username, email, password, adresse, ville, phone) 
                  VALUES (:full_name, :username, :email, :password, :adresse, :ville, :phone)";

        $stmt = $this->db->prepare($query);

        $full_name = $clients->getfull_name();
        $username = $clients->getusername();
        $email = $clients->getemail();
        $password = $clients->getpassword();
        $adresse = $clients->getadresse();
        $ville = $clients->getville();
        $phone = $clients->getphone();
        

        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':phone', $phone);


        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
       
}
public function update_clients($clients)
    {
        $query = "UPDATE clients SET 
                  full_name = :full_name, 
                  email = :email,
                  password = :password,
                  adresse = :adresse,
                  ville = :ville,
                  phone = :phone,
                  WHERE username = :username";

        $stmt = $this->db->prepare($query);

        $full_name = $clients->getfull_name();
        $username = $clients->getusername();
        $email = $clients->getemail();
        $password = $clients->getpassword();
        $adresse = $clients->getadresse();
        $ville = $clients->getville();
        $phone = $clients->getphone();

        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':phone', $phone);

        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function delete_product($id)
    {
        $query = "UPDATE products SET isHide = 1 WHERE reference = :id";
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
// $prDAO = new ProductDAO();
// $prDAO->delete_product(30);
?>