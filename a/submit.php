<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    
    // Hash the name using SHA256
    $hashed_name = hash('sha256', $name);
    
    // Insert into database
    $sql = "INSERT INTO entries (name, date, random_number) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $date, $hashed_name);
    
    if ($stmt->execute()) {
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $stmt->close();
}
?>
