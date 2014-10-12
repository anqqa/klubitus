<?php
class APIShoutController extends APIBaseController {

	/** @var  ShoutRepository */
	protected $shouts;


	/**
	 * @param  ShoutRepository  $shouts
	 */
	public function __construct(ShoutRepository $shouts) {
		$this->shouts = $shouts;
	}


	/**
	 * API: Latest shouts.
	 *
	 * @return  \Illuminate\Database\Eloquent\Collection
	 */
	public function index() {
		return $this->shouts->getLatest(min(100, abs((int)\Input::get('limit', 100))), 'id', 'user');
	}

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
		return View::make('home.shouts', array(
			'id'     => 'shouts',
			'title'  => 'Shouts',
			'shouts' => Shout::latest()->take(min(100, $limit))->get(),
			'limit'  => $limit,
		))->render();
	}

}
