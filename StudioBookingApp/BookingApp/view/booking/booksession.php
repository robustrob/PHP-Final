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

    <div class="scene_element--fadeinup">
        <div class="row">

            <div class="col-xs-1 col-md-2 col-lg-3"></div>
            <div class="col-xs-10 col-md-8 col-lg-6">

                <?= $data['error'] ?>

                <div class="text-center">
                <h1>Book a Session</h1>
                </div>

                <form class="form-horizontal" method="post" action="/booking/validateSession">
                    <div class="form-group">
                        <label for="inputDate" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputDate" placeholder="Date" name="date" value="<?= $data['date'] ?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStartTime" class="col-sm-3 control-label">Start Time</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control" name="StartTime" id="inputStartTime" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEndTime" class="col-sm-3 control-label">End Time</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control" name="EndTime" id="inputEndTime" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDate" class="col-sm-3 control-label">Minimum Payment</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputDate" placeholder="Date" value="<?= $data['minPayment'] ?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" name="checkout" class="btn btn-default">Proceed to checkout</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>


</body>
</html>   