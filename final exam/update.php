<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

require "config";
$name_gender = $_GET["name_gender"];

$stmt = $pdo->prepare("SELECT * FROM users  WHERE name_gender = ?");
$stmt->execute([$name_gender]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["update"])) {
    $stmt = $pdo->prepare("UPDATE  SET stu_user=?, gender=?, WHERE id=?");
    $stmt->execute([
        $_POST["name"], $_POST["gender"], , $id
    ]);
    header("Location: section2.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <style>
        body {font-family: Arial; padding:20px;}
        input {display:block; width:300px; padding:7px; margin-bottom:10px;}
        button {padding:7px 15px; background:blue; color:white;}
    </style>
</head>
<body>

<h2>Update Student</h2>

<form method="POST">
    <input type="text" name="name" value="<?= $student['name'] ?>" required>
    <input type="radio" name="gender" value="<?= $student['gender'] ?>" required>
    <input type="text" name="name_gender" value="<?= $student['name_gender'] ?>" required>
    <button name="update">Update</button>
</form>

</body>
</html>
