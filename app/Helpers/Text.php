<?php namespace klubitus\Helpers;

use Illuminate\Support\Str;


class Text {

	/**
	 * Transforms an database id to file path, 1234567 = 01/23/45
	 *
	 * @param   integer  $id
	 * @return  string
	 */
	public static function idToPath($id) {

		// Convert numeric id to hex and split to chunks of 2
		$path = str_split(sprintf('%08x', (int)$id), 2);

		// Scrap the last chunk, 256 files per dir
		array_pop($path);

		return implode('/', $path);
	}


	/**
	 * Generate a URL friendly "slug" from a given string.
	 *
	 * @param   string  $string
	 * @param   string  $separator
	 * @return  string
	 */
	public static function slug($string, $separator = '-') {
		return Str::slug(self::transliterateToAscii($string), $separator);
	}


	/**
	 * Replaces special/accented UTF-8 characters by ASCII-7 'equivalents'.
	 *
	 * @param   string  $string
	 * @return  string
	 */
	public static function transliterateToAscii($string) {
		static $UTF8_SPECIAL_CHARS = null;

		if ($UTF8_SPECIAL_CHARS === null) {
			$UTF8_SPECIAL_CHARS = array(
				'⁰' => '0', '₀' => '0', '¹' => '1', 'ˡ' => 'l', '₁' => '1', '²' => '2', '₂' => '2',
				'³' => '3', '₃' => '3', '⁴' => '4', '₄' => '4', '⁵' => '5', '₅' => '5', '⁶' => '6',
				'₆' => '6', '⁷' => '7', '₇' => '7', '⁸' => '8', '₈' => '8', '⁹' => '9', '₉' => '9',
				'¼' => '1/4', '½' => '1/2', '¾' => '3/4', '⅓' => '1/3', '⅔' => '2/3', '⅕' => '1/5',
				'⅖' => '2/5', '⅗' => '3/5', '⅘' => '4/5', '⅙' => '1/6', '⅚' => '5/6', '⅛' => '1/8',
				'⅜' => '3/8', '⅝' => '5/8', '⅞' => '7/8', '⅟' => '1/', '⁺' => '+', '₊' => '+',
				'⁻' => '-', '₋' => '-', '⁼' => '=', '₌' => '=', '⁽' => '(', '₍' => '(', '⁾' => ')', '₎' => ')',
				'ª' => 'a', '@' => 'a', '€' => 'e', 'ⁿ' => 'n', '°' => 'o', 'º' => 'o', '¤' => 'o', 'ˣ' => 'x',
				'ʸ' => 'y', '$' => 'S', '©' => '(c)', '℠' => 'SM', '℡' => 'TEL', '™' => 'TM',
				'ä' => 'a', 'Ä' => 'A', 'ö' => 'o', 'Ö' => 'O', 'ü' => 'u', 'Ü' => 'U', 'å' => 'a', 'Å' => 'A',
			);
		}

		$string = str_replace(
			array_keys($UTF8_SPECIAL_CHARS),
			array_values($UTF8_SPECIAL_CHARS),
			$string
		);

		return Str::ascii($string);
	}


}
