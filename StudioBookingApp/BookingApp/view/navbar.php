<ul class="nav nav-pills">


    <li role="presentation" <?php echo($page == 'home' ? 'class="active"' : '') ?> ><a href="/home">Home</a></li>
    <li role="presentation" <?php echo($page == 'booking' ? 'class="active"' : '') ?> ><a href="/booking">Booking</a></li>



    <?php

    if ($page == 'register') {
        echo '<li role="presentation" class="active" ><a href="/register">Register</a></li>';
    }

    if ($page == 'forgot') {
        echo '<li role="presentation" class="active" ><a href="/forgot">Forgot Password</a></li>';
    }

    if(isset(Session::get('my_user')['first_name']) && isset(Session::get('my_user')['last_name']))
    {
        if(strcmp(Session::get('my_user')['first_name'],"admin") == 0)
        {
            if($page == 'admin')
                echo '<li role="presentation" class="active" ><a href="/admin">Admin</a></li>';
            else
                echo '<li role="presentation"><a href="/admin">Admin</a></li>';
        }
        else
        {
            echo '<li role="presentation"><a href="/account">'.Session::get('my_user')['first_name'].'</a></li>';
        }

        echo'<li role="presentation"  ><a href="/login/logout">Log Out</a></li>';
    }
    else
    {
        if($page == 'login')
            echo'<li role="presentation" class="active" ><a href="/login">Login</a></li>';
        else
            echo'<li role="presentation" ><a href="/login">Login</a></li>';
    }
    ?>



</ul>
