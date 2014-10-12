<?php
class NewsfeedController extends BaseController {

	/** @var  NewsfeedRepository */
	protected $newsfeed;


	/**
	 * @param  NewsfeedRepository  $newsfeed
	 */
	public function __construct(NewsfeedRepository $newsfeed) {
		$this->newsfeed = $newsfeed;
	}


	/**
	 * API: Latest items.
	 *
	 * @return  NewsfeedItem[]
	 */
	public function index() {
		return $this->newsfeed
				->getLatest(min(100, abs((int)Input::get('limit', 100))), 'id', 'user')
				->aggregated()
				->values();
	}


	/**
	 * Index.
	 */
	public function getIndex() {
		$this->layout->content = View::make('layouts._one_column', array(
			'content' => $this->viewNewsfeed(50)
		));
	}


	/**
	 * Shouts view.
	 *
	 * @param   integer  $limit
	 * @return  string
	 */
	public function viewNewsfeed($limit = 10) {
		return View::make('newsfeed.feed', array(
			'id'    => 'newsfeed',
			'items' => NewsfeedItem::latest()->take(min(100, $limit))->get(),
		))->render();
	}

}
