<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

    <link rel="stylesheet" href="css/header-basic.css">
    <link rel="stylesheet" href="css/header-search.css">


</head>

    <body>

        <header class="header-search">

            <div class="header-limiter">
                    <a href="#"><img class="logologin" src="img/logo.png"></a>


                <nav class="Welcome-header">
                    <a href="/Login">Login</a>
                    <a href="#">Events</a>
                    <a href="#">Pricing</a>
                    <a href="#">About</a>
                    <a href="#">Faq</a>
                    <a href="#">Contact</a> 
                </nav>
            </div>

           

        </header>

        <!-- The content of your page would go here. -->


        <div class="menu">

           
        </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {

        $('.header-search form').on('click', function(e) {

            // If the form (which is turned into the search button) was
            // clicked directly, toggle the visibility of the search box.

            if(e.target == this) {
                $(this).find('input').toggle();
            }

        });
    });

</script>

    </body>

<style type="text/css">
    body {

        background: url(img/background/CBM.jpg);
        background-size: 100% auto;
        background-repeat: no-repeat;
        width:80px height:10px ;
    }
</style>
</html>