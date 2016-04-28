<html>
<head>

    <?php
    $page = 'admin';
    require_once '../BookingApp/view/header.php';

    function get_users($users)
    {
        $options = '';

        for ($i = 0; $i < count($users); $i++) {
            // $i is index or key and  $data['users'][$i] is for user name
            $options .= '<option value="' . $users[$i][0] . '">' . $users[$i][0] . '</option>';
        }
        return $options;
    }

    ?>

</head>
<body>
<div class="container ">

    <?php require_once '../BookingApp/view/navbar.php' ?>
    <div class="row">
        <div class="col-xs-2 col-md-4"></div>
        <div class="col-xs-8 col-md-4">
            <?= $data['error'] ?>
        </div>
    </div>

    <div class="scene_element--fadeinup">
        <div class="row">
            <div class="col-xs-1 col-md-2 col-lg-3"></div>
            <div class="col-xs-5 col-md-4 col-lg-3">

                <h2>Add a user</h2>

                <form action="/admin/AddUser" method="post">

                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control" id="uname" placeholder="UserName" name="UserName"
                               required/>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="Password"
                               required/>
                    </div>

                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" class="form-control" id="password" placeholder="ConfirmPassword"
                               name="ConfirmPassword" required/>
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="Email" required/>
                    </div>

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


                    <button type="submit" class="btn btn-default" name="addUser">Add User</button>
                </form>

            </div>

            <div class="col-xs-5 col-md-4 col-lg-3">
                <h2> Delete User</h2>

                <form action="/admin/DeleteUser" method="post">

                    <div class="form-group">

                        <label for="DeleteUser">Select a User</label>
                        <select id="DeleteUser" name="DeleteUser" class="form-control">
                            <?php
                            echo get_users($data['users']);
                            ?>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-default" name="deleteUser">Delete User</button>
                </form>

            </div>
        </div>
    </div>
</div>


</body>
</html>   