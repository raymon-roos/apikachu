<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @if(isset($pokemon))
        {{ print_r($pokemon); }}
    @endif

    @if(isset($image))
        {{-- Display the image --}}
        <img src="data:image/png;base64,{{ $image }}" alt="Pokemon Image">
    @endif

</body>
</html>