<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
    </head>
    <body>
	<h1 style="text-align:center;">Signin Page</h1>
        <form method="post" action="validate.php" style="text-align:center;">
            User Name: <input type="text" placeholder="User Name" id="uname" name="uname">
            <br/>
            Password: <input type="password" id="pass" name="pass">
            <br/>
            <input type="submit" name="login" value="Log In">
        </form>
		<button>Sign Up</button>

        <?php
        $status = "";
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'invalid') {
                ?>
                <script>window.alert('invalid username or password');</script>
                <?php
            }
            else if($status=='dberror'){
                ?>
                <script>window.alert('Database Connection Error');</script>
                <?php
            }
            else if($status=='logout'){
                ?>
                <script>window.alert('Successfully logged out.');</script>
                <?php
            }
        }
        ?>

    </body>
</html>
