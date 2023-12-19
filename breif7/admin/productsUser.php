<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=brief7', 'root', '');
    $stmt = $conn->prepare("SELECT * FROM products WHERE isHide = 0");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt1 = $conn->prepare("SELECT * FROM categories WHERE isHide = 0");
    $stmt1->execute();
    $catgs = $stmt1->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary container">
        <div class="collapse navbar-collapse position-relative " id="navbarTogglerDemo01">
            <a class="navbar-brand col-5" href="index.php">ElectroNacer</a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="productsUser.php">Products</a>
                </li>
                <?php
                if ($_COOKIE["role"] === "1") { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php" id="home">Dashboard</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="logout.php">Log Out</a>
                </li>
               
            </ul>

        </div>
    </nav>
    <?php echo "<h1>Welcome " . $_COOKIE["username"] . "</h1>"; ?>



    <?php
    if (count($products) > 0) {
        ?>
        <div class="select">
            <select id="filter">
                <option value="0">All</option>
                <?php
                foreach ($catgs as $i => $catg) {
                    $value = $i + 1;
                    $catgName = $catg['name'];
                    echo "<option value = $value>$catgName</option>";
                }
                ?>
                <option value="6">produits en rupture de stock</option>
            </select>

        </div>
    <?php } else {
        echo "<p class='all-valid bg-warning'>Tous les produits sont masqués.</p>";

    }
    ?>
        
    <div class="product-menu">
        <?php
        foreach ($products as $item) {
            $title = $item["etiquette"];
            $priceAchat = "prix d'achat: " . $item["prixAchat"] . "DH";
            $priceFinal = "prix final: " . $item["prixFinal"] . "DH";
            $qnt_min = $item['qntMin'];
            $qnt_stock = $item['qntStock'];
            $catg = $item['catg'];
            $img = $item['img'];
            $card = "
                <div class='product-item $catg card-pos'>
                    <img src= $img alt='Product 1'>
                    <h5>$title</h5>
                    <p>$priceAchat</p>
                    <p>$priceFinal</p>
                    <p class='qntMin'>Quantity minimale: $qnt_min</p>
                    <p class='qntStc'>Quantity en Stock:  $qnt_stock</p>
                    <p>Categorie: $catg</p>                 
                
            ";
            if ($_COOKIE['role'] === '1') {
                $card .= "<a href='modifierProduct.php' class='btn btn-primary pos'>Modifier</a>                 
                <a href='hideProduct.php' class='btn btn-danger pos'>Masquer</a>";
            }
            $card .= "</div>";

            echo $card;


        }
        ?>


    </div>

    <ul class="pagination" id="pagination">

    </ul>


    <script src="script.js"></script>
</body>

</html>