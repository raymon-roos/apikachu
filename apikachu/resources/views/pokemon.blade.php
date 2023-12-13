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

    @if(isset($pokemon))
        <div class="max-w-md mx-auto mt-10 bg-amber-300 p-10 rounded shadow-lg">
            <h1>Name: {{ $pokemon['name'] }}</h1>
            <p>Description: {{$pokemon['description']}}</p>
            <p>Attack: {{$pokemon['attack']}}</p>
            <p>Defense: {{$pokemon['defense']}}</p>
            <p>Generation Id: {{ $pokemon['generation_id']}}</p>
            <p>Image appearance: {{ $pokemon['image_appearance']}}</p>
        </div>

    @endif

    @if (isset($image))
        {{-- Display the image --}}
        <div class="max-w-md mx-auto rounded shadow-lg">
        <img src="data:image/png;base64,{{ $image }}" class="mt-4" width="500" alt="Pokemon Image">
        </div>
    @endif

</body>

</html>
