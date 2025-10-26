<?php

// Include the autoloader to access Laravel classes
require_once 'vendor/autoload.php';

// Connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'ftms1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to show table structure
$query = "SHOW COLUMNS FROM geran_penyelidikan";
$result = $conn->query($query);

if ($result) {
    echo "Table structure for 'geran_penyelidikan':\n";
    echo str_repeat('-', 80) . "\n";
    echo sprintf("%-20s | %-30s | %-5s | %-4s | %-20s\n", 
        "Field", "Type", "Null", "Key", "Default");
    echo str_repeat('-', 80) . "\n";
    
    while ($row = $result->fetch_assoc()) {
        echo sprintf("%-20s | %-30s | %-5s | %-4s | %-20s\n", 
            $row['Field'], 
            $row['Type'], 
            $row['Null'], 
            $row['Key'], 
            $row['Default'] ?? 'NULL');
    }
} else {
    echo "Error retrieving table structure: " . $conn->error . "\n";
}

$conn->close();
?>