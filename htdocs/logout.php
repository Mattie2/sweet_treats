<?php

/*

	@ The purpose of this script is to 
	@ securly clear any session data
	@ that is currently set to the 
	@ browser, this includes usernames
	@ basket/cart data or any other
	@ sensitive data stored. 

*/

// If the session hasn't already started, start the session
@session_start();

// Unset any and all session data that is currently set. 
session_unset();

// Destroy the session and delete any remaining session data
// This means that it will clear the session data
// and delete the session cookie 
session_destroy();

// Redirect the user back to the home page without any session data
header("location: /");

// Exit the script and stop executing code. 
exit();
