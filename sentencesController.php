<?php 

// The entry router

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'sentencesControllerModel.php';

try {
	$s_controller = new sentencesControllerModel();

	$s_controller->validateRequest();
	$s_controller->processRequest();
	
	echo '<h3 style="color:green;">Submitted</h3>';
} 
catch (Throwable $th) {
	echo '<h3 style="color:red;">'.'Error: '.$th->getMessage().'</h3>';
}
finally {
	include_once 'form.html';
}

?>
