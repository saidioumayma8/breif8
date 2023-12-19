<?php
include("connection.php");
include("productpoo.php");


class ProductDAO {
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function get_product(){
        $query = "SELECT * FROM products";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $productData = $stmt->fetchAll();
        $Products = array();
        foreach ($productData as $P) {
            $Products[] = new Product($P["reference"],$P["etiquette"],$P["descpt"],$P["codeBarres"],$P["img"],  $P["prixAchat"],$P["prixFinal"],$P["prixOffre"],$P["qntMin"],$P["qntStock"],$P["catg"]
            );
        }
        return $Products;

    }
    public function insert_product($Product)
    {
        $query = "INSERT INTO products (reference, etiquette, descpt, codeBarres, img, prixAchat, prixFinal, prixOffre, qntMin, qntStock, catg) 
                  VALUES (:reference, :etiquette, :descpt, :codeBarres, :img, :prixAchat, :prixFinal, :prixOffre, :qntMin, :qntStock, :catg)";

        $stmt = $this->db->prepare($query);

        $reference = $Product->getReference();
        
        $etiquette = $Product->getEtiquette();
        $descpt = $Product->getDescpt();
        $codeBarres = $Product->getCodeBarres();
        $img = $Product->getImg();
        $prixAchat = $Product->getPrixAchat();
        $prixFinal = $Product->getPrixFinal();
        $prixOffre = $Product->getPrixOffre();
        $qntMin = $Product->getQntMin();
        $qntStock = $Product->getQntStock();
        $catg = $Product->getCatg();

        $stmt->bindParam(':reference', $reference);
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->bindParam(':descpt', $descpt);
        $stmt->bindParam(':codeBarres', $codeBarres);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':prixAchat', $prixAchat);
        $stmt->bindParam(':prixFinal', $prixFinal);
        $stmt->bindParam(':prixOffre', $prixOffre);
        $stmt->bindParam(':qntMin', $qntMin);
        $stmt->bindParam(':qntStock', $qntStock);
        $stmt->bindParam(':catg', $catg);


        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
       
}
public function update_product($Product)
    {
        $query = "UPDATE products SET 
                  etiquette = :etiquette, 
                  descpt = :descpt,
                  codeBarres = :codeBarres,
                  img = :img,
                  prixAchat = :prixAchat,
                  prixFinal = :prixFinal,
                  prixOffre = :prixOffre,
                  qntMin = :qntMin,
                  qntStock = :qntStock,
                  catg = :catg
                  WHERE reference = :reference";

        $stmt = $this->db->prepare($query);

        $reference = $Product->getRef();
        $etiquette = $Product->getEtqt();
        $descpt = $Product->getDesc();
        $codeBarres = $Product->getCode_barre();
        $img = $Product->getImgProd();
        $prixAchat = $Product->getPr_ach();
        $prixFinal = $Product->getPr_fin();
        $prixOffre = $Product->getOffre_pr();
        $qntMin = $Product->getQte_min();
        $qntStock = $Product->getQte_stock();
        $catg = $Product->getCatg();

        $stmt->bindParam(':reference', $reference);
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->bindParam(':descpt', $descpt);
        $stmt->bindParam(':codeBarres', $codeBarres);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':prixAchat', $prixAchat);
        $stmt->bindParam(':prixFinal', $prixFinal);
        $stmt->bindParam(':prixOffre', $prixOffre);
        $stmt->bindParam(':qntMin', $qntMin);
        $stmt->bindParam(':qntStock', $qntStock);
        $stmt->bindParam(':catg', $catg);

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
$product = new Product(34,'img/','505',365478936,2000,2030,1000,'OLD',2 , 30,'Computers',1);
$productDAO = new ProductDAO();
$productDAO->delete_product(34);
?>