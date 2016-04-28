<html>
<head>
    <?php
    $page = 'register';

    require_once '../BookingApp/view/header.php';

    ?>

<head>

<body>

<div class="container">

    <?php require_once '../BookingApp/view/navbar.php' ?>


    <!-- REGISTRATION FORM -->
    <div class="text-center" style="padding:50px 0">

        <?= $data['error'] ?>

        <div class="logo">register</div>
        <!-- Main Form -->
        <div class="login-form-1">
            <form id="register-form" class="text-left" method="post" action="/register/RegisterValidation">
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group">
                            <label for="reg_username" class="sr-only">Email address</label>
                            <input type="text" class="form-control" id="reg_username" name="reg_username"
                                   placeholder="username" required/>
                        </div>
                        <div class="form-group">
                            <label for="reg_password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="reg_password" name="reg_password"
                                   placeholder="password" required/>
                        </div>
                        <div class="form-group">
                            <label for="reg_password_confirm" class="sr-only">Password Confirm</label>
                            <input type="password" class="form-control" id="reg_password_confirm"
                                   name="reg_password_confirm" placeholder="confirm password" required/>
                        </div>

                        <div class="form-group">
                            <label for="reg_email" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="reg_email" name="reg_email" placeholder="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="reg_fullname" class="sr-only">Full Name</label>
                            <input type="text" class="form-control" id="reg_fullname" name="reg_firstname"
                                   placeholder="first name" required/>
                        </div>
                        <div class="form-group">
                            <label for="reg_fullname" class="sr-only">Full Name</label>
                            <input type="text" class="form-control" id="reg_fullname" name="reg_lastname"
                                   placeholder="last name" required/>
                        </div>


                        <div class="form-group login-group-checkbox">
                            <input type="checkbox" class="" id="reg_agree" name="reg_agree">
                            <label for="reg_agree">i agree with <a href="#">terms</a></label>
                        </div>
                    </div>
                    <button type="submit" class="login-button" name="register"><i class="fa fa-chevron-right"></i></button>
                </div>
                <div class="etc-login-form">
                    <p>already have an account? <a href="../login">login here</a></p>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>

</div>
<script type="text/javascript" src="../../legacy/BookingApp/assets/js/forms.js"/>

</body>
</html>