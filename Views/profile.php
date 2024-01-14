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
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>">
    <title>Profile</title>
</head>

<body>
    <?php
    include "Views/includes/navbar.php";
    ?>

    <div class="relative w-full bg-black h-72 flex items-center justify-center">
        <img class="opacity-50 w-full h-full object-cover" src="<?= $_ENV['APP_URL'] . "./public/images/library.jpg" ?>" alt="walot">
        <img class="absolute top-56 drop-shadow-2xl object-cover w-36 h-36 rounded-full" src="<?= $_ENV['APP_URL'] . $user['photo_src'] ?>" alt="user photo">
    </div>
    <div class="mt-28 flex justify-center">
        <a href="<?= $_ENV['APP_URL'] . "/wikis/create" ?>" class="py-2 px-3 bg-blue-600 text-white rounded-lg">
            Post a wiki
        </a>
    </div>
    <?php
    if (isset($_SESSION['success'])) {
    ?>
        <p class="text-green-600 p-1 text-center"><?= $_SESSION['success'] ?></p>
    <?php
        unset($_SESSION['success']);
    }
    ?>
    <div class="mb-28 container w-full mx-auto flex flex-wrap">
        <?php
        if (isset($wikis)) {
            foreach ($wikis as $wiki) {
        ?>
                <div class="match-card-display drop-shadow-md max-w-96 overflow-hidden mx-3 mt-6 flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800 sm:shrink-0 sm:grow sm:basis-0">
                    <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id=" . $wiki['id'] ?>" class="w-full max-h-32">
                        <img class="w-full h-full rounded-t-lg object-cover" src="<?= $_ENV['APP_URL'] . $wiki['wiki_photo_src'] ?>" alt="wiki" />
                    </a>
                    <div class="p-5 overflow-hidden max-h-52">
                        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            <?= $wiki['title'] ?>
                        </h5>
                        <h5 class="mb-2 text-l leading-tight text-neutral-500 dark:text-neutral-50">
                            <?= $wiki['category_name'] ?>
                        </h5>
                        <p class="overflow-hidden text-base text-neutral-600 dark:text-neutral-200">
                            <?= $wiki['content'] ?>
                        </p>
                    </div>
                    <div class="p-3 flex justify-end">
                        <form method="POST" action="<?= $_ENV['APP_URL'] . "/wikis/edit" ?>" class="mr-4">
                            <input type="hidden" name="id" value="<?= $wiki['id'] ?>">
                            <button class="text-green-800 border border-green-800 hover:text-white hover:bg-green-800 py-2 px-3 rounded inline-flex  items-center">
                                Edit &#9998;
                            </button>
                        </form>

                        <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id=" . $wiki['id'] ?>" class="text-blue-800 border border-blue-800 hover:text-white hover:bg-blue-800 py-2 px-3 rounded inline-flex  items-center">
                            View wiki
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 ml-2">
                                <path d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="mt-auto flex justify-between border-t-2 border-neutral-100 px-6 py-3 dark:border-neutral-600 dark:text-neutral-50">
                        <small>Posted <?= $wiki['wiki_created_at'] ?></small>
                        <form class="text-center" action="<?= $_ENV['APP_URL'] . "/wikis/delete" ?>" method="POST">
                            <input type="hidden" name="id" id="id" value="<?= $wiki['id'] ?>">
                            <input type="hidden" name="photo_src" id="id" value="<?= $wiki['wiki_photo_src'] ?>">
                            <button onclick="return confirmDelete()" class="text-red-800 border border-red-800 hover:text-white hover:bg-red-800 py-2 px-3 rounded inline-flex  items-center">
                                Delete &#10060;
                            </button>
                        </form>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>

    <?php
    include "Views/includes/footer.php";
    ?>


    <script>
        function confirmDelete() {
            var confirmation = confirm(`Are you sure you want to delete it!`);
            return confirmation;
        }
    </script>
</body>

</html>