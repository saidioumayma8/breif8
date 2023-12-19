<?php

class Database
{
    private $conn;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getUsers()
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE state = 1 AND role = 0');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRole($username)
    {
        $sql = "UPDATE users SET role = 1 WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
    }
}

$database = new Database('localhost', 'brief7', 'root', '');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $noValide = $_POST["novlaid"];
    
    $database->updateRole($noValide);

    header("Refresh: 1; url=toAdmin.php");
    exit;
}

$users = $database->getUsers();






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
                        <label for="catg" class="form-label text-success fw-bold">Choisir un utilisateur</label>
                        <select name="novlaid" id="" class="form-control">
                            <?php
                            foreach ($users as $user) {
                                echo "<option>" . $user["username"] . "</option>";
                            }


                            ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary m-2" value="Transformer en administrateur">
                </form>
            <?php } else {
                echo "<p class='all-valid'>Tous les utilisateurs sont administrateurs</p>";
            }
            ?>
        </div>
    </section>


</body>

</html>