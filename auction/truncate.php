<?php
require("connection.php");

$truncateSql = "TRUNCATE TABLE current_auction";
if ($conn->query($truncateSql) === TRUE) {
    echo "Table truncated successfully.";
} else {
    echo "Error truncating table: " . $conn->error;
}

$conn->close();
?>
