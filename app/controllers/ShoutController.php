<?php
class ShoutController extends BaseController {

	/**
	 * Index.
	 */
	public function getIndex() {
		$this->layout->content = View::make('layouts._one_column', array(
			'content' => $this->viewShouts(25)
		));
	}


	/**
	 * Shout.
	 *
	 * @return  string|\Illuminate\Http\RedirectResponse
	 */
	public function postShout() {
		if (Auth::check()) {
			$form = new BaseForm();

			if ($form->isValid([
				'shout' => 'required',
			])) {

				// Shout it
				Shout::create([
					'shout'     => Input::get('shout'),
					'author_id' => Auth::user()->id
				]);

			}
		}

		if (Request::ajax()) {
			return $this->viewShouts(Input::get('limit', 10));
		}

		return Redirect::to('shouts');
	}


	/**
	 * Shouts view.
	 *
	 * @param   integer  $limit
	 * @return  string
	 */
	public function viewShouts($limit = 10) {
		$shouts = $this->api->get('shouts', [ 'limit' => $limit]);

		return View::make('home.shouts', array(
			'id'     => 'shouts',
			'title'  => 'Shouts',
			'shouts' => $shouts,
			'limit'  => $limit,
		))->render();
	}

}
