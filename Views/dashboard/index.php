<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>>
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/input.css" ?>>
    <link rel="shortcut icon" href="<?= $_ENV['APP_URL'] . "/public/images/favicon.ico" ?>" type="image/x-icon">
    <title>Dashboard</title>
    <style>
        .statistics {
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
        <div class="md:w-5/6 max-h-[90dvh] -ml-[90px] md:-ml-0">
            <div class="p-2 rounded-lg dark:border-gray-700 flex flex-col grow justify-between h-full">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="flex flex-col grow items-center bg-green-500 justify-center h-24 rounded dark:bg-gray-800">
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            200%
                        </p>
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            a statistic
                        </p>

                    </div>
                    <div class="flex flex-col grow items-center bg-green-500 justify-center h-24 rounded dark:bg-gray-800">
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            200%
                        </p>
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            a statistic
                        </p>

                    </div>
                    <div class="flex flex-col grow items-center bg-green-500 justify-center h-24 rounded dark:bg-gray-800">
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            200%
                        </p>
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            a statistic
                        </p>

                    </div>
                </div>

                <div class="flex flex-col grow bg-green-500 items-center justify-center h-48 mb-4 rounded dark:bg-gray-800">
                    <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                        100%
                    </p>
                    <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                        important
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col grow items-center justify-center rounded bg-green-500 h-28 dark:bg-gray-800">
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            63%
                        </p>
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            other statistic
                        </p>
                    </div>
                    <div class="flex flex-col grow items-center justify-center rounded bg-green-500 h-28 dark:bg-gray-800">
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            63%
                        </p>
                        <p class="text-md md:text-2xl  text-gray-100 dark:text-gray-500">
                            other statistic
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>