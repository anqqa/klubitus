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
	 * Execute an action on the controller.
	 *
	 * @param   string  $method
	 * @param   array   $parameters
	 * @return  \Symfony\Component\HttpFoundation\Response
	 */
	public function callAction($method, $parameters) {
		$this->setupLayout();

		$response = call_user_func_array([ $this, $method ], $parameters);

		if (is_null($response) && !is_null($this->layout)) {
			$response = $this->layout;
		}

		return $response;
	}


	/**
	 * Set view content.
	 *
	 * @param   string  $view
	 * @param   array $data
	 * @return  \Illuminate\View\View
	 */
	public function setContent($view, array $data = []) {
		if (!is_null($this->layout)) {
			return $this->layout->nest('child', $view, $data);
		}

		return view($view, $data);
	}


	/**
	 * Set base layout.
	 *
	 * @param  string  $name
	 */
	protected function setLayout($name) {
		$this->layout = $name;
	}


	/**
	 * Setup the layout used by the controller.
	 */
	protected function setupLayout() {
		if (!is_null($this->layout)) {
			$this->layout = view($this->layout, [
				'language' => config('app.language', 'en'),
				'id'       => $this->id,
				'class'    => '',
				'title'    => $this->title
			]);
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
