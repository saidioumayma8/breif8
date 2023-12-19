<?php

$conn = new PDO('mysql:host=localhost;dbname=brief7', 'root', '');
$stmt = $conn->prepare('SELECT * FROM categories');
$stmt->execute();
$catg = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["modifie"])) {
    $selected = $_COOKIE["catgChoisire"];
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $img = "assets/catgImages/" . $_FILES['img']['name'];




    $sql = "UPDATE categories
    SET name = '$name', descrt = '$desc', img = '$img' 
    WHERE name = '$selected'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    move_uploaded_file($_FILES['img']['tmp_name'], 'C:\xampp\htdocs\brief7\assets\catgImages\\' . $_FILES['img']['name']);

    header("Location: modifieCatg.php");
    exit;
}

if (isset($_POST["choisir"])) {
    $catgSelected = $_POST["catg"];
    setcookie("catgChoisire", $catgSelected);
    $stmt1 = $conn->prepare("SELECT * FROM categories WHERE name = '$catgSelected'");
    $stmt1->execute();
    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC)[0];
    $catgName = $result["name"];
    $catgDesc = $result["descrt"];
    $img = $result["img"];
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
            <h1>Modifier une Categorie</h1>
            <form action="" method="post" class="container">
                <div class="mb-3">
                    <label for="catg" class="form-label">Choisir une Category</label>
                    <select name="catg" id="" class="form-control">
                        <?php
                        foreach ($catg as $item) {

                            echo (isset($catgSelected) && $catgSelected === $item['name'] ? "<option selected>" : "<option>");
                            echo $item["name"] . "</option>";
                        }

                        ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary my-2" name="choisir" value="Choisir">
            </form>
            <?php if (isset($_POST["choisir"])) { ?>
                <div class="mb-3 d-flex justify-content-center">
                    <img src=<?php echo $img ?> alt="">
                </div>
                <form action="" method="post" class="container" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="title" class="form-label">Nouveau Nom de la catégorie</label>
                        <input type="text" class="form-control" id="title" name="name" required
                            value='<?php echo $catgName ?>'>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Nouveau Description de la catégorie</label>
                        <textarea type="text" class="form-control" id="title" name="desc" rows="5"
                            required><?php echo $catgDesc ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="img" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>



                    <input type="submit" class="btn btn-primary my-5" name="modifie" value="Modifier">

                </form>
            <?php } ?>

            </form>
        </div>
    </section>

</body>

</html>