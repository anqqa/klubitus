<?php namespace klubitus;

class Image extends Entity {
	protected $table = 'images';

	// Resizing constraints
	const NONE    = 0x01;
	const WIDTH   = 0x02;
	const HEIGHT  = 0x03;
	const AUTO    = 0x04;
	const INVERSE = 0x05;

	// Flipping directions
	const HORIZONTAL = 0x11;
	const VERTICAL   = 0x12;

	// Sizes
	const SIZE_ICON      = 'icon';
	const SIZE_MAIN      = 'main';
	const SIZE_ORIGINAL  = 'original';
	const SIZE_SIDE      = 'side';
	const SIZE_THUMBNAIL = 'thumbnail';
	const SIZE_WIDE      = 'wide';


	/**
	 * Icon URL.
	 *
	 * @return  string
	 */
	public function getIconUrlAttribute() {
		return $this->url(self::SIZE_ICON);
	}


	/**
	 * Normal size image URL.
	 *
	 * @return  string
	 */
	public function getNormalUrlAttribute() {
		return $this->url(self::SIZE_MAIN);
	}


	/**
	 * Thumbnail URL.
	 *
	 * @return  string
	 */
	public function getOriginalUrlAttribute() {
		return $this->url(self::SIZE_ORIGINAL);
	}


	/**
	 * Thumbnail URL.
	 *
	 * @return  string
	 */
	public function getThumbUrlAttribute() {
		return $this->url(self::SIZE_THUMBNAIL);
	}


	/**
	 * URL to image.
	 *
	 * @param   string  $size
	 * @return  string
	 */
	protected function url($size = null) {
		$config  = Config::get('image');
		$postfix = array_get($config, $size == self::SIZE_ORIGINAL ? 'postfix_original' : ('sizes.' . $size . '.postfix'));
		if ($this->postfix) {
			$postfix = '_' . $this->postfix . $postfix;
		}

		$path     = $config['root'] . Text::idToPath($this->id);
		$filename = $this->id . $postfix . '.jpg';

		return $path . '/' . $filename;
	}

}

