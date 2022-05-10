<?php 


//If the session exists, no need to start it again. 
    @session_start();



    if(!isset($_SESSION['user_id'])){
        echo <<<END
        
            <a class="btn btn-outline-light ml-2" id="loginBtn" data-toggle="modal" data-target="#login-modal"><i class="fas fa-user"></i> Login</a>
                                
END;

    }else{
        $username = $_SESSION['u_username'];
        echo <<<END

           <a href="#" class="nav-link text-light">Welcome, $username!</a><a class="btn btn-light ml-2" id="profile" href="/logout.php"> <i class="fas fa-user-times"></i>  Logout</a>

END;

    };

//Admin button
 if(isset($_SESSION['u_level'])){
     if ($_SESSION['u_level']=='admin') {
         echo '<div class="nav-item ml-2"><a class="btn btn-warning" href="/admin.php">Admin</a></div>';
     };
};
?>
