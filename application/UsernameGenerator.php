<?php
	class UsernameGenerator {
		public function createNew($name, $dateofbirth) {
			// Format this person's name
			list($firstname, $lastname) = $this->formatName($name);
			
			// Format this person's date of birth
			$yearofbirth = $this->formatDateOfBirth($dateofbirth);
			
			// Generate a username (not unique)
			$username = $username_original = $this->generateUsername($firstname, $lastname, $yearofbirth);
			
			// Append a number on to the username to make it unique, if not already
			$number = 2;
			while(($unique = $this->isUnique($username_original, $number - 2)) !== true) {
				$username = $username_original . "." . $number;
				if(is_int($unique))
					$number += $unique;
				else $number++;
			}
			
			return $username;
		}
		
		public function formatName($name) {
			// Return an array containing the first and last name
			if(!is_string($name) || !preg_match("/^([a-zA-Z- ]+) ([a-zA-Z- ]+)$/i", $name, $match))
				throw new Exception("Could not find name from {$name}.");
			
			$first = $match[1];
			$last = $match[2];
			
			if(strpos($first, " ") !== false) {
				// First name contains multiple words, prefer using these characters
				$first_split = explode(" ", $first);
				$first = "";
				foreach($first_split as $name)
					$first .= strtoupper(substr(trim($name), 0, 1));
			} else {
				// First name contains only one word, use the first two characters of this
				$first = substr(trim($name), 0, 2);
			}
			
			return Array($first, $last);
		}
		
		public function formatDateOfBirth($dateofbirth) {
			if(is_string($dateofbirth) && !is_numeric($dateofbirth)) {
				// Date string provided
				// Convert this to a timestamp
				$dateofbirth = strtotime($dateofbirth);
			}
			
			if(!is_numeric($dateofbirth))
				// Date of birth is still not numeric
				// The value provided is not valid
				throw new Exception("Invalid date of birth {$dateofbirth}.");
			
			// Get the year from the timestamp
			return (int)date("Y", $dateofbirth);
		}
		
		public function generateUsername($firstname, $lastname, $yearofbirth) {
			// Literally just concatenate these strings
			return $firstname . $lastname . $yearofbirth;
		}
		
		// function isUnique(): Subclasses should override this to check if a username already exists
		public function isUnique($username) {
			// Return true if the username *does not* exist,
			// False if it *does* exist
			// Otherwise this will loop forever
			return true;
		}
	}
	