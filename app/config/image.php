<?php
return array(

	// Images root
	'root' => App::environment('dev')
		? '//imagesdev.klubitus.org/'
		: '//images.klubitus.org/',

	// Local image path
	'path' => 'images/',

	// Default upload path, needs write access
	'upload_path' => 'images/upload/',

	// Prefix for original image
	'postfix_original' => '_o',

	// Default image quality,
	'quality' => 95,

	// Maximum filesize
	'filesize' => '10M',

	// Allowed file types
	'filetypes' => array('jpg', 'jpeg', 'gif', 'png'),
	'mimetypes' => array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'),

	// Different image sizes
	'sizes' => array(

		// Max width image, default for gallery
		Image::SIZE_WIDE => array(
			'width'  => 940,
			'height' => 680,
			'resize' => array(940, 680), // Wide column
		),

		// Main column
		Image::SIZE_MAIN => array(
			'width'  => 440,
			'height' => 590,
			'resize' => array(440, 590), // Used for side column too, resized in browser
		),

		// Side column
		Image::SIZE_SIDE => array(
			'width'  => 290,
			'height' => 580,
			'resize' => array(290, 580),
		),

		// Thumbnail
		Image::SIZE_THUMBNAIL => array(
			'postfix' => '_t',
			'width'   => 140,
			'height'  => 140,
			'quality' => 90,
			'resize'  => array(140, 140, Image::INVERSE), // Resize to minimum 140x140
			'crop'    => array(140, 140, null, 0),        // Crop to center and top
		),

		// Square
		Image::SIZE_ICON => array(
			'postfix' => '_i',
			'width'   => 50,
			'height'  => 50,
			'quality' => 85,
			'resize'  => array(50, 50, Image::INVERSE), // Resize to minimum 50x50
			'crop'    => array(50, 50, null, 0),        // Crop to center and top
		),

	),

);
