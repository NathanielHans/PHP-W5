<?php 

require 'database.php';
function delete($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM todo WHERE id = $id");
    return mysqli_affected_rows($conn);
}
?>