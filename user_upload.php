<?php 
class Catalyst{
  
  function readCSVFile($fileName)
  {
    if (($handle = fopen($fileName, "r")) !== FALSE) {
    //echo $handle;
      $csvData = [];
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      array_push($csvData, $data);
    }
    fclose($handle);
    //var_dump($csvData);
    return $csvData;
    }
  }
  function dbSetup($dbuser, $dbpass, $dbhost)
  {
    // $host = '127.0.0.1';
    // $user = 'root';
    // $pass = '';
    // $dbname = 'Staging';
    $host = $dbhost;
    $user = $dbuser;
    $pass = $dbpass;
    $dbname = 'Staging';
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if(! $conn ) {
       echo('Could not connect: ' . mysqli_error());
    }
    else{
      echo("Database is successfully connected.\n");
    }
    return $conn;
  }
  function dbTableCreate($conn)
  {
    //echo $connection;
    $sql = "CREATE TABLE USERS (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    surname VARCHAR(30) NOT NULL,
    email VARCHAR(50)
    )";
    if(! $conn ) {
       echo('Could not connect: ');
    }
    else{
        if ($conn->query($sql) === TRUE) {
        echo "Table is created successfully\n";
        } else {
          echo "Error creating table: " . $conn->error."\n";
        }
    }
  }
  
  function insert($data, $conn)
  {
    //var_dump($data);
    foreach ($data as $key => $value) {
      # code...

      if($key>0)
      {
        $firstName = ucwords($value[0]);
        $surName = ucwords($value[1]);
        $email = $value[2];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $checkSql='select * from users where (email="'.$email.'");';
          $result = $conn->query($checkSql);
            
            if (mysqli_num_rows($result)>0) {
              echo "Error !!! Email $email is already exist.\n";
            }
            else
            {
              $sql = ' INSERT INTO users (name, surname, email)
              VALUES ("'.$firstName.'", "'.$surName.'", "'.$email.'")';
              if(! $conn ) {
                     echo('Could not connect: ');
                }
                else{
                    if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully\n";
                    } else {
                      echo "Error: ". $conn->error."\n";
                    }
                }
            }
          
        } else {
          echo("Error !!! Email $email is invalid\n");
        }
        
      }
    }
    
       $conn->close();
  }
}

$obj = new Catalyst();
//$obj->dbSetup();
if(isset($argv))
{
  $mainCmd= $argv[1];
  //echo $mainCmd;
  if($mainCmd== "--file")
  {
    $fileName = $argv[2];
    $action = $argv[3];
    $mysqlUsername = null;
    $mysqlPassword = " ";
    $mysqlHost = null;

    if(isset($argv[4]) && $argv[4]== '-u')
    {
        $mysqlUsername= $argv[5];
    }
    if(isset($argv[6]) && $argv[6]== '-p')
    {
                                           
        $mysqlPassword= $argv[7];
    }
    if(isset($argv[8]) && $argv[8]== '-h')
    {
        $mysqlHost= $argv[9];
    }
    //echo $mysqlUsername;
    //echo $mysqlPassword;
    
      if($action=="--dry_run")
      {
        //echo"Dry Run";
        $data = $obj->readCSVFile($fileName);
        if(!empty($data))
        {
          echo "CSV file is successfully extracted.\n";
        }
        $connection = $obj->dbSetup($mysqlUsername, $mysqlPassword, $mysqlHost);
      }
      else if($action=="--create_table")
      {
        $data = $obj->readCSVFile($fileName);
        $connection = $obj->dbSetup($mysqlUsername, $mysqlPassword, $mysqlHost);
        $obj->dbTableCreate($connection);
        $obj->insert($data, $connection);
      }
      else{
        echo "Error !!! Invalid Command.\n";
      }
  }

  if($mainCmd=="--help")
  {
      $help = "• --file [csv file name] – this is the name of the CSV to be parsed \n• --create_table – this will cause the MySQL users table to be built (and no further action will be taken)\n• --dry_run – this will be used with the --file directive in case we want to run the script but not insert into the DB. All other functions will be executed, but the database won't be altered\n• -u – MySQL username\n• -p – MySQL password\n• -h – MySQL host\n• --help – which will output the above list of directives with details.";
      echo $help;
  }
  }
?>
