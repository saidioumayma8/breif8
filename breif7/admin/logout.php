<?php

setcookie("username", "", time() - 1);
setcookie("state", "", time() - 1);
setcookie("role", "", time() - 1);
header("Refresh: 1; url=index.php");

?>