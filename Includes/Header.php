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
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<nav class="navbar bg-dark navbar-dark">
    <div class="form-inline">
        <form method="GET" <?php print("action='searchresult.php?search='". $_GET['search'])?>>
            <input name="search" type="text" class="form-control">
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
                <a class="nav-link" href="#">Categorie1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie4</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie5</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie6</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie7</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie8</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie9</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categorie10</a>
            </li>
        </ul>
    </div>
</nav>


</body>
</html>