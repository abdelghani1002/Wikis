<nav class="w-full bg-[#008970] lg:px-10 dark:bg-gray-800">
    <div class="flex items-center justify-between px-3 py-3 lg:px-8 lg:pl-3">
        <div id="logo" class="flex items-center">
            <a href="<?= $_ENV['APP_URL'] . "/dashboard" ?>" class="flex md:mr-24 gap-2 items-center">
                <!-- Logo -->
                <img class="w-6" src="<?= $_ENV['APP_URL'] . "/public/images/logo.png" ?>" alt="LOGO">

                <span class="logo sm:text-md md:text-xl tracking-wider font-semibold text-white"><?= $_ENV['APP_NAME'] ?></span>
            </a>
        </div>

        <!-- User photo and name -->
        <div class="flex items-center gap-x-2">
            <div>
                <img class="w-10 h-10 cover rounded-full" src="" alt="user photo">
            </div>
            <div class="text-white">
                Abdelghani A.
            </div>
        </div>
    </div>
</nav>