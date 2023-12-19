<?php

$conn = new PDO('mysql:host=localhost;dbname=brief7', 'root', '');
$stmt1 = $conn->prepare('SELECT * FROM products');
$stmt1->execute();
$products = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$stmt2 = $conn->prepare('SELECT * FROM categories WHERE isHide = 0');
$stmt2->execute();
$catgs = $stmt2->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] === "POST") {



    $hideCatg = $_POST["hided"];

    $stmt3 = $conn->prepare("UPDATE categories SET isHide = 1 WHERE name = '$hideCatg'");
    $stmt3->execute();

    $stmt4 = $conn->prepare("UPDATE products SET isHide = 1 WHERE catg = '$hideCatg'");
    $stmt4->execute();

    header("Refresh: 1; url=hideCatg.php");
    exit;
}





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
        <!-- </div> -->
        <!-- </div> -->



        <div class="col-md-10">
            <h1>Masquer une Categorie</h1>
            <?php if(count($catgs) > 0 ) { ?>
            <form action="" method="post" class="container">
                <div class="mb-3">
                    <label for="catg" class="form-label">Choisir une Categorie</label>
                    <select name="hided" id="" class="form-control">
                        <?php
                        foreach ($catgs as $catg) {
                            echo "<option>" . $catg["name"] . "</option>";
                        }
                        ?>
                    </select>
                </div>



                <input type="submit" class="btn btn-primary my-2" value="Masquer">
            </form>
            <?php } else {
                echo "<p class='all-valid bg-warning'>Tous les categories sont masqué.</p>";

            }
            ?>
        </div>
    </section>

</body>

</html>