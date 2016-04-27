<html>
<head>

    <?php
    $page = 'home';
    require_once '../BookingApp/view/header.php';
    ?>

</head>
<body>
<div class="container">


    <?php require_once '../BookingApp/view/navbar.php' ?>

    <div class="col-xs-1 col-md-2 col-lg-3"></div>
    <div class="col-xs-10 col-md-8 col-lg-6">

        <?php
        $calendar = new Calendar();
        echo $calendar->show();
        ?>

    </div>


</div>


</body>
</html>   