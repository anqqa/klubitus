<?php

class BaseController extends Controller {

	const COLUMN_TOP    = 'top';
	const COLUMN_LEFT   = 'left';
	const COLUMN_CENTER = 'center';
	const COLUMN_RIGHT  = 'right';
	const COLUMN_BOTTOM = 'bottom';
	const COLUMN_FOOTER = 'footer';

	/**
	 * @var  array  Content
	 */
	protected $_columns = [];

	/**
	 * @var  string  Default layout
	 */
	protected $layout = 'layouts.default';

	/**
	 * @var  string
	 */
	protected $title;


	/**
	 * Set content to column.
	 *
	 * @param  string  $column
	 * @param  mixed   $content
	 */
	protected function column($column, $content) {
		$this->_columns[$column][] = $content;
	}


	/**
	 * Setup the layout used by the controller.
	 */
	protected function setupLayout() {
		if (!is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}


	/**
	 * Build view.
	 *
	 * @param  string  $path  Template path
	 * @param  array   $data
	 */
	protected function view($path, $data = []) {
		$this->layout->language = Config::get('app.language', 'en');
		$this->layout->id       = '';
		$this->layout->class    = '';

		$this->layout->title    = $this->title;
		$this->layout->content  = View::make($path, $data);
	}

}
