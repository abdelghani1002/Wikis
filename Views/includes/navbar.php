<nav class="w-full bg-[#008970] lg:px-10 dark:bg-gray-800">
    <div class="flex items-center justify-between px-3 py-3 lg:px-8 lg:pl-3">
        <div id="logo" class="flex items-center">
            <a href="<?= $_ENV['APP_URL'] . "/dashboard" ?>" class="flex md:mr-24 gap-2 items-center">
                <!-- Logo -->
                <img class="w-10" src="<?= $_ENV['APP_URL'] . "/public/images/logo.png" ?>" alt="LOGO">

                <span class="logo sm:text-md md:text-xl tracking-wider font-semibold text-white"><?= $_ENV['APP_NAME'] ?></span>
            </a>
        </div>

        <!-- User photo and name -->
        <?php
        if (isset($_SESSION['user'])) {

        ?>
            <div class="flex gap-4">
                <div class="flex items-center">
                    <a href="<?= $_ENV['APP_URL'] . '/logout' ?>" class="text-white hover:text-gray-300 hover:border-gray-300 rounded-xl border border-gray-200 py-2 px-3">
                        Log out
                    </a>
                </div>
                <a href="<?php if($_SESSION['user']['role'] === "author") echo($_ENV['APP_URL'] . "/profile"); else echo($_ENV['APP_URL'] . "/dashboard"); ?>" class="flex items-center gap-x-2">
                    <div>
                        <img class="w-10 h-10 cover rounded-full" src="<?= $_ENV['APP_URL'] . $_SESSION['user']['photo_src'] ?>" alt="user photo">
                    </div>
                    <div class="text-white">
                        <?= $_SESSION['user']['name'] ?>
                    </div>
                </a>
            </div>
        <?php
        } else {
        ?>
            <div class="flex gap-4">
                <div class="flex items-center">
                    <a href="<?= $_ENV['APP_URL'] . '/login' ?>" class="text-blue-500 bg-white hover:text-white hover:bg-blue-500 rounded-xl border border-blue-500 py-2 px-3">
                        Login
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="<?= $_ENV['APP_URL'] . '/signup' ?>" class="text-white bg-blue-600  hover:bg-blue-700 rounded-xl border border-blue-500 py-2 px-3">
                        Sign up
                    </a>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</nav>