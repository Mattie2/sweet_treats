<?php 

session_start();
// include database connection
include('../inc/dbconnect.inc.php');	


    /*
█████████████████████████████████████████████████████

                Insert Script 
                
█████████████████████████████████████████████████████
*/
  define("MAX_SIZE",20971520); // Define a constant for the max file size for the images. 

if ($_POST['action'] == "insert"){
    

// ╔═█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████═╗
// ║╔═════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╗║
// ║║                                                                       ║║
    /*

        @ The purpose of this code block 
        @ is to take the information from the
        @ product creation form, check the 
        @ data is valid, the images are 
        @ the correct format, the images are
        @ not too large and put the new
        @ product into the products table
    
    */
    
    /*
        - The define comamnd creates constant variables.
        - A constant variable is a variable that cannot
        - changed once set. 
    */
  

    $errors = false; // Create an error flag to track if any errors occur


    // █====================================█

    /*
         - This section will collect the 
         - data from the add product form.
    
        @ Like the $_POST method of getting
        @ form data, when a multimedia form
        @ is submitted, the files from the
        @ form are stored inside the $_FILES
        @ array.

        @ When the image is set to a variable,
        it is the resource data type.
    */
    
    // Get the main image submitted in the form and set it to the main variable.
    $main = $_FILES['p_image']['name'];
    // Get the thumbnail image from the submitted form and set it to the thunb variable.
    $thumb = $_FILES['p_detail-thumb']['name'];
    
    // After loading the image into a main string, 
    // we will also load each image into temp
    // variables. 
    $upMain =  $_FILES['p_image']['tmp_name'];
    $upThumb = $_FILES['p_detail-thumb'] ['tmp_name'];
    
    // Here will take them main image filename and
    // strip and back slashes from the name using
    // the 'stripslashes()' function and load
    // the result into 'mainFile' variable. 
    $mainFile = stripslashes($main);

    // We then convert the string to lowercase
    // and get the extension of the file using
    // the 'getExtension()' function and using the
    // mainFile variable and load the result to
    // 'mainExt' variable.
    $mainExt = strtolower(getExtension($mainFile));
    
    // Here will take them thumbnail image filename and
    // strip and back slashes from the name using
    // the 'stripslashes()' function and load
    // the result into 'thumbFile' variable.
    $thumbFile = stripslashes($thumb);

    // We then convert the string to lowercase
    // and get the extension of the file using
    // the 'getExtension()' function and using the
    // mainFile variable and load the result to
    // 'thumbExt' variable.
    $thumbExt = strtolower(getExtension($thumbFile));
    

    // █====================================█

    /*
        @ This section of the code checks if the
        @ file extension is valid
        
        * The valid extension function expects 
        * the file extension as a string and will
        * return a boolean if valid or not.

        @ Here we are checking if the main image 
        @ file extensions are _NOT_ valid so we
        @ can handle an error.
    */
    if(!validExtension($mainExt) || !validExtension($thumbExt)) {

        // █====================================█

        // Give an user friendly error message
        $_SESSION['message'] = "Unkown Image Extention";

        // Set the errors flag to true to indicate
        // we have encountered errors. 
        $errors= true;

        // █====================================█


    } else { // ELSE (The file extensions were valid and ok)


        /*
        * The filesize function expects a string variable 
        * of the files name that you want the size for. 
        */

        // Get the size of the main image file and load
        // it into the vaiable mainSize.
        $mainSize = filesize($upMain);

        // Get the size for the thumbnail image and load
        // it into the variable thumbSize.
        $thumbSize = filesize($upThumb);
               

        /*
            @ Now we have the sizes for the images, we can
            @ check if they are smaller than the MAX_SIZE
            @ constant variable that we set at the top of
            @ the script.
        */

        // If the size of the main image is BIGGER than the
        // MAX_SIZE constant AND the thumbnail size is BIGGER
        // than the MAX_SIZE constant.
        if($mainSize > MAX_SIZE || $thumbSize > MAX_SIZE){

            // █====================================█

            // Set a user friendly error message to the message PHP session
            $_SESSION['message'] = "You are too big!";

            // Set the errors flag to true to indiate we have encountered
            // an error
            $errors= true;

            // █====================================█

        } else { // ELSE (The file sizes are smaller than the MAX_SIZE constant)



            /*
                @ Now we have checked that the files are valid filetypes
                @ by checking the file extension against our pre-defined
                @ valid types and we have checked that the file sizes
                @ are not too big to be stored on the server, we now create
            */
            switch($mainExt) {
                case "jpg" : $mainScr = imagecreatefromjpeg($upMain); break;
                case "jpeg" : $mainScr = imagecreatefromjpeg($upMain); break;
                case "png" : $mainScr = imagecreatefrompng($upMain); break;
                case "gif" : $mainScr = imagecreatefromgif($upMain); break;
                
            }
            switch($thumbExt) {
                case "jpg" : $thumbScr = imagecreatefromjpeg($upThumb); break;
                case "jpeg" : $thumbScr = imagecreatefromjpeg($upThumb); break;
                case "png" : $thumbScr = imagecreatefrompng($upThumb); break;
                case "gif" : $thumbScr = imagecreatefromgif($upThumb); break;
                
            }


            // █====================================█


            //Get uploaded Width and Height 
            list($mainWidth,$mainHeight) = getimagesize($upMain);
            list($thumbWidth,$thumbHeight) = getimagesize($upThumb);
            
            //main New Width 
            $mainNewWidth = 215;
            $mainNewHeight = 215;
            $tmpMain = imagecreatetruecolor($mainNewWidth, $mainNewHeight); 
            $color = imagecolorallocatealpha($tmpMain, 255, 255, 255, 127); 
            //fill transparent back
            imagefill($tmpMain, 0, 0, $color);
            imagesavealpha($tmpMain, true);
            
             //Thumb New Width 
            $thumbNewWidth = 100;
            $thumbNewHeight = ($thumbHeight/$thumbWidth)*$thumbNewWidth;
            $tmpThumb = imagecreatetruecolor($thumbWidth, $thumbHeight);


            // █====================================█
        
            /*
                @
                @
                @
            */
            //resave images 
            imagecopyresampled($tmpMain, $mainScr, 0, 0, 0, 0, $mainNewWidth, $mainNewHeight, $mainWidth, $mainHeight);
            
             //resave images 
            imagecopyresampled($tmpThumb, $thumbScr, 0, 0, 0, 0, $thumbNewWidth, $thumbNewHeight, $thumbWidth, $thumbHeight);
            

            // █====================================█


            //create and Switch the images 
            switch ($mainExt) {
                    case "jpg":
                        imagejpeg($tmpMain, "../images/main/".$main, 100);
                        break;
                    case "jpeg":
                        imagejpeg($tmpMain, "../images/main/".$main, 100);
                        break;
                    case "png":
                        imagepng($tmpMain, "../images/main/".$main, 0);
                        break;
                    case "gif":
                        imagegif($tmpMain, "../images/main/".$main );
                        break;

            }
                //create and Switch the images 
            switch ($thumbExt) {
                    case "jpg":
                        imagejpeg($tmpThumb, "../images/thumb/".$thumb, 100);
                        break;
                    case "jpeg":
                        imagejpeg($tmpThumb, "../images/thumb/".$thumb, 100);
                        break;
                    case "png":
                        imagepng($tmpThumb, "../images/thumb/".$thumb, 0);
                        break;
                    case "gif":
                        imagegif($tmpThumb, "../images/thumb/".$thumb);
                        break;
            } 


            // █====================================█
            

            //Free up memory 
            imagedestroy($tmpMain);
            imagedestroy($tmpThumb);

        }//End file size check

    } //End Extension Check
    

    // ███████████████████████████████████████████████████████████████████
    // █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █

    /*
            @ This part of the document handles
            @ any errors that were encounted
            @ throughout the script and if
            @ no errors occured, then executes
            @ the SQL to insert the product.
    */


    // IF $errors is not true -- (If $errors is false)
    if(!$errors){
        
        //sanitise before entry
        $p_name = mysqli_escape_string($dbconnect,$_POST['p_name']);
        
        $p_category = mysqli_escape_string($dbconnect,$_POST['p_category']);
        
        $p_price = mysqli_escape_string($dbconnect,$_POST['p_price']);
        
        $p_detail_thumb = mysqli_escape_string($dbconnect, $_POST['p_detail_teaser']);
        
        $p_image = mysqli_escape_string($dbconnect, "/images/main/".$main);
        
        $p_detail = nl2br(mysqli_escape_string($dbconnect,$_POST['p_detail']));
        
        $main = "/images/main" . $main;
        $thumb = "/images/thumb" . $thumb;
       
        $insertSql = "INSERT INTO `product` (`p_name`,`p_category`,`p_price`,`p_detail-thumb`,`p_image`,`p_detail`)
        VALUES
        ('{$p_name}','{$p_category}','{$p_price}','{$p_detail_thumb}','{$p_image}','{$p_detail}')";
     
        
        $insertResult = mysqli_query($dbconnect, $insertSql);
        

        if ($insertResult){

            //Get the ID of the product inserted
            $id = mysqli_insert_id($dbconnect);

            // Redirect the user to another page
            header("location: /detail.php?id=".$id);

            //Stop executing script
            exit();

        } else {

            // Create a user-friendly message for the user
            $_SESSION['message'] = "Insertion Failed!";
        
            // Redirect the user to another page
            header("location: /admin.php");
        
            //Stop executing script
            exit();

        }; // End if insert result
 
    }else{

        // Create a user-friendly message for the user
        $_SESSION['message'] = "Insertion Failed!";
        
        // Redirect the user to another page
        header("location: /admin.php");
    
        //Stop executing script
        exit();

    }; // End else (if !error)

    // █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █  █
    // ███████████████████████████████████████████████████████████████████
    

// ║║                                                                       ║║
// ║╚█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╗█████╝║
// ╚══════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚════╝╚═════╝


/*
█████████████████████████████████████████████████████

		Delete Function
        
█████████████████████████████████████████████████████
*/
    
    
    
} else if ($_GET['action']=="delete") { // End Insert


    $deleteQuery="DELETE FROM `product` WHERE `product_id`={$_GET['id']}";
    $deleteResult=mysqli_query($dbconnect,$deleteQuery);
    
    if($deleteResult){
        $_SESSION['message']="Great Success! Deleted.";
        
        } else {
                $_SESSION['message']="Delete Failed.";
        }
  
    header("location: /admin.php");
    exit();
    

/*
█████████████████████████████████████████████████████

        Update Function
        
█████████████████████████████████████████████████████
*/

    } else if ($_POST['action']=="update") { 
    
    $errors=false;
    
    //filenames
    $main = $_FILES['p_image']['name'];;
    $thumb = $_FILES['p_detail-thumb']['name'] ;
    
    // temp file 
    if ($main){
        $upMain =  $_FILES['p_image']['tmp_name']; 
    }    
    if ($thumb) {
    $upThumb = $_FILES['p_detail-thumb'] ['tmp_name'];
    }
    
    //image Extensions check
     if ($main){
            $mainFile = stripslashes ($main);
            $mainExt = strtolower(getExtension($mainFile));
     }
     if ($thumb){
            $thumbFile = stripslashes($thumb);
            $thumbExt = strtolower(getExtension($thumbFile));
        }
    
    if($main && (!validExtension($mainExt)) ||
       ($thumb && !validExtension($thumbExt))) {
        $_SESSION['message'] = "Unkown Image Extention";
            $errors= true;
        echo'Error with file extension';
    } else {
    //Filesizes
        if ($main){
                $mainSize = filesize($upMain);
        }
         if ($thumb){
                $thumbSize = filesize($upThumb);
         }
           
    if(($main && $mainSize>MAX_SIZE) || ($thumb && $thumbSize>MAX_SIZE)){
           
        $_SESSION['message'] = "You are too big!";
        $errors= true;  
        echo 'Exceded max file size';
    } else {
        if ($main){
                //Filetype Check for Memory Images 
                Switch($mainExt) {
                    case "jpg" : $mainScr = imagecreatefromjpeg($upMain); break;
                    case "jpeg" : $mainScr = imagecreatefromjpeg($upMain); break;
                    case "png" : $mainScr = imagecreatefrompng($upMain); break;
                    case "gif" : $mainScr = imagecreatefromgif($upMain); break;
                        }
            }
           
           if($thumb){
                Switch($thumbExt) {
                    case "jpg" : $thumbScr = imagecreatefromjpeg($upThumb); break;
                    case "jpeg" : $thumbScr = imagecreatefromjpeg($upThumb); break;
                    case "png" : $thumbScr = imagecreatefrompng($upThumb); break;
                    case "gif" : $thumbScr = imagecreatefromgif($upThumb); break;
                }
            }
           
        //Get uploaded Width and Height 
        if ($main){
           list($mainWidth,$mainHeight) = getimagesize($upMain);
        }
        if ($thumb){
        list($thumbWidth,$thumbHeight) = getimagesize($upThumb);
        }
           
        //main New Width 
        if ($main) {
                $mainNewWidth = 215;
                $mainNewHeight = 215;
                $tmpMain = imagecreatetruecolor($mainNewWidth, $mainNewHeight);
                $color = imagecolorallocatealpha($tmpMain, 255, 255, 255, 127); //fill transparent back
                imagefill($tmpMain, 0, 0, $color);
                imagesavealpha($tmpMain, true);
        }
           
           
        //Thumb New Width 
           if ($thumb) {
                $thumbNewWidth = 100;
                $thumbNewHeight = ($thumbHeight/$thumbWidth)*$thumbNewWidth;
                $tmpThumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
       }
       
        //resave images 
       if ($main){
                imagecopyresampled($tmpMain, $mainScr, 0, 0, 0, 0, $mainNewWidth, $mainNewHeight, $mainWidth, $mainHeight);
       }
         
       //resave images 
       if ($thumb){
                imagecopyresampled($tmpThumb, $thumbScr, 0, 0, 0, 0, $thumbNewWidth, $thumbNewHeight, $thumbWidth, $thumbHeight);
       }
        
        
        //create and Switch the images 
        if ($main){
                switch ($mainExt) {
                        case "jpg":
                            imagejpeg($tmpMain, "../images/main/".$main, 100);
                            break;
                        case "jpeg":
                            imagejpeg($tmpMain, "../images/main/".$main, 100);
                            break;
                        case "png":
                            imagepng($tmpMain, "../images/main/".$main, 0);
                            break;
                        case "gif":
                            imagegif($tmpMain, "../images/main/".$main );
                            break;
                }
        }
       
        //create and Switch the images 
        if ($main){
                switch ($thumbExt) {
                        case "jpg":
                            imagejpeg($tmpThumb, "../images/thumb/".$thumb, 100);
                            break;
                        case "jpeg":
                            imagejpeg($tmpThumb, "../images/thumb/".$thumb, 100);
                            break;
                        case "png":
                            imagepng($tmpThumb, "../images/thumb/".$thumb, 0);
                            break;
                        case "gif":
                            imagegif($tmpThumb, "../images/thumb/".$thumb);
                            break;
                } 
        }

//Free up memory 
       if($main){
                imagedestroy($tmpMain);
       }
       if ($thumb){
                imagedestroy($tmpThumb);
       }
    }//End File Check 
}
} //End Extension Check
   
    if(!$errors){
        
        //sanitise before entry
        $p_name = mysqli_escape_string($dbconnect,$_POST['p_name']);
        
        $p_category = mysqli_escape_string($dbconnect,$_POST['p_category']);
        
        $p_price = mysqli_escape_string($dbconnect,$_POST['p_price']);
        
        $p_detail_thumb = mysqli_escape_string($dbconnect, $_POST['p_detail_teaser']);
        
        $p_image = mysqli_escape_string($dbconnect, "/images/main/".$main);
        
         $p_detail = nl2br(mysqli_escape_string($dbconnect,$_POST['p_detail']));
        
        if ($main){
                $main = "/images/main/" . $main;
        }
        if ($thumb){
                $thumb = "/images/thumb/" . $thumb;
        }
        

           
//Update Query 
        $updateSql = "UPDATE `product` SET `p_name`='{$p_name}',`p_category`='{$p_category}',
        `p_price`='{$p_price}',`p_detail`='{$p_detail}',`p_detail-thumb`='{$p_detail_thumb}'";
        
        if ($main){
                $updateSql.=",`p_image`='{$main}'";
        }
    
        if ($thumb){
                 $updateSql.=",`p_detail-thumb`='{$thumb}'";
            
        }
    
        $updateSql.=" WHERE `product_id`={$_POST['id']}";
        $updateResult = mysqli_query($dbconnect, $updateSql);
        
    
        if ($updateResult){
            header("location: /detail.php?id=" . $_POST['id']);
            
        } else {
             header("location: /detail.php?id=" . $_POST['id']);
        }
 
}//End Update 





function validExtension($ext){
    if($ext =="jpg"  || $ext =="jpeg" || $ext =="gif") {
        return true;
    } else {
        return false;
    }
}

function getExtension($str){
    //Check for the dot in the string
    $i = strrpos($str,".");
    //if no dot is returned do nothing
if (!$i) { return ""; }
    //what the index based on length of string 
    $l = strlen($str) - $i;
    $ext = substr($str, $i+1, $l);
    return $ext;
}
