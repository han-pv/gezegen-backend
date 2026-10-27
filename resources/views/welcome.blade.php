<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>{{ $message }}</h1>
    
    @foreach ($hotels as $hotel)
        <h4>
            {{ $hotel->name }}

        <span style="color:red">    SLUG:</span>
            {{ $hotel->slug }}
        </h4>
    @endforeach
</body>

</html>