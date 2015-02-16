<?php namespace klubitus\Http\Controllers;

class BaseController extends Controller {

	/**
	 * @var  string  Page id
	 */
	protected $id;

	/**
	 * @var  string  Default layout
	 */
	protected $layout = 'layouts.default';

	/**
	 * @var  string
	 */
	protected $title;


	/**
	 * Setup the layout used by the controller.
	 */
	protected function setupLayout() {
		if (!is_null($this->layout)) {
			$this->layout = view($this->layout, array(
				'language' => Config::get('app.language', 'en'),
				'id'       => $this->id,
				'class'    => '',
				'title'    => $this->title
			));
		}
	}


	/**
	 * Build view.
	 *
	 * @param  string  $path  Template path
	 * @param  array   $data
	 */
	protected function view($path, $data = []) {
//		$this->layout->language = Config::get('app.language', 'en');
//		$this->layout->id       = '';
//		$this->layout->class    = '';

//		$this->layout->title    = $this->title;
		$this->layout->content  = view($path, $data);
	}

}
