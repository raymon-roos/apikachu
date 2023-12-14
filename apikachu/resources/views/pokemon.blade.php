<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Card</title>
    <!-- Include Tailwind CSS from CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-cyan-800 flex items-center justify-center h-screen">
    <div class="max-w-xs">
        <div class="bg-yellow-400 p-2 rounded-lg shadow-lg">
            <!-- Card Header -->
            <div class="flex justify-between px-2 py-1 bg-yellow-600 rounded-t-lg">
                <h3 class="text-white font-bold">{{ $pokemon['name'] }}</h3>
            </div>
            <!-- Card Image -->
            @if (isset($image))
                {{-- Display the image --}}
                <div class="max-w-md mx-auto rounded shadow-lg">
                    <img src="data:image/png;base64,{{ $image }}" class="mt-4" width="500"
                        alt="Pokemon Image">
                </div>
            @endif
            <!-- Card Body -->
            <div>
                <div class="bg-yellow-300 rounded p-2 text-sm">
                    <p>Image appearance: {{ $pokemon['image_appearance'] }}</p>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <span class="font-bold text-white px-2  py-2 bg-yellow-600 rounded-t-lg ">Moves:</span>
                </div>
            </div>
            <!-- Card Footer -->
            @if (isset($pokemon))
                <div
                    class="grid lg:grid-col-4 md:grid-col-3 sm:grid-col-2 px-2 py-6 bg-yellow-600 rounded-b-lg text-white text-xs">
                    <p>Attack: {{ $pokemon['attack'] }}</p>
                    <p>Defense: {{ $pokemon['defense'] }}</p>
                    <p>Generation Id: {{ $pokemon['generation_id'] }}</p>
                    <p>Description: {{ $pokemon['description'] }}</p>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
