<?php
if (!defined('LIVE'))
{
	DEFINE ('LIVE', false);
}
DEFINE ('CONTACT_EMAIL', 'you@example.com');

// если надо отладить одну страницу сайта, не затрагивая весь сайт, то использовать код ниже - 2 строки
//DEFINE ('LIVE', true);
//require ('./includes/config.inc.php');

define ('BASE_URI', 'D:/wamp64/www/Ecommerce_Knowledge_is_Power/');
define ('BASE_URL', 'localhost/');
define ('MYSQL', BASE_URI . 'mysql.inc.php');

session_start();

//создаем ф-цию обработки ошибок
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
{
	//детализированное сообщение об ошибке
	$message = "Ошибка произошла в сценирии '$e_file', в строке $e_line:\n$e_message\n";
	//добавляем данные обратной трассировки - ??? - пока не понимаю, что это	
	$message .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n" ;
	//если не нужна детализация, то можно так
	//$message .= "<pre>" .print_r($e_vars, 1) . "</pre>\n" ;
	
	//если сайт не работает, то будет выведено сообщение об ошибке
	if (!LIVE)
	{
		echo '<div class="alert alert-danger">' . nl2br($message) . '</div>';
	}
	//если сайт работает, то отсылается сообщение email, влюч сообщение об ошибке
	else
	{
		error_log($message, 1, CONTACT_EMAIL, 'From: admin@example.com');
		
		if ($e_number != E_NOTICE)
		{
			echo '<div class="alert alert-danger">Произошла системная ошибка.
						Приносим извинения за доставленные неудобства</div>';
		}
	}
	return true;
}

set_error_handler('my_error_handler');
?>
