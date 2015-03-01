<?php namespace klubitus\Http\Controllers;

use klubitus\Repositories\ShoutRepository;


class ShoutController extends BaseController {

	/** @var   ShoutRepository */
	protected $shouts;


	public function __construct(ShoutRepository $shouts) {
		$this->shouts = $shouts;
	}


	/**
	 * Index.
	 */
	public function getIndex() {
		$this->layout->content = view('layouts._one_column', array(
			'content' => $this->viewShouts(25)
		));
	}


	/**
	 * Shout.
	 *
	 * @return  string|\Illuminate\Http\RedirectResponse
	 */
	public function postShout() {
		$this->api->post('shout', [ 'shout' => Input::get('shout') ]);

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
		$shouts = $this->shouts->findAll([ 'id', 'desc' ], $limit);
		//$shouts = $this->api->get('shouts', [ 'limit' => $limit]);

		return view('home.shouts', [
			'id'     => 'shouts',
			'title'  => 'Shouts',
			'shouts' => $shouts,
			'limit'  => $limit,
		])->render();
	}

}
