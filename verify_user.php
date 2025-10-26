<?php

// Include the autoloader to access Laravel classes
require_once 'vendor/autoload.php';

// Connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'ftms1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get users
$query = "SELECT userID, username, email, role, userStatus FROM user";
$result = $conn->query($query);

if ($result) {
    echo "Users in the database:\n";
    echo str_repeat('-', 80) . "\n";
    echo sprintf("%-15s | %-20s | %-30s | %-10s | %-10s\n", 
        "userID", "Username", "Email", "Role", "Status");
    echo str_repeat('-', 80) . "\n";
    
    while ($row = $result->fetch_assoc()) {
        echo sprintf("%-15s | %-20s | %-30s | %-10s | %-10s\n", 
            $row['userID'], 
            $row['username'], 
            $row['email'], 
            $row['role'], 
            $row['userStatus']);
    }
} else {
    echo "Error retrieving users: " . $conn->error . "\n";
}

// Test authentication
echo "\n\nTesting authentication for admin1@gmail.com...\n";

// Check if the password is correct for this user
$query = "SELECT userID, password FROM user WHERE email = 'admin1@gmail.com'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "User found with ID: " . $user['userID'] . "\n";
    
    // Using PHP's password_verify to check the hashed password
    $testPassword = 'rudyykim';
    $passwordMatch = password_verify($testPassword, $user['password']);
    
    echo "Password verification result: " . ($passwordMatch ? "SUCCESS" : "FAILED") . "\n";
} else {
    echo "User not found!\n";
}

$conn->close();
?>