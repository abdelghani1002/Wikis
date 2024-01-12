<?php
session_start()
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
            <div class="flex flex-row items-center py-1 w-full px-2">
                <h3 class="mr-auto text-2xl font-bold text-cyan-800">Wikis (<?= count($wikis) ?>)</h3>
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

                <!-- Table -->
                <table class="table-auto w-full text-sm whitespace-no-wrap border-spacing-2 px-2 pb-2">
                    <thead class="">
                        <tr class="bg-gray-400">
                            <th class="p-1 border-r border-gray-200">View</th>
                            <th class="p-1 border-r border-gray-200">Author</th>
                            <th class="p-1 border-r border-gray-200">Title</th>
                            <th class="p-1 border-r border-gray-200">Status</th>
                            <th class="p-1 border-r border-gray-200">Category</th>
                            <th class="p-1 border-r border-gray-200">Created</th>
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

                                <td class="p-1 border-r border-white text-center">
                                    <div class="rounded-lg p-0.5 font-semibold <?php if ($wiki['status'] === "pending") echo "bg-amber-100 text-amber-500";
                                                                                else echo "bg-green-100 text-lime-500"; ?>">
                                        <?= $wiki['status'] ?>
                                    </div>
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
    </script>
</body>

</html>