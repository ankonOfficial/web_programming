<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $date = $_POST['date'];
    $gender = $_POST['gender'];
    // $password = $_POS['password'];
    // $date = $_POST['date'];
    // $pass = $_POST['pass'];
    
    // Hash the name using SHA256
    $hashed_name = hash('sha256', $name);
    // $hashed_password = hash('sha256', $password);
    //   $hashed_pass = hash('sha256', $pass);
    
    // Insert into database
    $sql = "INSERT INTO entries (name,date,gender,random_number) VALUES (?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $date, $gender, $hashed_name);
    
    if ($stmt->execute()) {
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $stmt->close();
}
?>
