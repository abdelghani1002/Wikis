<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>>
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/input.css" ?>>
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] . "/public/assets/font-awesome/css/font-awesome.min.css" ?>">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Dashboard</title>
    <style>
        .tags {
            background-color: rgb(229 231 235 / var(--tw-bg-opacity));
        }
    </style>
</head>

<body class="h-full">

    <?php
    require "app/Views/includes/navbar.php";
    ?>

    <div class="w-full flex flex-row h-full">

        <?php
        require "app/Views/includes/dashboard/aside.php";
        ?>
        <div class="w-5/6">
            <div class="flex flex-row items-center py-1 w-full px-2">
                <h3 class="mr-auto text-2xl font-bold text-cyan-800">Tags (<?= count($tags) ?>)</h3>
                <form id="form" action="<?= $_ENV['APP_URL'] . "/dashboard/tags/store" ?> " method="POST">
                    <input type="text" id="name" name="name" class="px-3 py-1.5 -mr-2 border border-slate-400 rounded-md focus:outline-none focus:border-blue-500" required placeholder="Enter tag name">
                    <button id="addTag" class="cursor-pointer px-3 py-1.5 text-white font-bold bg-blue-600 rounded-e-xl hover:bg-blue-800">
                        + Add Tag
                    </button>
                </form>
            </div>
            <?php
            if (isset($_SESSION['success'])) {
            ?>
                <p class="text-green-600 p-1 text-right"><?= $_SESSION['success'] ?></p>
                <?php
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['errors']["name"])) {
                foreach ($_SESSION['errors']["name"] as $error) {
                ?>
                    <p class="text-red-600 p-1 text-right"><?= $error ?></p>
            <?php
                }
                unset($_SESSION['errors']);
            }
            ?>
            <div class="flex flex-col w-full overflow-y-scroll max-h-[79vh]">

                <!-- Table -->
                <table class="table-auto w-full text-sm whitespace-no-wrap border-spacing-2 px-2 pb-2">
                    <thead class="">
                        <tr class="bg-gray-400">
                            <th class="p-1 border-r border-gray-200">View</th>
                            <th class="p-1 border-r border-gray-200">Name</th>
                            <th class="p-1 border-r border-gray-200">Created</th>
                            <th class="p-1" colspan="2">
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($tags as $tag) :
                        ?>
                            <tr class="odd:bg-gray-200 even:bg-gray-300">
                                <td class="p-1 text-center border-r border-white w-10">
                                    <a href="#" class="p-1 text-blue-600">
                                        <i class="hover:scale-125 fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $tag['name'] ?>
                                    </p>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $tag['created_at'] ?>
                                    </p>
                                </td>

                                <td class="text-right border-r border-white">
                                    <form class="text-center" action="<?= $_ENV['APP_URL'] . "/dashboard/tags/delete" ?>" method="POST">
                                        <input type="hidden" name="id" id="id" value="<?= $tag['id'] ?>">
                                        <button class="hover:bg-red-500 hover:text-white text-red-500 border border-red-500 rounded-md p-2" onclick="return confirmDelete()">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                                <td class="border-r border-white text-center">
                                    <button data-name="<?= $tag['name'] ?>" data-id="<?= $tag['id'] ?>" class="editBtn hover:bg-green-500 hover:text-white text-green-500 border border-green-500 rounded-md p-2">Update</button>
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

    <script src="<?= $_ENV["APP_URL"] . "/public/assets/js/deleteConfirm.js" ?>"></script>
    <script src="<?= $_ENV["APP_URL"] . "/public/assets/js/tags.js" ?>"></script>
</body>

</html>