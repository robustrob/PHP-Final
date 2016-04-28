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

                <h2>Checkout</h2>

                <form action="/booking/confirmSession" method="post">
                    <h4>Payment</h4>

                    <div class="form-group">
                        <label for="PaymentMethod">Payment Method</label>
                        <select id="PaymentMethod" name="PaymentMethod" class="form-control" required>
                            <option>- Select a Payment Method -</option>
                            <?= $data['PaymentMethods'] ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cc">Credit Card #</label>
                        <input type="text" class="form-control" id="cc" placeholder="####-####-####-####" name="CreditCard"
                               required/>
                    </div>
                    <br/>


                    <h4>Billing Information</h4>


                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" placeholder="FirstName" name="FirstName"
                               required/>
                    </div>

                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" placeholder="LastName" name="LastName"
                               required/>
                    </div>

                    <div class="form-group">
                        <label for="Address">Address</label>
                        <input type="text" class="form-control" id="Address" placeholder="Address"
                               name="Address" required/>
                    </div>

                    <div class="form-group">
                        <label for="City">City</label>
                        <input type="text" class="form-control" id="City" placeholder="City"
                               name="City" required/>
                    </div>

                    <div class="form-group">
                        <label for="Province">Province</label>
                        <input type="text" class="form-control" id="Province" placeholder="Province"
                               name="Province" required/>
                    </div>

                    <div class="form-group">
                        <label for="Country">Country</label>
                        <input type="text" class="form-control" id="Country" placeholder="Country"
                               name="Country" required/>
                    </div>

                    <div class="form-group">
                        <label for="Zip">Zip</label>
                        <input type="text" class="form-control" id="Zip" placeholder="Zip"
                               name="Zip" required/>
                    </div>


                    <button type="submit" class="btn btn-default" name="confirm">Confirm</button>
                </form>

            </div>


        </div>
    </div>
</div>

</body>
</html>   