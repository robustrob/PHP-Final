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

    <div class="scene_element--fadeinright">
        <div class="row">
            <div class="col-xs-1 col-md-2 col-lg-3"></div>
            <div class="col-xs-10 col-md-8 col-lg-6">

                <?= $data['logout'] ?>

                <?php
                $calendar = new Calendar();
                echo $calendar->show();


                /*$date = date('d-m-Y',strtotime('29-04-2016'));


                $calendar->getAvailability($date);*/
                ?>

                <h4>Legend</h4>
                <table>
                    <tr>
                        <td>
                            <div class="legeng-box available"></div>
                        </td>
                        <td>Available</td>
                    </tr>

                    <tr>
                        <td>
                            <div class="legeng-box limited"></div>
                        </td>
                        <td>Limited Places</td>
                    </tr>

                    <tr>
                        <td>
                            <div class="legeng-box booked"></div>
                        </td>
                        <td>Fully Booked</td>
                    </tr>

                    <tr>
                        <td>
                            <div class="legeng-box block"></div>
                        </td>
                        <td>N/A</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>


</div>


</body>
</html>   