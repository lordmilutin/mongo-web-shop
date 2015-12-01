<?php 
	require 'servis/AServis.php';
	require "servis/GetHrana.php";
	require "servis/GetHranaPoId.php";
	require "servis/GetKategorije.php";
	require "servis/DeleteItem.php";
	require "servis/AddItem.php";


	
	//usmerava zahtev ka navedenoj klasi (metodi servisa)
	if (isset($_REQUEST["metoda"])) 
	{
		$met = $_REQUEST["metoda"];
		if (class_exists($met))
		{
			$i = new $met();
			$i->akcija();
		}
		else
		{
			die($met."Metoda ne postoji!");
		}
	}
	else 
	{
		die("Metoda mora biti navedena!");
	}
?>