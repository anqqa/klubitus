<?php

class HomeController extends BaseController {

	/**
	 * Index.
	 *
	 * @return  \Illuminate\View\View
	 */
	public function getIndex() {
		$this->layout->content = View::make('layouts._three_columns', array(
			'left' => $this->_viewShouts()
		));
	}


	protected function _viewBirthdays() {

	}

	protected function _viewNewsfeed() {

	}


	protected function _viewShouts() {
		return View::make('home._shouts', array(
			'title' => 'Shoutbox'
		));
	}

}
