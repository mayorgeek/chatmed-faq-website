<?php
require_once 'conn.php';

$statement = $conn->prepare("SELECT * FROM dataset");
$dataset = [];

if (!$statement->execute()) {
    echo "An error occurred!";
    exit(500);
}

$dataset = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChatMed</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php require_once 'header.php' ?>

<main>
    <div class="bg-slate-50 h-screen py-12 px-4 lg:p-12 space-y-10">
        <?php foreach ($dataset as $data) { ?>
            <div class="border-l border-2 border-blue-400 rounded-md shadow-md p-6 bg-white">
            <p class="text-gray-800 font-normal text-base">
                <span class="font-bold">Q</span>: <?php echo $data['question'] ?>
            </p>
            <p class="text-gray-800 font-normal text-base mt-1">
                <span class="font-bold">A:</span> <?php echo $data['answer'] ?>
            </p>
        </div>
        <?php } ?>

        <?php if (empty($dataset)) { ?>
            <p class="text-gray-800 font-normal text-base text-center">No data found!</p>
        <?php } ?>
    </div>
</main>

</body>
</html>