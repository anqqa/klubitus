<?php

class SessionController extends BaseController {

	/**
	 * Show login.
	 */
	public function create() {
		$this->layout->content = View::make('layouts._two_columns', array(
			'left' => $this->viewLogin()
		));
	}


	/**
	 * Logout.
	 *
	 * @return  \Illuminate\Http\RedirectResponse
	 */
	public function destroy() {
		Auth::logout();

		return Redirect::to('/')->with('message', 'Bye bye!');
	}


	/**
	 * Attempt to login.
	 */
	public function store() {
		$form = new BaseForm();

		if ($form->isValid([
			'username' => 'required',
			'password' => 'required'
		])) {

			// Attempt login
			$username = Input::get('username');
			$field    = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
			if (Auth::attempt(array(
				$field     => $username,
				'password' => Input::get('password')
			), (bool)Input::get('remember'))) {

				// Login successful
				return Response::json([
							'status' => 'success',
							'user' =>   Auth::user()->toArray()
						], 202);
				//return Redirect::intended('/');

			} else {

				// Login failed
				$form->getErrors()->add('password', 'Nope!');

				return Response::json([
							'status' => 'error',
							'messages' => $form->getErrors()->toArray()
						], 401);

			}
		} else {

			return Response::json([
						'status' => 'error',
						'messages' => $form->getErrors()->toArray()
					], 401);

		}
	}


	/**
	 * Shouts view.
	 *
	 * @param   BaseForm  $form
	 * @return  \Illuminate\View\View
	 */
	protected function viewLogin(BaseForm $form = null) {
		return View::make('home.login', array(
			'title' => 'Login',
			'form'  => $form,
		));
	}

}
