<?php

class HomeController extends BaseController {

	/**
	 * Index.
	 *
	 * @return  \Illuminate\View\View
	 */
	public function getIndex() {
		$this->view('home.index');
	}

}
