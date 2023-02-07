<?php
require_once 'conn.php';

$data_id = $_GET['id'];

$statement = $conn->prepare("SELECT * FROM dataset WHERE id = :id");
$statement->bindParam("id", $data_id);

if (!$statement->execute()) {
    echo "An error occurred!";
    exit(500);
}

$data = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data | ChatMed</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php require_once 'header.php' ?>

<main>
    <div class="bg-slate-50 h-screen px-4 py-12 lg:p-12 space-y-10">
        <h1 class="text-gray-900 font-semibold text-2xl mb-10">Edit Data</h1>

        <div>
            <form action="functions/update_data.php" method="post">
                <input type="hidden" value="<?php $data['id'] ?>">

                <div>
                    <label
                            for="data_question"
                            class="text-gray-900 font-medium text-lg block mb-3"
                    >
                        Question
                    </label>
                    <input id="data_question"
                           name="data_question"
                           type="text"
                           class="block w-full border border-gray-300 p-3 rounded focus:shadow-md focus:border-blue-600 outline-none transition ease-in-out"
                           required
                           value="<?php echo $data['question'] ?>"
                    >
                </div>

                <div class="mt-5">
                    <label
                            for="data_answer"
                            class="text-gray-900 font-medium text-lg block mb-3"
                    >
                        Answer
                    </label>
                    <textarea id="data_answer"
                           name="data_answer"
                           rows="3"
                           class="block w-full border border-gray-300 p-3 rounded focus:shadow-md focus:border-blue-600 outline-none transition ease-in-out"
                           required
                    ></textarea>
                </div>

                <div class="mt-8 flex items-center space-x-5">
                    <a href="list_data.php"
                       class="px-7 py-3 block text-white font-normal text-base rounded-md shadow-sm hover:shadow-xl bg-gray-400 hover:bg-gray-500 transition ease-in-out border-none"
                    >
                        Cancel
                    </a>
                    <button
                            type="submit"
                            class="px-7 py-3 text-white font-normal text-base rounded-md shadow-sm hover:shadow-xl bg-blue-600 hover:bg-blue-700 transition ease-in-out border-none"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

</body>
</html>