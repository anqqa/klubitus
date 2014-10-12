<?php
namespace Klubitus\API;

use Klubitus\Models\NewsfeedItem;
use Klubitus\Models\NewsfeedRepository;


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
				->getLatest(min(100, abs((int)\Input::get('limit', 100))), 'id', 'user')
				->aggregated()
				->values();
	}

}
