<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find Food For The Slow Carb Diet">
    <meta name="author" content="Joe Fearnley">
    
    <title>Slow Carb Search | Admin</title>
    <link href="//netdna.bootstrapcdn.com/bootswatch/3.0.0/spacelab/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/admin">Slow carb search - Admin</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin/logout">logout</a></li>
            </ul>
        </div>
    </div>
    <div class="container">

@if (Session::has('saved_message'))
    <div class="food-saved">
        {{ Session::get('saved_message') }}
    </div>
@endif
