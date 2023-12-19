<?php

$conn = new PDO('mysql:host=localhost;dbname=brief7', 'root', '');



if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $img = "assets/catgImages/" . $_FILES['img']['name'];
    $stmt = $conn->prepare("INSERT INTO 
        categories(name, descrt, img)
         VALUES (?, ?, ?)");

    $stmt->execute([$name, $desc, $img]);

    move_uploaded_file($_FILES['img']['tmp_name'], 'C:\xampp\htdocs\brief7\assets\catgImages\\' . $_FILES['img']['name']);

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



        <div class="col-md-10">
            <h1>Ajouter une Categorie</h1>
            <form action="" method="post" class="container" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Name de categorie</label>
                    <input type="text" class="form-control" id="title" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Description de categorie</label>
                    <textarea type="text" class="form-control" id="title" name="desc" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="img" name="img" required>
                </div>


                <input type="submit" class="btn btn-primary my-5" value="Ajouter">
            </form>
        </div>
    </section>

</body>

</html>