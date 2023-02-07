<?php

require_once '../conn.php';

$question = $_POST['data_question'];
$answer = $_POST['data_answer'];

$statement = $conn->prepare("INSERT INTO dataset (question,answer) VALUES (:question, :answer)");
$statement->bindParam("question", $question);
$statement->bindParam("answer", $answer);

if ($statement->execute()) {
    header("location: ../list_data.php");
    exit(200);
}

echo "An error occurred!";
exit(500);