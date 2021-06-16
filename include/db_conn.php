<?php
$host     = "localhost"; // Host name: localhost / pcse2pp1de0738
//$host     = "127.0.0.1"; // Host name: localhost / pcse2pp1de0738
$username = "root"; // Mysql username 
$password = "adminGym666"; // Mysql password 
$db_name  = "dbgym"; // Database name

/* 
// Create connection
$con = new mysqli($host, $username, $password);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
	//echo("Connection failed: " . $con->connect_error);
} 
echo "<pre>";
echo "Connected successfully"; 
echo "</pre>";
*/

// Connect to server and select databse.
$con = mysqli_connect($host, $username, $password, $db_name);

//echo "Connect to MySQL: " . mysqli_connect_error();

// Check connection
//if (mysqli_connect_errno($con)) {
if (!$con) {
	echo "<pre>";
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
	echo "</pre>";
}
//echo "<pre>";
//echo "Connected successfully"; 
//echo "</pre>";
?>
<?php
function page_protect()
{
	
    session_start();
    
    global $db;
    
    /* Secure against Session Hijacking by checking user agent */
    if (isset($_SESSION['HTTP_USER_AGENT'])) {
        if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
            session_destroy();
            //echo "<meta http-equiv='refresh' content='0; url=../login/'>";
			header("Location: ../../login/index.php", true, 303);	
            exit();
        }
    }
    
    // before we allow sessions, we need to check authentication key - ckey and ctime stored in database
    
    /* If session not set, check for cookies set by Remember me */
    if (!isset($_SESSION['user_data']) && !isset($_SESSION['logged']) && !isset($_SESSION['auth_level'])) {
        session_destroy();
        //echo "<meta http-equiv='refresh' content='0; url=../login/'>";
		header("Location: ../../login/index.php", true, 303);
        exit();
    } else {
        
    }
	
    $a = $_SESSION['auth_level'];
    if (strpos($a, '5') !== false) {
    } else {
        header("Location: ../../login/");
    }
}
?>