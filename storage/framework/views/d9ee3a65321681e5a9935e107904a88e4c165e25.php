<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <meta property="og:image:width"  content="1240"/>
    <meta property="og:image:height" content="650"/>

    <meta property="og:locale" content="ar_AR">
    
    <meta property="fb:pages" content="111362890429466" />
    <title>GIF Browsing</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Styles -->

</head>
<body>
<div id="app">
<index></index>
</div>

<script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
<script>
    window.Laravel = {
        "baseUrl": "http://localhost:8000/"
    }
</script>
</body>
</html>
<?php /**PATH C:\remote\polished\resources\views/index.blade.php ENDPATH**/ ?>