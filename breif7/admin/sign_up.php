<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=brief7", 'root', '');
    $stmt = $conn->prepare("INSERT INTO users (email, username, pass, state, role) VALUES (:email, :username, :password, 0, 0)");
    if (isset($_POST["submit"])) {
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->bindParam(':username', $_POST["username"]);
        $stmt->bindParam(':password', $_POST["password"]);
        $stmt->execute();
        header("Location: index.php");
    }
} catch (PDOException $e) {
    $exist = true;
    $emailExist = false;
    $usernameExist = false;
    $passworfExist = false;
    $infoExiste = ["email" => false, "username" => false, "password" => false];
    if (strpos($e->errorInfo[2], "email")) {
        $infoExiste["email"] = true;
    }
    if (strpos($e->errorInfo[2], "username")) {
        $infoExiste["username"] = true;
    }
    if (strpos($e->errorInfo[2], "pass")) {
        $infoExiste["password"] = true;
    }
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary container">
        <div class="collapse navbar-collapse d-flex" id="navbarTogglerDemo01">
            <a class="navbar-brand col-5" href="index.php">ElectroNacer</a>

            <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
            </ul> -->

        </div>
    </nav>


    <h1>Sign Up</h1>

    <div class="parent-form">
        <form method="post" class="container">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="password" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Sign Up" name="submit">
        </form>

        <?php
        if (isset($exist)) {
            // echo "<p class='text-danger'>The email is Duplicated</p>";
            foreach ($infoExiste as $index => $info) {
                if ($info) {
                    echo "<p class='text-danger mt-4'>" . ucfirst($index)  . " existe déjà.</p>";
                    break;
                }
            }

        }

        ?>

        <div class="sign">
            <p>Vous avez déjà un compte ? &nbsp;&nbsp;</p>
            <a href="index.php">Login</a>
        </div>
    </div>


















</body>

</html>