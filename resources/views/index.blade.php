<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $article ? $article->title : 'SYRIAN RESEARCHERS' }}"/>
    <meta property="og:description" content="{{ $article ? $article->title : 'SYRIAN RESEARCHERS'    }}"/>
    <meta property="og:url" content="{{ $article ? 'https://svu-res.me/article/'. $article->id : 'https://svu-res.me'    }}"/>
    <meta property="og:title" content="{{ 'SYRIAN RESEARCHERS' }}"/>
    <meta property="og:image"     content="{{ $article ? asset('image/'.$article->homePicture->path) : ''}}"/>
    <meta property="og:image:url" content="{{ $article ? asset('image/'.$article->homePicture->path) : ''    }}"/>
    <meta property="og:image:secure_url" content="{{ $article ? asset('image/'.$article->homePicture->path) : ''    }}"/>
    <meta property="og:image:width"  content="1240"/>
    <meta property="og:image:height" content="650"/>
    <meta property="og:type" content="article">
    <meta property="og:locale" content="ar_AR">
    <link rel="canonical" href="{{ $article ? 'https://svu-res.me/article/'. $article->id : 'https://svu-res.me'    }}">
    <meta property="fb:pages" content="111362890429466" />
    <title>SYR-RES</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Styles -->

</head>
<body>
<div id="app">
<index></index>
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
<script>
    window.Laravel = {
        "baseUrl": "https:\/\/svu-res.me\/"
    }
</script>
</body>
</html>
