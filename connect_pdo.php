<?php
try
{
	$connect_options_ar = array(
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=other', 'root', '', $connect_options_ar);
}
catch (Exception $e)
{
	if (ERR_REPORT_LVL)
	{
		echo $e->getMessage();
	}
}