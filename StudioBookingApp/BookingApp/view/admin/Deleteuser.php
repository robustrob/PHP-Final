<html>
<head>

    <?php
    $page = 'deleteuser';
    require_once '../BookingApp/view/header.php';
    ?>

</head>
<body>
<div class="container">


    <?php require_once '../BookingApp/view/navbar.php' ?>

    <div class="col-xs-1 col-md-2 col-lg-3"></div>
    <div class="col-xs-10 col-md-8 col-lg-6">

        <form action="/admin/deleteuser" method="post">  
            
          <div class="form-group">
            <label for="uname">Delete Username</label>            
          </div>
          <div class="form-group">
              <?php 
                function get_option($data){ 
    
                    $options='<option value= "">Select user</option>';
                    
                    for($i=0; $i<count($data['users']);$i++)
                    {
                        // $i is index or key and  $data['users'][$i] is for user name
                        $options.='<option value="'.$i.'">'.$data['users'][$i].'</option>';                       
                    }
                return $options;
                }
              ?>
              <select name="deletedUser" class="form-group">
                <?php 
                  echo get_option($data['users']);
                  ?>
              </select>
          </div>
            
            
          <button type="submit" class="btn btn-default" name="deleteuser">Delete</button>
        </form>

    </div>

</div>


</body>
</html>   