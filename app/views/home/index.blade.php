<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Search for foods allowed on the Slow Carb Diet">
    <meta name="author" content="Joe Fearnley">

    <title>Slow Carb Search</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/stylish-portfolio.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand"><a href="/">Slow Carb Search</a></li>
            <li><a href="/">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
        </ul>
    </nav>
    <script type="text/x-handlebars">
    <header id="top" class="header">
        <div class="text-vertical-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-lg-offset-2">
                        <form action="/" method="method" id="searchform" class="searchform" role="form"></form>
                            <div class="form-group">
                                <input type="text" id="q" class="form-control input-large input-food" placeholder="Slow Carb Search" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-lg-offset-2">
                        <div class="results">
                            <strong><span id="input">Test</span></strong> is allowed on the Slow Carb Diet
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    </script>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><strong>Start Bootstrap</strong></h4>
                    <p>3481 Melrose Place<br>Beverly Hills, CA 90210</p>
                </div>
            </div>
        </div>
    </footer>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ember.js/1.9.1/ember.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ember-data.js/1.0.0-beta.14.1/ember-data.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/app.js"></script>

<script>
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
</script>
</body>
</html>