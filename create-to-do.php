<?php 
function createTask($data,$id){
    global $conn;
    $idUser = $id;
    $task = $data["task"];
    $status = "Belum Selesai";

    $query = "INSERT INTO todo (task, status, id_user) VALUES ('$task', '$status', $idUser)";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>