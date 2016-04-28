<html>
<head>
    <?php
    $page = 'booking';
    require_once '../BookingApp/view/header.php';
    ?>

</head>
<body>


<div class="container">

    <?php require_once '../BookingApp/view/navbar.php' ?>

    <div class="scene_element--fadeinright">
        <div class="row">
            <div class="col-xs-1 col-md-2 col-lg-3"></div>
            <div class="col-xs-10 col-md-8 col-lg-6">


                <?php


                $date = '';

                if (isset($data['date']) && $data['date'] != '') {
                    $time = strtotime($data['date']);

                    $date = date('d-m-Y', $time);
                } else {
                    $date = date('d-m-Y');
                }


                echo '<h4>Date: ' . $date . '</h4>';

                $calendar = new Calendar();

                echo $calendar->getSessionsVisual($date);


                ?>


                <a href="/booking/booksession/<?= $date ?>">
                    <button type="button" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Book a session
                    </button>
                </a>


            </div>
        </div>
    </div>


</div>


</body>
</html>   