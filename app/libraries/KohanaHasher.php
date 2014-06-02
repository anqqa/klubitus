<?php

use Illuminate\Hashing\HasherInterface;

class KohanaHasher implements HasherInterface {

	/**
	 * Check plain text password against hash.
	 *
	 * @param   string  $value
	 * @param   string  $hashedValue
	 * @param   array   $options
	 * @return  boolean
	 */
	public function check($value, $hashedValue, array $options = array()) {
		return $this->kohanaHashPassword($value, $this->kohanaSalt($hashedValue)) === $hashedValue;
	}


	/**
	 * Creates a hashed password from a plaintext password, inserting salt
	 * based on the configured salt pattern.
	 *
	 * @param   string          $password  plaintext
	 * @param   string|boolean  $salt
	 * @return  string
	 */
	private function kohanaHashPassword($password, $salt = false) {
		$saltPattern = Config::get('auth.salt_pattern', array(1, 2, 3));
		$hashMethod  = Config::get('auth.hash_method',  'sha1');

		// Create a salt seed, same length as the number of offsets in the pattern
		if ($salt === false) {
			$salt = substr(hash($hashMethod, uniqid(null, true)), 0, count($saltPattern));
		}

		// Password hash that the salt will be inserted into
		$hash = hash($hashMethod, $salt . $password);

		// Change salt to an array
		$salt = str_split($salt, 1);

		// Returned password
		$password = '';

		// Used to calculate the length of splits
		$last_offset = 0;

		foreach ($saltPattern as $offset) {

			// Split a new part of the hash off
			$part = substr($hash, 0, $offset - $last_offset);

			// Cut the current part out of the hash
			$hash = substr($hash, $offset - $last_offset);

			// Add the part to the password, appending the salt character
			$password .= $part . array_shift($salt);

			// Set the last offset to the current offset
			$last_offset = $offset;

		}

		// Return the password, with the remaining hash appended
		return $password . $hash;
	}


	/**
	 * Finds the salt from a password, based on the configured salt pattern.
	 *
	 * @param   string  $password  hashed
	 * @return  string
	 */
	private function kohanaSalt($password) {
		$saltPattern = Config::get('auth.salt_pattern', array(1, 2, 3));
		$salt        = '';

		// Find salt characters, take a good long look...
		foreach ($saltPattern as $i => $offset) {
			$salt .= substr($password, $offset + $i, 1);
		}

		return $salt;
	}


	/**
	 * Hash plain text password.
	 *
	 * @param   string $value
	 * @param   array $options
	 * @return  string
	 */
	public function make($value, array $options = array()) {
		return $this->kohanaHashPassword($value);
	}


	/**
	 * Check if the given hash has been hashed using the given options.
	 *
	 * @param   string  $hashedValue
	 * @param   array   $options
	 * @return  boolean
	 */
	public function needsRehash($hashedValue, array $options = array()) {
		return false;
	}

}
