<?php 
require 'database.php';
function done($id){
    global $conn;
    $query = "UPDATE todo SET status = 'Selesai' WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>