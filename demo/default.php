<?php
	date_default_timezone_set("Europe/London");
	require_once __DIR__ . "/../application/UsernameGenerator.php";
	
	$messages = Array();
	
	try {
		if(isset($_SERVER["REQUEST_METHOD"]) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
			if(!isset($_POST["name"]) || !is_string($name = $_POST["name"]))
				throw new Exception("Name isn't set.");
			elseif(!isset($_POST["dateofbirth"]) || !is_string($dateofbirth = $_POST["dateofbirth"]))
				throw new Exception("Date of birth isn't set.");
			
			$usernamegenerator = new UsernameGenerator();
			$username = $usernamegenerator->createNew($name, $dateofbirth);
			
			$messages[] = Array(
				"type" => "success",
				"message" => "Username <strong>" . htmlentities($username) . "</strong> generated."
			);
		} elseif(isset($_SERVER["REQUEST_METHOD"]) && ($_SERVER["REQUEST_METHOD"] == "GET")) {
			
		} elseif(isset($_SERVER["REQUEST_METHOD"])) {
			throw new Exception("HTTP method " . htmlentities($_SERVER["REQUEST_METHOD"]) . " not supported.");
		} else {
			throw new Exception("HTTP method not found.");
		}
	} catch(Exception $exception) {
		$messages[] = Array(
			"type" => "danger",
			"message" => $exception->getMessage()
		);
	}
	
	require_once __DIR__ . "/template.php";
	