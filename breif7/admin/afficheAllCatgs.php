<?php

$conn = new PDO('mysql:host=localhost;dbname=brief7', 'root', '');
$stmt = $conn->prepare("SELECT * FROM categories");
$stmt->execute();
$catgs = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>



    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary container">
        <div class="collapse navbar-collapse d-flex" id="navbarTogglerDemo01">
            <a class="navbar-brand col-5" href="index.php">ElectroNacer</a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php" id="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="productsUser.php" id="home">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php" id="home">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="logout.php">Log Out</a>
                </li>

            </ul>

        </div>
    </nav>


    <section class="dashboard">
        
        <?php
        include("sideBar.html");
        ?>
        <div class="col-md-10 product-menu">
           <?php
           foreach($catgs as $catg) {
           $img = $catg['img'];
           $title = $catg['name'];
           $desc = $catg['descrt'];
             $card = "
             <div class='product-item card-pos'>
                 <img src= " . $img . ">
                 <h5>$title</h5>
                 <p><span class='fw-bold'>Description</span>: $desc</p>                 
             </div>
         ";
         echo $card;
           }
?>
        </div>
    </section>

</body>

</html>