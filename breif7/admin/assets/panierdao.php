<?php
include("connection.php");
include("productpoo.php");


class panierDAO {
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function get_panier(){
        $query = "SELECT * FROM panier";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $panierData = $stmt->fetchAll();
        $panier = array();
        foreach ($panier as $P) {
            $panier[] = new panier($P["client_username"],$P["product_re"],$P["descpt"]
            );
        }
        return $panier;

    }
    public function insert_panier($panier)
    {
        $query = "INSERT INTO panier (client_username, product_re, qnt) 
                  VALUES (:client_username, :product_re, :qnt)";

        $stmt = $this->db->prepare($query);

        $reference = $panier->getclient_username();
        
        $etiquette = $panier->getproduct_re();
        $descpt = $panier->getqnt();
       

        $stmt->bindParam(':client_username', $client_username);
        $stmt->bindParam(':product_re', $product_re);
        $stmt->bindParam(':qnt', $qnt);
       

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
       
}
public function update_panier($panier)
    {
        $query = "UPDATE panier SET 
                  product_re = :product_re, 
                  qnt = :qnt,
                  WHERE client_username = :client_username";

        $stmt = $this->db->prepare($query);

        $reference = $panier->getclient_username();
        $etiquette = $panier->getproduct_re();
        $descpt = $panier->getqnt();

        
        $stmt->bindParam(':client_username', $client_username);
        $stmt->bindParam(':product_re', $product_re);
        $stmt->bindParam(':qnt', $qnt);
       

        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function delete_panier($id)
    {
        $query = "UPDATE panier WHERE client_username = :id";
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