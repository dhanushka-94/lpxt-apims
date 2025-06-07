<?php

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = ''; // Add your password if needed
$database = 'mskcomputers_m3klive';

// Create connection
$mysqli = new mysqli($host, $username, $password);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected to MySQL successfully.\n";

// Check if database exists
$result = $mysqli->query("SHOW DATABASES LIKE '$database'");
if ($result->num_rows > 0) {
    echo "Database '$database' exists.\n";
    
    // Select the database
    $mysqli->select_db($database);
    
    // Get tables
    $tables = [];
    $result = $mysqli->query("SHOW TABLES");
    if ($result->num_rows > 0) {
        echo "\nTables in $database:\n";
        echo "===========================\n";
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
            echo "- " . $row[0] . "\n";
        }
    } else {
        echo "No tables found in database.\n";
    }
    
    // Get detailed information about each table
    foreach ($tables as $table) {
        echo "\nTable structure for '$table':\n";
        echo "===========================\n";
        
        $result = $mysqli->query("DESCRIBE `$table`");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row['Field'] . " - " . $row['Type'] . " - " . 
                     ($row['Null'] == 'YES' ? 'NULL' : 'NOT NULL') . " - " . 
                     $row['Key'] . " - " . $row['Default'] . " - " . $row['Extra'] . "\n";
            }
        }
        
        // Count rows
        $countResult = $mysqli->query("SELECT COUNT(*) AS count FROM `$table`");
        $count = $countResult->fetch_assoc()['count'];
        echo "Total rows: $count\n";
    }
} else {
    echo "Database '$database' does not exist.\n";
}

$mysqli->close(); 