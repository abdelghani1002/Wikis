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
    <link rel="stylesheet" href=<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>>

    <!-- select2 -->
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

    <title>Dashboard</title>
    <!-- Tiny -->
    <script src="https://cdn.tiny.cloud/1/qwokz1nmmty2escna2o9lclbv8en7rr1g4j0a0kz0h74kjso/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
        .wikis {
            background-color: rgb(229 231 235 / var(--tw-bg-opacity));
        }
    </style>
</head>

<body class="h-screen">

    <?php
    require "Views/includes/navbar.php";
    ?>

    <div class="w-full flex flex-row">

        <?php
        require "Views/includes/dashboard/aside.php";
        ?>

        <div class="relative w-full mx-auto bg-white rounded-md shadow-md">
            <div class="absolute top-2 left-0">
                <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="bg-gray-300 cursor-pointer rounded-md m-2 p-1 text-md text-gray-600">
                    < Back </a>
            </div>
            <div class="w-full flex flex-col items-center overflow-y-scroll h-[88dvh]">
                <h1 class="text-2xl font-semibold mb-6">Add a Wiki</h1>

                <form class="w-2/3 p-1" action="<?= $_ENV['APP_URL'] . "/wikis/update" ?>" method="post" enctype="multipart/form-data">
                    <!-- Wiki Category -->
                    <div class="">
                        <label for="title" class="block text-gray-600 text-sm font-medium mb-2">Category</label>

                        <select type="text" id="category_id" name="category_id" class="w-full px-3 py-2 border border-slate-400 rounded-md focus:outline-none focus:border-blue-500" required>

                            <?php
                            foreach ($categories as $category) {
                            ?>
                                <option value="<?= $category['id'] ?>" <?php if ($category['name'] === $wiki['category_name']) echo "selected"; ?>>
                                    <?= $category['name'] ?>
                                </option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>

                    <!-- Wiki Title -->
                    <div class="">
                        <label for="title" class="block text-gray-600 text-sm font-medium mb-2">Title</label>
                        <input value="<?= $wiki['title'] ?>" type="text" id="title" name="title" class="w-full px-3 py-2 border border-slate-400 rounded-md focus:outline-none focus:border-blue-500" required>
                    </div>
                    <?php
                    if (isset($_SESSION['errors']['title'])) {
                        foreach ($_SESSION['errors']['title'] as $error) {
                    ?>
                            <p class="text-red-600 text-sm m-0"><?= $error ?></p>
                    <?php
                        }
                        unset($_SESSION['errors']['title']);
                    }
                    ?>

                    <!-- Tiny textarea -->
                    <script>
                        tinymce.init({
                            selector: 'textarea',
                            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                        });
                    </script>
                    <!-- Wiki Content -->
                    <div class="mt-4">
                        <label for="content" class="block text-gray-600 text-sm font-medium mb-2">Content</label>
                        <textarea id="content" name="content" placeholder="Write .."><?= $wiki['content'] ?></textarea>
                    </div>
                    <?php
                    if (isset($_SESSION['errors']["content"])) {
                        foreach ($_SESSION['errors']["content"] as $error) {
                    ?>
                            <p class="text-red-600 text-sm m-0"><?= $error ?></p>
                    <?php
                        }
                        unset($_SESSION['errors']['content']);
                    }
                    ?>
                    <!-- Wiki Tags -->
                    <div class="mt-4">
                        <select name="tags[]" class="form-select" id="multiple-select-clear-field" data-placeholder="Choose anything" multiple>
                            <?php
                            foreach ($tags as $tag) {
                            ?>
                                <option value="<?= $tag['id'] ?>" <?php if (in_array($tag['id'], $wiki_tags_ids)) echo "selected"; ?>>
                                    <?= $tag['name'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Wiki photo -->
                    <div class="mt-4">
                        <label for="photo" class="block text-gray-600 text-sm font-medium mb-2">Photo</label>
                        <input type="file" id="photo" name="photo" class="w-full px-3 py-2 border border-slate-400 rounded-md focus:outline-none focus:border-blue-500">
                    </div>
                    <?php
                    if (isset($_SESSION['errors']["photo"])) {
                        foreach ($_SESSION['errors']["photo"] as $error) {
                    ?>
                            <p class="text-red-600 text-sm m-0"><?= $error ?></p>
                    <?php
                        }
                        unset($_SESSION['errors']['photo']);
                    }
                    ?>

                    <input type="hidden" name="id" value="<?= $wiki['id'] ?>">
                    <input type="hidden" name="photo_src" value="<?= $wiki["wiki_photo_src"]; ?>" >
                    <!-- Submit Button -->
                    <div class="flex flex-row justify-center">
                        <button type="submit" class="min-w-52 bg-blue-500 text-white px-4 py-2 mt-4 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <script>
        $('#multiple-select-clear-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            allowClear: false,
        });
    </script>

</body>

</html>