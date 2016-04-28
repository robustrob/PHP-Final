<html>
<head>

    <?php
    $page = 'admin';
    require_once '../BookingApp/view/header.php';
    ?>

</head>
<body>
<div class="container">


    <?php require_once '../BookingApp/view/navbar.php' ?>

    <div class="scene_element--fadeinup">
        <div class="row">
            <div class="col-xs-1 col-md-2 col-lg-3"></div>
            <div class="col-xs-10 col-md-8 col-lg-6">

                <?= $data['error'] ?>

            </div>


        </div>
    </div>
</div>

</body>
</html>   