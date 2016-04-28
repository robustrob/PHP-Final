<html>
<head>
    <?php
    $page = 'login';
    require_once '../BookingApp/view/header.php';

    ?>


<head>

<body>

<div class="container">

    <?php require_once '../BookingApp/view/navbar.php' ?>

    <div class="scene_element--fadeinright">
        <div class="row">
            <div class="text-center" style="padding:50px 0">

                <?= $data['error'] ?>

                <div class="logo">login</div>
                <!-- Main Form -->
                <div class="login-form-1">
                    <form id="login-form" class="text-left" action="<?= '/login/Authorize' ?>" method="POST">
                        <div class="login-form-main-message"></div>
                        <div class="main-login-form">
                            <div class="login-group">
                                <div class="form-group">
                                    <label for="lg_username" class="sr-only">Username</label>
                                    <input type="text" class="form-control" id="lg_username" name="username"
                                           placeholder="username">
                                </div>
                                <div class="form-group">
                                    <label for="lg_password" class="sr-only">Password</label>
                                    <input type="password" class="form-control" id="lg_password" name="password"
                                           placeholder="password">
                                </div>
                                <div class="form-group login-group-checkbox">
                                    <input type="checkbox" id="lg_remember" name="lg_remember">
                                    <label for="lg_remember">remember</label>
                                </div>
                            </div>
                            <button type="submit" name="login" class="login-button"><i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="etc-login-form">
                            <p>forgot your password? <a href="/forgot/index.php">click here</a></p>

                            <p>new user? <a href="/register/index.php">create new account</a></p>
                        </div>
                    </form>
                </div>
                <!-- end:Main Form -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/assets/js/forms.js"></script>

</body>
</html>