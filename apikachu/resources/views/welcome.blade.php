<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-amber-400">
    <div class="flex flex-col md:flex-row gap-4 max-w-lg mx-auto mt-20 bg-amber-300 p-10 rounded shadow-lg">
        <form action="/api/generate" method="POST" class="col-span">
            @csrf
            <input type="text" name="name" placeholder="Name"
                class="mb-4 mt-1 p-2 border outline-red-500 rounded-lg w-full">
            <div class="mb-4 space-x-2">
                <input type="radio" name="image" value="1"
                    class="text-indigo-500 focus:ring-indigo-500 h-4 w-4"> Image.
                <input type="radio" name="image" value="0"
                    class="text-indigo-500 focus:ring-indigo-500 h-4 w-4"> No image.
            </div>
            <button type="submit"
                class="bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-400 text-white font-medium rounded-full p-2">Submit</button>
        </form>

    </div>

</body>

</html>
