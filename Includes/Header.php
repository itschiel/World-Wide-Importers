<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>WorldWideImporters</title>

</head>
<body>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<nav class="navbar bg-dark navbar-dark">
    <div class="form-inline">
        <form method="GET" action="results.php">
            <input name="search" type="text" class="form-control">

            <input type="hidden"  value="" name="cat"> </input>
            <input type="hidden" value="25" name="select"> </input>

            <button name="submit" type="submit" class="btn btn-primary">Zoek!</button>
        </form>
    </div>
</nav>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="row collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=1&search=&select=25" style="color: white;">Novelty items</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=2&search=&select=25" style="color: white;">Clothing</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=3&search=&select=25" style="color: white;">Mugs</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=4&search=&select=25" style="color: white;">T-shirts</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=5&search=&select=25" style="color: white;">Airline</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=6&search=&select=25" style="color: white;">Computing</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=7&search=&select=25" style="color: white;">USB</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=8&search=&select=25" style="color: white;">Furry</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=9&search=&select=25" style="color: white;">Toys</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default" href="results.php?cat=10&search=&select=25" style="color: white;">Packaging</a>
            </li>
        </ul>
    </div>
</nav>


</body>
</html>