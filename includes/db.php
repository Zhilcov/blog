<?
$con = mysqli_connect(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['namebd'] 
);
if($con == false){
	echo "conection error";
	echo mysqli_connect_error();
	exit();
}
?>
<? 
		require 'C:\OSPanel\domains\test\Lib/rb-mysql.php';
R::setup( 'mysql:host=localhost;dbname=blog',
        'root', '' );
 

		 session_start();
?>
