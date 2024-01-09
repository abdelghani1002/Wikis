<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] . "/public/assets/dist/output.css" ?>">
    <title>Not Found !</title>
</head>

<body class="dark:bg-gray-800  bg-gray-300">
    <div class="mt-24 flex flex-col justify-center text-center">
        <h1 class="mb-4 text-6xl font-poppins tracking-wider font-semibold text-green-700">404</h1>
        <p class="mb-4 text-lg font-poppins tracking-wider text-gray-600">Oops! Looks like you're lost.</p>
        <div class="animate-bounce">
            <svg class="mx-auto h-16 w-16 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
        </div>
        <p class="mt-4 font-poppins tracking-wider text-gray-600">Let's get you back <a href="<?= $_ENV['APP_URL'] ?>" class="text-blue-500 font-bold">home</a>.</p>
    </div>
</body>
</html>