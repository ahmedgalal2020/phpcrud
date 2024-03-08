<?php
// Check if $result exists and is a valid MySQLi result object before freeing
if (isset($result) && $result instanceof mysqli_result) {
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($conn);

