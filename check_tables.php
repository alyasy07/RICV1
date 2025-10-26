<?php

// Include the autoloader
require_once 'vendor/autoload.php';

// Connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'ftms1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get tables
$tables = [];
$result = $conn->query('SHOW TABLES');
while($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

echo "Tables in database:\n";
echo str_repeat('-', 50) . "\n";
foreach($tables as $table) {
    echo "- $table\n";
}

// Check if users table exists
if (in_array('users', $tables)) {
    echo "\nChecking 'users' table structure:\n";
    $result = $conn->query('DESCRIBE users');
    if ($result) {
        echo str_repeat('-', 50) . "\n";
        while($row = $result->fetch_assoc()) {
            echo "{$row['Field']} - {$row['Type']} - {$row['Key']}\n";
        }
    }
}

// Check the user table structure
echo "\nChecking 'user' table structure:\n";
$result = $conn->query('DESCRIBE user');
if ($result) {
    echo str_repeat('-', 50) . "\n";
    while($row = $result->fetch_assoc()) {
        echo "{$row['Field']} - {$row['Type']} - {$row['Key']}\n";
    }
}

// Check the foreign key constraint on penerbitan_penulisan table
echo "\nForeign key constraints on penerbitan_penulisan table:\n";
$query = "
    SELECT 
        TABLE_NAME,
        COLUMN_NAME,
        CONSTRAINT_NAME,
        REFERENCED_TABLE_NAME,
        REFERENCED_COLUMN_NAME
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = 'ftms1'
        AND TABLE_NAME = 'penerbitan_penulisan'
        AND REFERENCED_TABLE_NAME IS NOT NULL
";

$result = $conn->query($query);
if ($result) {
    echo str_repeat('-', 80) . "\n";
    echo sprintf("%-20s %-15s %-25s %-20s %-15s\n", 
          "TABLE", "COLUMN", "CONSTRAINT", "REF_TABLE", "REF_COLUMN");
    echo str_repeat('-', 80) . "\n";
    
    while($row = $result->fetch_assoc()) {
        echo sprintf("%-20s %-15s %-25s %-20s %-15s\n",
              $row['TABLE_NAME'], 
              $row['COLUMN_NAME'],
              $row['CONSTRAINT_NAME'],
              $row['REFERENCED_TABLE_NAME'],
              $row['REFERENCED_COLUMN_NAME']);
    }
} else {
    echo "Error getting constraints: " . $conn->error . "\n";
}

// Close the connection
$conn->close();
?>