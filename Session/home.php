<?php

session_start();

if (!isset($_SESSION['uname'])) {
    echo "<script>window.location.assign('index.php')</script>";
} else {
    ?>
<html>
    <head>
        <meta charset='utf=8'>
        <title>Home Page</title>
    </head>
    <body>
        <h1>Welcome <?php echo $_SESSION['uname']?> </h1>
        
       
        
        <input type='button' value="Log out" onclick="window.location.assign('logout.php');">
        
    </body>
</html>
    <?php
}
?>

