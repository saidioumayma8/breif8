<?php
include("connection.php");
include("productpoo.php");


class categoriesDAO {
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function get_product(){
        $query = "SELECT * FROM categories";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $categoriesData = $stmt->fetchAll();
        $categories= array();
        foreach ($categoriesData as $P) {
            $categories[] = new categories($P["reference"],$P["etiquette"],$P["descpt"],$P["codeBarres"],$P["img"],  $P["prixAchat"],$P["prixFinal"],$P["prixOffre"],$P["qntMin"],$P["qntStock"],$P["catg"]
            );
        }
        return $categories;

    }
    public function insert_categories($categories)
    {
        $query = "INSERT INTO categories(name, descr, img, isHide) 
                  VALUES (:name, :descr, :img, :isHide)";

        $stmt = $this->db->prepare($query);

        $name = $categories->getname();
        $descr = $categories->getdescr();
        $img = $categories->getimg();
        $isHide = $categories->getisHide();
        

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':descr', $descr);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':isHide', $isHide);
        


        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
       
}
public function update_categories($categories)
    {
        $query = "UPDATE categories SET 
                  descr = :descr, 
                  img = :img,
                  isHide = :isHide,
                  WHERE name = :name";

        $stmt = $this->db->prepare($query);

        $name = $categories->getname();
        $descr = $categories->getdescr();
        $img = $categories->getimg();
        $isHide = $categories->getisHide();
       

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':descr', $descr);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':isHide', $isHide);
       

        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function delete_categories($id)
    {
        $query = "UPDATE categories WHERE name = :id";
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