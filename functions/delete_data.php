<?php

require_once '../conn.php';

$id = $_POST['id'];

$statement = $conn->prepare("DELETE FROM dataset WHERE id = :id");
$statement->bindParam("id", $id);

if ($statement->execute()) {
    header("location: ../list_data.php");
    exit(200);
}

echo "An error occurred!";
exit(500);