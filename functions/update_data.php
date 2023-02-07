<?php

require_once '../conn.php';

$id = $_POST["id"];
$question = $_POST['data_question'];
$answer = $_POST['data_answer'];

$statement = $conn->prepare("UPDATE dataset SET question = :question, answer = :answer WHERE id = :id)");
$statement->bindParam("question", $question);
$statement->bindParam("answer", $answer);
$statement->bindParam("id", $id);

if ($statement->execute()) {
    header("location: ../list_data.php");
    exit(200);
}

echo "An error occurred!";
exit(500);