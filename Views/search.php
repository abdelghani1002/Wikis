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
    <link rel="shortcut icon" href="<?= $_ENV['APP_URL'] . "/public/images/favicon.ico" ?>" type="image/x-icon">
    <title>Wikis-Search</title>
</head>

<body class="bg-slate-50">

    <?php
    include 'Views/includes/navbar.php';
    ?>

    <div class="dark:bg-slate-700 px-6 flex justify-center items-center">
        <div class="container w-full max-h-full mx-auto bg-mainBlue rounded-lg px-10">
            <form>
                <div class="sm:flex items-center my-5 bg-white dark:bg-zinc-500 rounded-full overflow-hidden p-2 px-5 justify-center border border-green-300">
                    <input id="search" class="outline-none text-md font-poppins dark:bg-zinc-500 font-medium text-gray-800 dark:text-gray-100 flex-grow" type="text" placeholder="Search wiki..." />
                    <div class="ms:flex items-center justify-center px-6 rounded-full space-x-4 mx-auto ">

                        <select id="category" name="category" class="text-sm dark:bg-zinc-600 dark:text-gray-200 text-gray-800  font-poppins font-semibold outline-none border-2 px-8 py-2 rounded-full">
                            <?php
                            foreach ($categories as $category) {
                            ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <button class="bg-custom-green text-white font-bold  rounded-full px-6 py-3 font-poppins">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container max-w-7xl px-2 mx-auto min-h-[88vh]">
        <div id="parent" class="grid-cols-1 sm:grid md:grid-cols-3 ">
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

    <?php
    include 'Views/includes/footer.php';
    ?>

    <script>
        document.getElementById("search").addEventListener("input", function() {
            var search = document.getElementById("search").value;
            var x = new XMLHttpRequest();
            x.open("GET", "http://localhost/Wikis/wikis?search=" + search, true);
            x.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200 && (JSON.parse(this.response)).length) {
                    var res = JSON.parse(this.response);

                    var parent = document.getElementById("parent");
                    parent.innerHTML = "";

                    res.forEach(wiki => {
                        var div = document.createElement("div");
                        div.className = "match-card-display mx-3 mt-6 flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800 sm:shrink-0 sm:grow sm:basis-0";

                        div.innerHTML = `
                        <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id=" ?>${wiki.id}" class="w-full max-h-32">
                            <img class="w-full h-full rounded-t-lg object-cover" src="<?= $_ENV['APP_URL'] ?>${wiki.wiki_photo_src}" alt="wiki" />
                        </a>
                        <div class="p-5 overflow-hidden max-h-52">
                            <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                ${wiki.title}
                            </h5>
                            <h5 class="mb-2 text-l leading-tight text-neutral-500 dark:text-neutral-50">
                                ${wiki.category_name}
                            </h5>
                            <p class="overflow-hidden text-base text-neutral-600 dark:text-neutral-200">
                                ${wiki.content}
                            </p>
                        </div>
                        <div class="p-3 flex justify-end">
                            <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id=" ?>${wiki.id}" class="text-blue-800 border border-blue-800 hover:text-white hover:bg-blue-800 py-2 px-3 rounded inline-flex  items-center">
                                View wiki
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 ml-2">
                                    <path d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="mt-auto border-t-2 border-neutral-100 px-6 py-3 dark:border-neutral-600 dark:text-neutral-50">
                            <small>Posted ${wiki.wiki_created_at}</small>
                        </div>`;

                        parent.appendChild(div);
                    });
                } else {
                    var parent = document.getElementById("parent");
                    parent.innerHTML = "<p class='mx-auto text-center'>No result !.</p>";
                }
            };
            x.send();
        });

        document.getElementById("category").addEventListener("change", function() {
            var category_id = document.getElementById("category").value;
            console.log(category_id);

            var x = new XMLHttpRequest();
            x.open("GET", "http://localhost/Wikis/wikis?category_id=" + category_id, true);
            x.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200 && (JSON.parse(this.response)).length) {
                    var res = JSON.parse(this.response);

                    var parent = document.getElementById("parent");
                    parent.innerHTML = "";

                    res.forEach(wiki => {
                        var div = document.createElement("div");
                        div.className = "match-card-display mx-3 mt-6 flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-gray-800 sm:shrink-0 sm:grow sm:basis-0";

                        div.innerHTML = `
                        <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id=" ?>${wiki.id}" class="w-full max-h-32">
                            <img class="w-full h-full rounded-t-lg object-cover" src="<?= $_ENV['APP_URL'] . $wiki['wiki_photo_src'] ?>" alt="wiki" />
                        </a>
                        <div class="p-5 overflow-hidden max-h-52">
                            <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                ${wiki.title}
                            </h5>
                            <h5 class="mb-2 text-l leading-tight text-neutral-500 dark:text-neutral-50">
                                ${wiki.category_name}
                            </h5>
                            <p class="overflow-hidden text-base text-neutral-600 dark:text-neutral-200">
                                ${wiki.content}
                            </p>
                        </div>
                        <div class="p-3 flex justify-end">
                            <a href="<?= $_ENV['APP_URL'] . "/wikis/show?id="   ?> ${wiki.id}" class="text-blue-800 border border-blue-800 hover:text-white hover:bg-blue-800 py-2 px-3 rounded inline-flex  items-center">
                                View wiki
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 ml-2">
                                    <path d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="mt-auto border-t-2 border-neutral-100 px-6 py-3 dark:border-neutral-600 dark:text-neutral-50">
                            <small>Posted ${wiki.wiki_created_at}</small>
                        </div>`;

                        parent.appendChild(div);
                    });
                } else {
                    var parent = document.getElementById("parent");
                    parent.innerHTML = "<p class='mx-auto text-center'>No result !.</p>";
                }
            };
            x.send();
        });
    </script>
</body>

</html>