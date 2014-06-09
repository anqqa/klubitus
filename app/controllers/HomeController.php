<?php

class HomeController extends BaseController {

	/**
	 * Index.
	 *
	 * @return  \Illuminate\View\View
	 */
	public function getIndex() {
		$this->layout->content = View::make('layouts._three_columns', array(
			'left' => App::make('ShoutController')->viewShouts(10)
		));
	}


	protected function viewBirthdays() {

	}

	protected function viewNewsfeed() {

	}

}
