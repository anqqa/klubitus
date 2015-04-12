<?php namespace klubitus\Http\Controllers;

class HomeController extends BaseController {
	protected $id = 'home';

	protected $newsfeedController;
	protected $shoutController;


	public function __construct(NewsfeedController $newsfeedController,
	                            ShoutController $shoutController) {
		$this->newsfeedController = $newsfeedController;
		$this->shoutController = $shoutController;
	}


	/**
	 * Index.
	 *
	 * @return  \Illuminate\View\View
	 */
	public function getIndex() {
		$this->layout->content = view(
			'layouts._three_columns', [
					'left' => $this->viewLogin(),
					'right' => $this->viewShouts(10)// . $this->viewNewsfeed(50),
			]
		);
	}


	protected function viewBirthdays() {

	}


	protected function viewLogin() {
		return view('home.login');
	}


	/**
	 * Newsfeed view.
	 *
	 * @param   integer  $limit
	 * @return  string
	 */
	protected function viewNewsfeed($limit = 50) {
		return $this->newsfeedController->viewNewsfeed($limit);
	}


	/**
	 * Shouts view.
	 *
	 * @param   integer  $limit
	 * @return  string
	 */
	protected function viewShouts($limit = 10) {
		return $this->shoutController->viewShouts($limit);
	}

}
