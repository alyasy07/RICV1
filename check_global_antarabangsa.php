<?php

// Include the autoloader
require_once 'vendor/autoload.php';

// Connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'ftms1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check global_antarabangsa table structure
echo "Checking 'global_antarabangsa' table structure:\n";
$result = $conn->query('DESCRIBE global_antarabangsa');
if ($result) {
    echo str_repeat('-', 50) . "\n";
    echo sprintf("%-20s %-30s %-8s %-8s\n", "Field", "Type", "Null", "Key");
    echo str_repeat('-', 50) . "\n";
    while($row = $result->fetch_assoc()) {
        echo sprintf("%-20s %-30s %-8s %-8s\n", 
            $row['Field'], 
            $row['Type'], 
            $row['Null'],
            $row['Key']);
    }
}

// Check for foreign key constraints
echo "\nForeign key constraints on global_antarabangsa table:\n";
$query = "
    SELECT 
        TABLE_NAME,
        COLUMN_NAME,
        CONSTRAINT_NAME,
        REFERENCED_TABLE_NAME,
        REFERENCED_COLUMN_NAME
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = 'ftms1'
        AND TABLE_NAME = 'global_antarabangsa'
        AND REFERENCED_TABLE_NAME IS NOT NULL
";

$result = $conn->query($query);
if ($result) {
    if ($result->num_rows > 0) {
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
        echo "No foreign key constraints found.\n";
    }
} else {
    echo "Error getting constraints: " . $conn->error . "\n";
}

$conn->close();
?>