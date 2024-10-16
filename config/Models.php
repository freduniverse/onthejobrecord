<?php
include "CRUD.php";
include "functions.php";

function account() {
	$crud = new CRUD;
	$crud->table = "account";
	return $crud;
}


function dtr() {
	$crud = new CRUD;
	$crud->table = "dtr";
	return $crud;
}

?>
