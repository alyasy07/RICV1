<?php
// Set error reporting to maximum
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Starting database check for geran_penyelidikan...\n";

// Connect to the database using PDO
try {
    // Get database connection details from .env file
    if (file_exists(__DIR__ . '/.env')) {
        $env = parse_ini_file(__DIR__ . '/.env');
    } else {
        die(".env file not found\n");
    }
    
    $host = $env['DB_HOST'] ?? 'localhost';
    $port = $env['DB_PORT'] ?? '3306';
    $database = $env['DB_DATABASE'] ?? 'laravel';
    $username = $env['DB_USERNAME'] ?? 'root';
    $password = $env['DB_PASSWORD'] ?? '';
    
    echo "Connecting to database: $database on $host:$port\n";
    
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully\n";
    
    // Check the structure of the status_permohonan column
    echo "Checking column structure...\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM geran_penyelidikan WHERE Field = 'status_permohonan'");
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "Current column definition: " . $column['Type'] . "\n";
    
    // Modify the column to ensure it has all three values
    echo "Updating column to include all status values...\n";
    $pdo->exec("ALTER TABLE geran_penyelidikan MODIFY COLUMN status_permohonan ENUM('Lulus', 'Dalam Proses', 'Tidak Berjaya') NOT NULL");
    
    echo "Column updated successfully\n";
    
    // Re-check the column structure
    $stmt = $pdo->query("SHOW COLUMNS FROM geran_penyelidikan WHERE Field = 'status_permohonan'");
    $column = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "Updated column definition: " . $column['Type'] . "\n";
    
    echo "Database check complete\n";
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage() . "\n");
}