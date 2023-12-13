<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="/api/generate" method="POST">
        @csrf
        <input type="text" name="name" placeholder="name"> Name
        <input type="radio" name="image" value="1"> image
        <input type="radio" name="image" value="0"> no image
        <input type="submit">Submit</button>
    </form>

</body>
</html>