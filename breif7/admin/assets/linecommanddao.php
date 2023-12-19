<?php
include("connection.php");
include("productpoo.php");


class linecommandDAO {
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function get_product(){
        $query = "SELECT * FROM linecommand";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $linecommandData = $stmt->fetchAll();
        $linecommand = array();
        foreach ($linecommandData as $P) {
            $Products[] = new linecommand($P["command_id"],$P["product_ref"],$P["qnt"]
            );

        }
        return $linecommand;

    }
    public function insert_linecommand($linecommand)
    {
        $query = "INSERT INTO linecommand (reference, etiquette, descpt, codeBarres, img, prixAchat, prixFinal, prixOffre, qntMin, qntStock, catg) 
                  VALUES (:reference, :etiquette, :descpt, :codeBarres, :img, :prixAchat, :prixFinal, :prixOffre, :qntMin, :qntStock, :catg)";

        $stmt = $this->db->prepare($query);

        $command_id = $linecommand->getRef();
        $product_ref = $linecommand->getEtqt();
        $qnt = $linecommand->getDesc();

        $stmt->bindParam(':reference', $reference);
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->bindParam(':descpt', $descpt);


        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
       
}
public function update_linecommand($linecommand)
    {
        $query = "UPDATE linecommand SET 
                  product_ref = :product_ref, 
                  qnt = :qnt,
                 
                  WHERE command_id = :command_id";

        $stmt = $this->db->prepare($query);

        $command_id = $linecommand->getRef();
        $product_ref = $linecommand->getEtqt();
        $qnt = $linecommand->getDesc();
       

        $stmt->bindParam(':reference', $reference);
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->bindParam(':descpt', $descpt);
        
        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function delete_linecommand($id)
    {
        $query = "UPDATE linecommand SET isHide = 1 WHERE reference = :id";
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
$linecommand = new linecommand(34,'img/','505',365478936,2000,2030,1000,'OLD',2 , 30,'Computers',1);
$linecommandDAO = new linecommandDAO();
$linecommandDAO->delete_linecommand(34);
?>