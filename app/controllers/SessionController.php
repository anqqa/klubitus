<?php

class SessionController extends BaseController {

	/**
	 * Show login.
	 */
	public function create() {
	}


	/**
	 * Logout.
	 *
	 * @return  \Illuminate\Http\JsonResponse
	 */
	public function destroy() {
		Auth::logout();

		return Response::json([
					'status' => 'error',
				], 200);
	}


	/**
	 * Login.
	 *
	 * @return  \Illuminate\Http\JsonResponse
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
							'user'   => Auth::user()->toArray()
						], 202);

			} else {

				// Login failed
				$form->getErrors()->add('password', 'Nope!');

				return Response::json([
							'status' => 'error',
							'errors' => $form->getErrors()->toArray()
						], 401);

			}
		} else {

			return Response::json([
						'status' => 'error',
						'errors' => $form->getErrors()->toArray()
					], 401);

		}
	}

}
