<?php namespace klubitus\Http\Controllers;

class NewsfeedAPIController extends BaseAPIController {

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
				->getLatest(min(100, abs((int)\Input::get('limit', 100))), 'id', 'user')
				->aggregated()
				->values();
	}

}
