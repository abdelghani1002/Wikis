<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>>
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/input.css" ?>>
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] . "/public/assets/font-awesome/css/font-awesome.min.css" ?>">    <title>Dashboard</title>
    <style>
        .categories {
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
                <h3 class="mr-auto text-2xl font-bold text-cyan-800">Categories (<?= count($categories) ?>)</h3>
                <a class="cursor-pointer text-white font-bold bg-blue-600 rounded-xl p-2 h-10 hover:bg-blue-600" href="<?= $_ENV['APP_URL'] . '/dashboard/categories/create' ?>">
                    + Add Category
                </a>
            </div>
            <?php
            if (isset($_SESSION['success_update'])) {
            ?>
                <p class="text-green-600 p-1 w-100 text-center"><?= $_SESSION['success_update'] ?></p>
            <?php
                unset($_SESSION['success_update']);
            }
            ?>
            <div class="flex flex-col w-full overflow-y-scroll max-h-[79vh]">

                <!-- Table -->
                <table class="table-auto w-full text-sm whitespace-no-wrap border-spacing-2 px-2 pb-2">
                    <thead class="">
                        <tr class="bg-gray-400">
                            <th class="p-1 border-r border-gray-200">View</th>
                            <th class="p-1 border-r border-gray-200">Name</th>
                            <th class="p-1 border-r border-gray-200">Slogan</th>
                            <th class="p-1 border-r border-gray-200">Photo</th>
                            <th class="p-1 border-r border-gray-200">Created</th>
                            <th class="p-1" colspan="2">
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($categories as $category) :
                        ?>
                            <tr class="odd:bg-gray-200 even:bg-gray-300">
                                <td class="p-1 text-center border-r border-white w-10">
                                    <a href="#" class="p-1 text-blue-600">
                                    <i class="hover:scale-125 fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $category['name'] ?>
                                    </p>
                                </td>

                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $category['slogan'] ?>
                                    </p>
                                </td>
                                
                                <td class="p-1 border-r border-white">
                                    <div class="w-20 m-auto">
                                        <img class="rounded-md" src="<?= $_ENV['APP_URL'] . $category["photo_src"] ?>" alt="category photo">
                                    </div>
                                </td>
                                
                                <td class="p-1 border-r border-white">
                                    <p class="font-semibold text-center">
                                        <?= $category['created_at'] ?>
                                    </p>
                                </td>

                                <td class="text-right border-r border-white">
                                    <form class="text-center" action="<?= $_ENV['APP_URL'] . "/dashboard/categories/delete" ?>" method="POST">
                                        <input type="hidden" name="id" id="id" value="<?= $category['id'] ?>">
                                        <button class="hover:bg-red-500 hover:text-white text-red-500 border border-red-500 rounded-md p-2" onclick="return confirmDelete()">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                                <td class="text-left border-r border-white">
                                    <form class="text-center" action="<?= $_ENV['APP_URL'] . "/dashboard/categories/edit" ?>" method="post">
                                        <input type="hidden" name="id" id="id" value="<?= $category['id'] ?>">
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