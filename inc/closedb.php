<?php
// Only free result if it exists and is a valid result set
if (isset($result) && $result instanceof mysqli_result) {
    mysqli_free_result($result);
}

// Always close the connection
mysqli_close($conn);

