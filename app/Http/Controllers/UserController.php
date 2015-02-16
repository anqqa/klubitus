<?php

class UserController extends BaseController {

	/**
	 * Profile.
	 */
	public function getProfile(User $user) {
		$this->layout->content = View::make('layouts._right_sidebar', array(
		));
	}


	public function getRegister() {

	}

}
