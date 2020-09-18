<?php 

if ($argc != 2 || in_array($argv[1], array('--help', '-help', '-h', '-?'))) {
?>

This is a command line PHP script with one option.

  Usage:
  <?php echo $argv[0]; ?> <option>

  <option> can be some word you would like
  to print out. With the --help, -help, -h,
  or -? options, you can get this help.

<?php
} else {
    echo $argv[1];
}
echo "Hello world";
$row = 1;
if (($handle = fopen("users.csv", "r")) !== FALSE) {
	//echo $handle;
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    var_dump($data);
  }
  fclose($handle);
}
$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = '';
$dbname = 'Staging';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(! $conn ) {
   die('Could not connect: ' . mysqli_error());
}
else{
	die("successful");
}
?>