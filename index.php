<?php
// Include the database configuration


echo "bochta is gay <br>";


include 'db-config.php';

// Query the database
$sql = "SELECT FirstName FROM clients";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";

    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["FirstName"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}

// Close the connection
$conn->close();
?>
