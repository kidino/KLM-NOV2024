<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daisy UI Test</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head> 
<body>
    <div class="rating">
    <input type="radio" name="rating-4" class="mask mask-star-2 bg-green-500" />
    <input type="radio" name="rating-4" class="mask mask-star-2 bg-green-500" checked="checked" />
    <input type="radio" name="rating-4" class="mask mask-star-2 bg-green-500" />
    <input type="radio" name="rating-4" class="mask mask-star-2 bg-green-500" />
    <input type="radio" name="rating-4" class="mask mask-star-2 bg-green-500" />
    </div>
</body>
</html>