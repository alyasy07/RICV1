<?php

// Include the autoloader to access Laravel classes
require_once 'vendor/autoload.php';

// Connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'ftms1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to show column definition
$query = "SHOW COLUMNS FROM geran_penyelidikan LIKE 'status_permohonan'";
$result = $conn->query($query);

if ($result) {
    $column = $result->fetch_assoc();
    echo "Column: " . $column['Field'] . "\n";
    echo "Type: " . $column['Type'] . "\n";
    echo "Null: " . $column['Null'] . "\n";
    
    // Extract enum values
    if (strpos($column['Type'], 'enum') !== false) {
        preg_match('/enum\((.*)\)/', $column['Type'], $matches);
        $enumValues = str_getcsv(str_replace("'", '', $matches[1]));
        echo "Enum values: " . implode(", ", $enumValues) . "\n";
    }
} else {
    echo "Error: " . $conn->error . "\n";
}

// Create a direct SQL alter statement
try {
    $alterSQL = "ALTER TABLE geran_penyelidikan MODIFY COLUMN status_permohonan ENUM('Lulus', 'Dalam Proses', 'Tidak Berjaya') NOT NULL";
    
    if ($conn->query($alterSQL) === TRUE) {
        echo "\nTable column updated successfully\n";
    } else {
        echo "\nError updating table: " . $conn->error . "\n";
    }
} catch (Exception $e) {
    echo "\nException: " . $e->getMessage() . "\n";
}

// Query again to verify the changes
$result = $conn->query($query);
if ($result) {
    $column = $result->fetch_assoc();
    echo "\nAfter update:\n";
    echo "Column: " . $column['Field'] . "\n";
    echo "Type: " . $column['Type'] . "\n";
    echo "Null: " . $column['Null'] . "\n";
    
    // Extract enum values again
    if (strpos($column['Type'], 'enum') !== false) {
        preg_match('/enum\((.*)\)/', $column['Type'], $matches);
        $enumValues = str_getcsv(str_replace("'", '', $matches[1]));
        echo "Enum values: " . implode(", ", $enumValues) . "\n";
    }
}

$conn->close();
?>