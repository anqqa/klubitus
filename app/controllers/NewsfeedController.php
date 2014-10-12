<?php
class NewsfeedController extends BaseController {

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
