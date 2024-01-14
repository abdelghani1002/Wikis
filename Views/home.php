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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?> ">
    <title>home</title>
</head>

<body class="dark:bg-gray-900 bg-gray-50">
    <?php
    include 'Views/includes/navbar.php';
    ?>

    <!-- Hero section -->
    <section>
        <div class="relative bg-gradient-to-r from-black to-black py-16 font-[sans-serif]">
            <div class="absolute inset-0">
                <img src="public/images/library.jpg" alt="Background Image" class="w-full h-full object-cover opacity-50" />
            </div>
            <div class="relative max-w-screen-xl mx-auto px-8 z-10 text-center text-white">
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">Welcome to Wikis : Your Source for Informative Articles</h1>
                <p class="text-lg md:text-xl mb-8">Experience excellence like never before with our exclusive products and services.</p>

                <?php
                if (!isset($_SESSION['user'])) {
                ?>
                    <a href="<?= $_ENV['APP_URL'] . "/signup" ?>" type="button" class="bg-blue-500 hover:bg-blue-600 text-white text-base font-semibold px-8 py-2.5 rounded-full transition duration-300 ease-in-out shadow-lg hover:shadow-xl">Get Started</a>
                <?php

                } else {
                ?>
                    <a href="<?= $_ENV['APP_URL'] . "/wikis/create" ?>" type="button" class="bg-blue-500 hover:bg-blue-600 text-white text-base font-semibold px-8 py-2.5 rounded-full transition duration-300 ease-in-out shadow-lg hover:shadow-xl">Post a wiki</a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- wikis -->
    <section class="py-2 ">
        <div>
            <h2 class=" text-2xl font-bold text-center sm:text-4xl">Lastest Wikis</h2>
            <p class="max-w-3xl mx-auto mt-4 text-xl text-gray-400 dark:text-white text-center ">Explore the latest features that enhance your learning experience and make it even more exciting.</p>
        </div>
        <!-- Last 5 wikis -->
        <div class="container max-w-7xl px-2 mx-auto">
            <div id="match-container" class="grid-cols-1 sm:grid md:grid-cols-3 ">
                <?php
                foreach ($wikis as $wiki) {
                ?>

                    <div class="match-card-display  mx-3 mt-6 flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800 sm:shrink-0 sm:grow sm:basis-0">
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
                            <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id=" . $wiki['id'] ?>" class="text-blue-800 border border-blue-800 hover:text-white hover:bg-blue-800 py-2 px-3 rounded inline-flex  items-center">
                                View wiki
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 ml-2">
                                    <path d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="mt-auto border-t-2 border-neutral-100 px-6 py-3 dark:border-neutral-600 dark:text-neutral-50">
                            <small>Posted <?= $wiki['wiki_created_at'] ?></small>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        
    </section>
    
    <!-- Go to all wikis -->
    <section>
        <div class="relative bg-gradient-to-r from-black to-black py-16 font-[sans-serif]">
            <div class="absolute inset-0">
                <img src="public/images/loadmore.jpg" alt="Background Image" class="w-full h-full object-cover opacity-50" />
            </div>

            <div class="relative max-w-screen-xl mx-auto px-8 z-10 text-center text-white">
                <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">Explore More in Our Wiki</h2>
                <p class="text-lg md:text-xl mb-8">Discover a wide array of articles on various topics in our wiki section. View all articles to expand your knowledge!</p>
                <a href="<?= $_ENV['APP_URL'] . "/search" ?>" type="button" class="bg-blue-100 text-blue-800 hover:bg-blue-800 hover:text-white text-base font-semibold px-8 py-2.5 rounded-full transition duration-300 ease-in-out shadow-lg hover:shadow-xl">view all wikis</a>
            </div>
        </div>
    </section>

    <?php include "Views/includes/footer.php" ?>

</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

</html>