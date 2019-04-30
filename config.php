<?Php
///////// Database Details change here  ////
$dbhost_dsn = getenv('MYSQL_DSN');
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
//echo "----{$dbhost_dsn} ----{$username} -- {$password} <br/>" ;

//////// Do not Edit below /////////

try {
	$dbo = new PDO($dbhost_dsn, $username, $password );
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage();
	die('omg!!!');
}
?>