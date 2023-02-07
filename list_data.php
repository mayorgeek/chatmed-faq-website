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
    <title>Manage Data | ChatMed</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php require_once 'header.php' ?>

<main>
    <div class="bg-slate-50 h-screen py-12 px-4 lg:p-12">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between mb-10 space-y-5 lg:space-y-0">
            <h1 class="text-gray-900 font-semibold text-2xl">List Data</h1>

            <a href="create_data.php"
                    class="block w-fit bg-blue-600 text-white text-sm uppercase font-normal px-6 py-2.5 hover:bg-blue-700 shadow-sm hover:shadow-xl rounded-md transition ease-in-out cursor-default flex items-center text-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Insert Data
            </a>
        </div>

        <div class="space-y-10">
            <?php foreach ($dataset as $data) { ?>
            <div class="border-l border-2 border-blue-400 rounded-md shadow-md p-6 bg-white">
                <p class="text-gray-800 font-normal text-base">
                    <span class="font-bold">Q</span>: <?php echo $data['question'] ?>
                </p>
                <p class="text-gray-800 font-normal text-base mt-1">
                    <span class="font-bold">A:</span> <?php echo $data['answer'] ?>
                </p>
                <div class="flex items-center space-x-5 mt-6">
                    <a
                            href="edit_data.php?id=<?php echo $data['id'] ?>"
                            class="block text-yellow-600 hover:text-yellow-800 border border-yellow-600 hover:border-yellow-800 text-sm uppercase px-5 py-2 transition ease-in-out flex items-center text-left"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        Edit
                    </a>
                    <form action="functions/delete_data.php" method="post">
                        <input
                                name="id"
                                type="hidden"
                                value="<?php echo $data['id'] ?>"
                        >
                        <button
                                type="submit"
                                onclick="deleteData()"
                                class="text-red-600 hover:text-red-800 border border-red-600 hover:border-red-800 text-sm uppercase px-5 py-2 transition ease-in-out flex items-center text-left outline-none"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>

        <?php if (empty($dataset)) { ?>
            <p class="text-gray-800 font-normal text-base text-center">No data found!</p>
        <?php } ?>
    </div>
</main>

<script>
    function deleteData() {
        alert("This data will be deleted!");
    }
</script>
</body>
</html>