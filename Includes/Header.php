<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php include_once 'Functions/dbConnections.php'; ?>

    <title>WorldWideImporters</title>

</head>
<body>


<div class="mx-auto">

    <div class="row bg-dark">
        <!-- logo -->
        <div class="col-2 align-self-center" style="">
            <img src="img/wwiLogo.png" style="max-width: 100%;">
        </div>

        <!-- search -->
        <div class="col-8 align-self-center">

            <form method="GET" action="Results.php"> <!-- die margins zijn niet idiaal maar kan niks beters vinden -->
                <div class="input-group">
                    
                    <input name="search" type="text" class="form-control">
                    <input type="hidden"  value="" name="cat"> </input>
                    <input type="hidden" value="25" name="select"> </input>

                    <div class="input-group-append">
                        <button name="submit" type="submit" class="btn btn-primary">Zoek!</button>
                    </div>
                </div>
            </form>


        </div>

        <!-- login button -->
        <div class="col-2 align-self-center text-center">
            <a href="login meuk/login.php" style="color: white; margin: 0 auto;"> Inloggen <a>
        </div>
    </div>

    <div class="row bg-secondary">

        <nav class="navbar navbar-expand-sm" style="margin: 0 auto;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav">
            
            <?php
                $query = ("SELECT StockGroupID, StockGroupName FROM stockgroups");
                $result = mysqli_query(dbConnectionRoot(), $query);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        print('
                            <li class="nav-item">
                                <a class="btn btn-default" href="Results.php?cat=' . $row["StockGroupID"] . '&search=&select=25" style="color: white;">' . $row["StockGroupName"] . '</a>
                            </li>
                        ');
                    }
                }
            ?>
        </nav>
    </div>
</div>
</body>
</html>
