<?php

class HomeController extends BaseController {

	/**
	 * Index.
	 *
	 * @return  \Illuminate\View\View
	 */
	public function getIndex() {
		$this->layout->content = View::make('layouts._three_columns', array(
			'right' => $this->viewShouts(10) . $this->viewNewsfeed(50),
		));
	}


	protected function viewBirthdays() {

	}


	/**
	 * Newsfeed view.
	 *
	 * @param   integer  $limit
	 * @return  \Illuminate\View\View
	 */
	protected function viewNewsfeed($limit = 50) {
		return App::make('NewsfeedController')->viewNewsfeed($limit);
	}


	/**
	 * Shouts view.
	 *
	 * @param   integer  $limit
	 * @return  \Illuminate\View\View
	 */
	protected function viewShouts($limit = 10) {
		return App::make('ShoutController')->viewShouts($limit);
	}

}
