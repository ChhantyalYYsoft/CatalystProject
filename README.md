# CatalystProject
1. Script Task
Script Command Line Directives

	* --file [csv file name] – this is the name of the CSV to be parsed 
	* --create_table – this will cause the MySQL users table to be built (and no further action will be taken)
	* --dry_run – this will be used with the --file directive in case we want to run the
	script but not insert into the DB. All other functions will be executed, but the
	database won't be altered
	* -u – MySQL username
	* -p – MySQL password
	* -h – MySQL host
	* --help – which will output the above list of directives with details

Example:
	=> PHP user_upload.php --file users.csv --create_table -u root -p root -h 127.0.0.1
	=> PHP user_upload.php --file users.csv --dry_run -u root -p root -h 127.0.0.1
	=> PHP user_upload.php --help

2. Logic Test 
	* Output the numbers from 1 to 100
	* Where the number is divisible by three (3) output the word “foo”
	* Where the number is divisible by five (5) output the word “bar”
	* Where the number is divisible by three (3) and (5) output the word “foobar”
	* Only be a single PHP file

Example:
	=> PHP foobar.php