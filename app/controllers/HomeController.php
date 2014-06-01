<?php

class HomeController extends BaseController {

	/**
	 * Index.
	 *
	 * @return  \Illuminate\View\View
	 */
	public function getIndex() {
		$this->layout->content = View::make('layouts._three_columns', array(
			'left' => $this->_viewShouts(10)
		));
	}


	protected function _viewBirthdays() {

	}

	protected function _viewNewsfeed() {

	}


	/**
	 * Shouts view.
	 *
	 * @param   integer  $limit
	 * @return  \Illuminate\View\View
	 */
	protected function _viewShouts($limit = 10) {
		return View::make('home.shouts', array(
			'title'    => 'Shouts',
			'shouts'   => Shout::latest()->take($limit)->get(),
			'canShout' => true,
		));
	}

}
