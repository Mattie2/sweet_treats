<?php

/*
█████████████████████████████████████████████████████

				DATABASE CONNECTION

		@ The purpose of this file is to
		@ keep the databse connection
		@ credentials and string in a single
		@ file so if the database ever needed
		@ to be edited, the connection info
		@ only has to be changed here.

█████████████████████████████████████████████████████
*/


// Credentials to the database 
// Loaded into variables for 
// convenience 
$database_hostname = "localhost"; // The hostname / IP of the server
$database_username = "root"; // The username for the database
$database_password = ""; // The password for the databse (Leave blank if no password)
$database_name = "tutto"; // The name of the database that we are connecting to


/*
	
	@ Now we have the credentials for the database
	@ set to variables for convenience, we can now 
	@ use them to create a MySQLi connection string. 
	@ Do do this, we use the mysqli_connect() function
	@ and pass through the credentials, the layout
	@ goes like this: 

	mysqli_connect( 
		1. database server hostname / IP address
		2. database username
		3. database user's password
		4. name of the database we want to use
	);

	@ We do this below using the preset credential
	@ variables we created

*/
	
$dbconnect = mysqli_connect( $database_hostname, $database_username, $database_password, $database_name );


// The database connection string will return a boolean 
// confirming if it was able to connect or not

// If the $dbconnect is false
if ( !$dbconnect ) {

	// Kill the script from executing and give the 
	// user a user friendly error message
	die( "Unable to connect to the database, please try again later." );

	/*
		@ If we were having issues connecting to the
		@ databse and could not figure out
		@ what the issue is, we can output the error
		@ message response from the server like this -- 

		die( $dbconnect->error() );
		
		@ This would kill the script and output a connection
		@ error string. However it is unsafe to use 
		@ this type of  output all the time
		@ as someone could use the technical debug
		@ output for malicious purposes. 
	*/

}; // End if



/* █====================================█

		@ If we got this far into
		@ the script and recieved
		@ no errors, this means
		@ that everything worked
		@ correctly and is ready 
		@ to use in another script

   █====================================█
*/