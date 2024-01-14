<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>>
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/input.css" ?>>
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] . "/public/assets/font-awesome/css/font-awesome.min.css" ?>">
    <title>Dashboard</title>
    <style>
        .wikis {
            background-color: rgb(229 231 235 / var(--tw-bg-opacity));
        }
    </style>
</head>

<body class="h-full">

    <?php
    require "Views/includes/navbar.php";
    ?>

    <div class="w-full flex flex-row h-full">

        <?php
        require "Views/includes/dashboard/aside.php";
        ?>
        <div class="w-5/6">
            <div class="flex flex-row items-center py-1 w-full px-2 justify-between">
                <h3 class="text-2xl font-bold text-cyan-800">Wikis (<?= count($wikis) ?>)</h3>
                
                <button id="archived_wikis_btn" class="p-2 bg-orange-200 text-amber-700 font-semibold rounded-xl mr-4">
                    Archived wikis (<small><?= count($archived_wikis) ?></small>)
                </button>

                <button id="wikis_btn" class="hidden p-2 bg-blue-50 text-blue-700 font-semibold rounded-xl mr-4">
                    Wikis (<small><?= count($wikis) ?></small>)
                </button>

                <a class="cursor-pointer text-white font-bold bg-blue-600 rounded-xl p-2 h-10 hover:bg-blue-600" href="<?= $_ENV['APP_URL'] . '/wikis/create' ?>">
                    + Add Wiki
                </a>
            </div>
            <div class="flex flex-col w-full overflow-y-scroll max-h-[79vh]">
                <!-- Success alert -->
                <?php
                if (isset($_SESSION['success'])) {
                ?>
                    <p class="text-green-600 p-1 text-center"><?= $_SESSION['success'] ?></p>
                <?php
                    unset($_SESSION['success']);
                }
                ?>

                <!-- Wikis Table -->
                <table id="wikis_table" class="table-auto w-full text-sm whitespace-no-wrap border-spacing-2 px-2 pb-2">
                    <thead class="">
                        <tr class="bg-gray-400">
                            <th class="p-1 border-r border-gray-200">View</th>
                            <th class="p-1 border-r border-gray-200">Author</th>
                            <th class="p-1 border-r border-gray-200">Title</th>
                            <th class="p-1 border-r border-gray-200">Category</th>
                            <th class="p-1 border-r border-gray-200">Created time</th>
                            <th class="p-1 border-r border-gray-200">Archive</th>
                            <th class="p-1" colspan="2">
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($wikis as $wiki) :
                        ?>
                            <tr class="odd:bg-gray-200 even:bg-gray-300">
                                <td class="p-1 text-center border-r border-white w-10">
                                    <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id=" . $wiki['id'] ?>" class="p-1 text-blue-600">
                                        <i class="hover:scale-125 fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <div class=" flex flex-row items-center gap-x-2">
                                        <img class="w-7 h-7 rounded-full" src="<?= $_ENV['APP_URL'] . $wiki['author_photo_src'] ?>" alt="Poster photo">
                                        <p><?= $wiki['author_name'] ?></p>
                                    </div>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $wiki['title'] ?>
                                    </p>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $wiki['category_name'] ?>
                                    </p>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $wiki['wiki_created_at'] ?>
                                    </p>
                                </td>

                                <td class="p-1 border-r border-white text-center">
                                    <form action="<?= $_ENV['APP_URL'] . "/dashboard/wikis/archive" ?>" method="POST">
                                        <input type="hidden" name="id" value="<?= $wiki['id'] ?>">
                                        <button class="rounded-lg px-2 py-1 font-semibold bg-amber-100 text-amber-500">
                                            Archive
                                        </button>
                                    </form>
                                </td>

                                <td class="text-right border-r border-white">
                                    <form class="text-center" action="<?= $_ENV['APP_URL'] . "/dashboard/wikis/delete" ?>" method="POST">
                                        <input type="hidden" name="id" id="id" value="<?= $wiki['id'] ?>">
                                        <input type="hidden" name="photo_src" id="id" value="<?= $wiki['wiki_photo_src'] ?>">
                                        <button class="hover:bg-red-500 hover:text-white text-red-500 border border-red-500 rounded-md p-2" onclick="return confirmDelete()">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                                <td class="text-left border-r border-white">
                                    <form class="text-center" action="<?= $_ENV['APP_URL'] . "/dashboard/wikis/edit" ?>" method="post">
                                        <input type="hidden" name="id" id="id" value="<?= $wiki['id'] ?>">
                                        <input type="hidden" name="photo_src" id="id" value="<?= $wiki['wiki_photo_src'] ?>">
                                        <button type="submit" class="hover:bg-green-500 hover:text-white text-green-500 border border-green-500 rounded-md p-2">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>

                <!-- Archived Wikis Table -->
                <table id="archived_wikis_table" class="hidden table-auto w-full text-sm whitespace-no-wrap border-spacing-2 px-2 pb-2">
                    <thead class="">
                        <tr class="bg-gray-400">
                            <th class="p-1 border-r border-gray-200">View</th>
                            <th class="p-1 border-r border-gray-200">Author</th>
                            <th class="p-1 border-r border-gray-200">Title</th>
                            <th class="p-1 border-r border-gray-200">Category</th>
                            <th class="p-1 border-r border-gray-200">Created time</th>
                            <th class="p-1 border-r border-gray-200">Archive</th>
                            <th class="p-1" colspan="2">
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($archived_wikis as $wiki) :
                        ?>
                            <tr class="odd:bg-gray-200 even:bg-gray-300">
                                <td class="p-1 text-center border-r border-white w-10">
                                    <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id=" . $wiki['id'] ?>" class="p-1 text-blue-600">
                                        <i class="hover:scale-125 fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <div class=" flex flex-row items-center gap-x-2">
                                        <img class="w-7 h-7 rounded-full" src="<?= $_ENV['APP_URL'] . $wiki['author_photo_src'] ?>" alt="Poster photo">
                                        <p><?= $wiki['author_name'] ?></p>
                                    </div>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $wiki['title'] ?>
                                    </p>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $wiki['category_name'] ?>
                                    </p>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $wiki['wiki_created_at'] ?>
                                    </p>
                                </td>

                                <td class="p-1 border-r border-white text-center">
                                    <div>
                                        <span class="rounded-lg px-2 py-1 font-semibold bg-amber-100 text-yellow-700">
                                            Archived
                                        </span>
                                    </div>
                                </td>

                                <td class="text-right border-r border-white">
                                    <form class="text-center" action="<?= $_ENV['APP_URL'] . "/dashboard/wikis/delete" ?>" method="POST">
                                        <input type="hidden" name="id" id="id" value="<?= $wiki['id'] ?>">
                                        <input type="hidden" name="photo_src" id="id" value="<?= $wiki['wiki_photo_src'] ?>">
                                        <button class="hover:bg-red-500 hover:text-white text-red-500 border border-red-500 rounded-md p-2" onclick="return confirmDelete()">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                                <td class="text-left border-r border-white">
                                    <form class="text-center" action="<?= $_ENV['APP_URL'] . "/dashboard/wikis/edit" ?>" method="post">
                                        <input type="hidden" name="id" id="id" value="<?= $wiki['id'] ?>">
                                        <input type="hidden" name="photo_src" id="id" value="<?= $wiki['wiki_photo_src'] ?>">
                                        <button type="submit" class="hover:bg-green-500 hover:text-white text-green-500 border border-green-500 rounded-md p-2">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        function confirmDelete() {
            var confirmation = confirm(`Are you sure you want to delete it!`);
            return confirmation;
        }

        let wikis_btn = document.querySelector("#wikis_btn");
        let archived_wikis_btn = document.querySelector("#archived_wikis_btn");

        let wikis_table = document.querySelector("#wikis_table");
        let archived_wikis_table = document.querySelector("#archived_wikis_table");
        
        wikis_btn.addEventListener('click', function () {
            archived_wikis_table.classList.add("hidden");
            wikis_table.classList.remove("hidden");
            wikis_btn.classList.add('hidden');
            archived_wikis_btn.classList.remove('hidden');
        });

        archived_wikis_btn.addEventListener('click', function () {
            wikis_table.classList.add("hidden");
            archived_wikis_table.classList.remove("hidden");
            archived_wikis_btn.classList.add('hidden');
            wikis_btn.classList.remove('hidden');
        });

    </script>
</body>

</html>