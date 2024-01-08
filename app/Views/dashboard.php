<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>>
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/input.css" ?>>
    <title>Dashboard</title>
    <style>
        .statistics {
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
        require "app/Views/includes/aside.php";
        require "app/Views/includes/statistics.php";
        ?>

    </div>

</body>

</html>