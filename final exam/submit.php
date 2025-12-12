<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $name_gender = $_POST['name_gender'];

    $sql = "INSERT INTO users (name,gender,name_gender) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $gender, $name_gender);
    
    if ($stmt->execute()) {
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $stmt->close();
}
?>
