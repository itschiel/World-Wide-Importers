<?php

//include_once ("mollieInit.php");
include_once "Functions/mollie.php";

?>
<html>
    <body>
    <script type="text/javascript" language="Javascript">window.open('<?php print createPayment($_GET['price']); ?>');</script>
    </body>
</html>