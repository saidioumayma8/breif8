<?php

$conn = new PDO('mysql:host=localhost;dbname=brief7', 'root', '');
$stmt1 = $conn->prepare('SELECT * FROM users WHERE state = 0');
$stmt1->execute();
$users = $stmt1->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $noValide = $_POST["novlaid"];
    if (isset($_POST["valide"]) && $_POST["valide"] === "Valider") {
        

        $sql = "UPDATE users SET state = 1 WHERE username = '$noValide'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        header("Refresh: 1; url=validerUser.php");
        exit;
    }
    if (isset($_POST["remove"]) && $_POST["remove"] === "Supprimer") {
        $sql1 = "DELETE FROM users WHERE username = '$noValide'";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        header("Refresh: 1; url=validerUser.php");
        exit;

    }



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
            <h1>Valider un utilisateur</h1>
            <?php if (count($users) > 0) { ?>
                <form action="" method="post" class="container">
                    <div class="mb-3">
                        <label for="catg" class="form-label text-danger fw-bold">List des utilisateurs non valides</label>
                        <select name="novlaid" id="" class="form-control">
                            <?php
                            foreach ($users as $user) {
                                echo "<option>" . $user["username"] . "</option>";
                            }


                            ?>
                        </select>
                    </div>



                    <div class="d-flex justify-content-center">
                        <input type="submit" name="valide" class="btn btn-primary  m-2" value="Valider">
                        <input type="submit" name="remove" class="btn btn-primary m-2" value="Supprimer">
                    </div>
                </form>
            <?php } else {
                echo "<p class='all-valid'>Tout utilisateur est valider</p>";
            }
            ?>
        </div>
    </section>


</body>

</html>