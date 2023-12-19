<?php

try {

    $conn = new PDO('mysql:host=localhost;dbname=brief7', 'root', '');


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = '$email' AND pass = '$password'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        if (count($result) == 1) {

            setcookie("state", $result[0]["state"], time() + 60 * 60 * 24 * 10);
            setcookie("role", $result[0]["role"], time() + 60 * 60 * 24 * 10);
            if ($result[0]["state"] === 1) {
                setcookie("username", $result[0]["username"], time() + 60 * 60 * 24 * 10);
            }
            header("Location: validatMessage.php");
            exit;
         
        }
    }
} catch (Exception $e) {

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>


    <?php if (!isset($_COOKIE["username"])) { ?>
        <nav class="navbar navbar-expand-lg bg-body-tertiary container">
            <div class="collapse navbar-collapse position-relative " id="navbarTogglerDemo01">
                <a class="navbar-brand col-6" href="index.php">ElectroNacer</a>
            </div>
        </nav>
        <h1>Login</h1>
        <div class="parent-form">
            <form action="" method="post" class="container">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="userOrEmail" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass" name="password" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Login">
            </form>
            <?php
            if (isset($result) && count($result) == 0) {
                echo "<p class='invalid'>Invalid Email Or Password</p>";
            }

            ?>


            <div class="sign">
                <p>Vous n'avez pas de compte ? &nbsp;&nbsp;</p>
                <a href="sign_up.php">Sign up</a>
            </div>
        </div>

        <?php
    } else {

        include("productsUser.php");


        ?>
        <!-- <script>
        let home =document.getElementById("home");
        home.setAttribute("href", "google.com");
        console.log(home);
    </script> -->



        <?php

    }

    ?>










</body>

</html>