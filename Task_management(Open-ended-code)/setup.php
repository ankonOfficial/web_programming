<?php
$host = "localhost";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Database Setup</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
            .success { color: green; background: #d4edda; padding: 15px; border-radius: 5px; margin: 10px 0; }
            .error { color: red; background: #f8d7da; padding: 15px; border-radius: 5px; margin: 10px 0; }
            .info { color: #004085; background: #cce5ff; padding: 15px; border-radius: 5px; margin: 10px 0; }
            h1 { color: #333; }
            .button { display: inline-block; background: #007bff; color: white; padding: 10px 20px; 
                     text-decoration: none; border-radius: 5px; margin-top: 20px; }
            .button:hover { background: #0056b3; }
            ul { line-height: 1.8; }
        </style>
    </head>
    <body>
        <h1>Task Management System - Database Setup</h1>";
    $sqlFile = __DIR__ . '/database/task_management.sql';
    if (!file_exists($sqlFile)) {
        echo "<div class='error'>Error: SQL file not found at: $sqlFile</div>";
        exit;
    }
    $sql = file_get_contents($sqlFile);
    $statements = array_filter(
        array_map('trim', explode(';', $sql)),
        function($stmt) {
            return !empty($stmt) && 
                   !preg_match('/^(\/\*|--|#)/', $stmt) && 
                   !preg_match('/^SET|^START|^COMMIT|^\/\*|^!/', $stmt);
        }
    );
    echo "<div class='info'>Starting database setup...</div>";
    $successCount = 0;
    $errorCount = 0;
    foreach ($statements as $statement) {
        try {
            $conn->exec($statement);
            $successCount++;
            if (preg_match('/CREATE DATABASE/i', $statement)) {
                echo "<div class='success'>✓ Database 'task_management_system' created successfully</div>";
            } elseif (preg_match('/CREATE TABLE\s+`?(\w+)`?/i', $statement, $matches)) {
                echo "<div class='success'>✓ Table '{$matches[1]}' created successfully</div>";
            } elseif (preg_match('/INSERT INTO\s+`?(\w+)`?/i', $statement, $matches)) {
                echo "<div class='success'>✓ Sample data inserted into '{$matches[1]}'</div>";
            }
        } catch (PDOException $e) {
            $errorCount++;
            if (!preg_match('/already exists/i', $e->getMessage())) {
                echo "<div class='error'>✗ Error: " . $e->getMessage() . "</div>";
            }
        }
    }
    echo "<div class='info'>
        <strong>Setup Complete!</strong><br>
        Successful operations: $successCount<br>
        Errors: $errorCount
    </div>";
    $conn->exec("USE task_management_system");
    $result = $conn->query("SHOW TABLES");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);
    if (count($tables) > 0) {
        echo "<div class='success'>
            <strong>Database tables created successfully:</strong>
            <ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul></div>";
        echo "<div class='info'>
            <strong>Next Steps:</strong><br>
            1. Delete or rename this setup.php file for security<br>
            2. Go to the login page to start using the application<br><br>
            <strong>Demo Login Credentials:</strong><br>
            Username: demo_user<br>
            Password: demo123
        </div>";
        echo "<a href='index.php' class='button'>Go to Login Page</a>";
    } else {
        echo "<div class='error'>No tables were created. Please check the error messages above.</div>";
    }
    echo "</body></html>";
} catch(PDOException $e) {
    echo "<div class='error'>Connection Error: " . $e->getMessage() . "</div>";
    echo "<div class='info'>
        <strong>Troubleshooting:</strong><br>
        1. Make sure XAMPP Apache and MySQL services are running<br>
        2. Verify database credentials in config/database.php<br>
        3. Check if port 3306 is not blocked
    </div></body></html>";
}
?>
