<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>" rel="stylesheet" />
    <title>Wiki-show</title>
</head>

<body class="bg-white dark:bg-gray-900">
    <!-- header -->
    <?php
    include "Views/includes/navbar.php";
    ?>
    <!-- / header -->


    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 object-cover rounded-full" src="<?= $_ENV['APP_URL'] . $wiki['author_photo_src'] ?>" alt="Author" />
                            <div>
                                <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white"><?= $wiki['author_name'] ?></a>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    Graphic Designer, educator & CEO Flowbite
                                </p>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    <time pubdate datetime="2022-02-08" title="February 8th, 2022"><?= $wiki['wiki_created_at'] ?></time>
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        <?= $wiki['title'] ?>
                    </h1>
                </header>

                <div class="mb-3">
                    <img class="w-full" src="<?= $_ENV['APP_URL'] . $wiki['wiki_photo_src'] ?>" alt="wikiPhoto">
                </div>
                <div class="mb-2 flex flex-wrap gap-2 p-3 bg-slate-100">
                    <?php
                    if (count($wiki['tags'])) {
                        foreach ($wiki['tags'] as $tag) {

                    ?>
                    <span class="py-1 px-2 bg-gray-300 rounded-lg text-gray-800"><?= $tag['name'] ?></span>
                    <?php
                        }
                    }
                    ?>
                </div>
                <?= $wiki['content'] ?>
            </article>
        </div>
    </main>

    <?php
    include "Views/includes/footer.php";
    ?>
</body>

</html>