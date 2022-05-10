<?php 
    //this handles user login and registration
    include($_SERVER['DOCUMENT_ROOT'].'/inc/dbconnect.inc.php');
    session_start();

    //////////////////////////
    //   REGISTER SCRIPT    //
    //////////////////////////

    //allows the user to submit their info

    //check if register mode was requested
    if($_POST["mode"] == "register"){
        //verifies the data is valid
        if ($_POST["r_uname"] == ""){
            //show an error message
            $_SESSION['message'] = "Please enter a valid name";
            $valid = false;
        }else if ($_POST["r_pword1"]==""){
            $_SESSION['message'] = "Please enter a valid password";
            $valid = false;
        }else if($_POST["r_pword1"]!=$_POST["r_pword2"]){
            $_SESSION['message'] = "Passwords dont match";
            $valid = false;
        }else{
            $valid = true;
            //storing username entered by user
            $username = $_POST["r_uname"];
        };

        if(!$valid){
            //create location header to move the user back to the home page with a registration error
            header("location: /?registerSuccess");
            exit();
        }

        $query = "SELECT *
        FROM `user`
        WHERE `u_username` = '{$username}'";

        //query db for matching username
        $userCheck = mysqli_query($dbconnect,$query);

        if(mysqli_num_rows($userCheck)>0){
            //Show an error message
            $_SESSION['message'] = "This username has already been taken. Please choose another username";
            //create location header to move the user back to the home page with a registration error
            header("location: /?registerSuccess");
            exit();
        }else{
            //everything is valid. Adding user

            //retrieving the password and immediately encrypting using md5 hash function
            $password = md5($_POST['r_pword1']);
            
            //add to database
            $sql = "INSERT INTO `user` (`u_username`,`u_password`,`u_level`) VALUES ('{$username}','{$password}','user')";
            $register = mysqli_query($dbconnect,$sql);

            //check if it added correctly
            if($register){
                //if true, added successfully
                $_SESSION['message'] = "Thank you for registering with Sweet Treats! We hope you enjoy :)";
            }else{
                $_SESSION['message'] = "Registration error!";
            };

            //redirect user to the homepage
            header("location: /?registerSuccess");
            exit();
        }
    }

    //////////////////////////
    //   LOGIN SCRIPT    //
    //////////////////////////

    if($_POST['mode'] == "login"){
        //set valid to true incase it was set to false elsewhere in the script
        $valid = true;

        if (strlen($_POST['l_uname']) === 0 ){
            $_SESSION['message'] = "Username field is empty";
            // echo "Username field is empty";
            $valid = false;
        }else if(strlen($_POST['l_pword']) === 0 ){
            $_SESSION['message'] = "Password field is empty";
            // echo "Password field is empty";
            $valid = false;
        };
        /*
            array holding two values used as response to ajax script
            1st value - boolean to tell ajax if the login was successful
            2nd value - message string to the user trying to login, used to alert them of any issues with their credentials
        */
        $response = array(
            'success' => false,
            'message' => ""
        );

        if(!$valid){
            $response['message'] = "There was an issue with your username and password";
            //echoing json object from the reponse array, so data from the ajax script can be parsed easily
            echo json_encode($response);
            exit();
        }else{
            //takes the submitted credentials from the user and checks if the database holdes the user's info.

            $username = $_POST['l_uname'];
            $password = md5($_POST['l_pword']);

            $sql = "SELECT * FROM
            `user`
            WHERE
            `u_username` = '{$username}'
            AND
            `u_password` = '{$password}'";

            $login = mysqli_query($dbconnect,$sql);

            //check if the users credentials were found in the database 
            if (mysqli_num_rows($login) > 0){
                while ($row = mysqli_fetch_array($login)){
                    /*
                        now we have the users info in an array, we can set the session and use
                        the data throughout the website to confirm the user is logged in
                    */
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['u_username'] = $row['u_username'];
                    $_SESSION['u_level'] = $row['u_level'];
                };
                /*
                    After confirming the user is valid, now set the success flag to true
                */
                $response['success'] = true;
                $response['message'] = "Welcome to Sweet Treats ".$_SESSION['u_username']."!";

                echo json_encode($response);
                exit();
            }else{
                $response['message'] = "There was an issue with your username and password";
                echo json_encode($response);
                exit();                
            }
        }
    }
?>