<?php
//файл для подключения к БД
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'ecommerce1');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysqli_set_charset($dbc, 'utf8');

function escape_data ($data)
{ 
	global $dbc;
	if (get_magic_quotes_gpc())
	{
		$data = stripslashes($data);
	}
	return mysqli_real_escape_string ($dbc, trim($data));
} 

function get_password_hash($password)
{
	global $dbc;
	return mysqli_real_escape_string ($dbc, hash_hmac('sha256', $password, 'c#haRl891', true));
} // End of get_password_hash() function.
// будет продолжение кода
//...........
