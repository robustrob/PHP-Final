<html>
<head>

    <?php
    $page = 'adduser';
    require_once '../BookingApp/view/header.php';
    ?>

</head>
<body>
<div class="container">


    <?php require_once '../BookingApp/view/navbar.php' ?>

    <div class="col-xs-1 col-md-2 col-lg-3"></div>
    <div class="col-xs-10 col-md-8 col-lg-6">

        <form action="/admin/adduser" method="post">  
            
          <div class="form-group">
            <label for="uname">Username</label>
            <input type="text" class="form-control" id="uname" placeholder="UserName">
          </div>
            
          <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" placeholder="FirstName">
          </div>
            
          <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" placeholder="LastName">
          </div>
            
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>
            
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Email">
          </div>
            
          <button type="submit" class="btn btn-default" name="addUser">Submit</button>
        </form>

    </div>

</div>


</body>
</html>   