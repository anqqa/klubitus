<?php

class NewsfeedItemCollection extends \Illuminate\Database\Eloquent\Collection {
	private $aggregate = [
		'blog'      => [ 'comment', 'entry' ],
		'events'    => [ 'event', 'event_edit', 'favorite' ],
		'forum'     => [ 'reply', 'topic' ],
		'galleries' => [ 'comment', 'comment_flyer', 'flyer_edit', 'upload' ],
		'music'     => [ 'mixtape', 'track' ],
		'user'      => [ 'friend' ],
		'venues'    => [ 'venue', 'venue_edit' ],
	];


	/**
	 * Aggregated collection.
	 *
	 * @return  \Illuminate\Support\Collection
	 */
	public function aggregated() {

		// Group items by date
		$aggregated = $this->groupBy(function($model, $key) {
			if (in_array($model->type, array_get($this->aggregate,$model->class, []))) {
				return implode('.', [ $model->class, $model->type, $model->user_id, date('Ymd', $model->created) ]);
			} else {
				return $key;
			}
		});

		// Flatten groups
		$aggregated->transform(function($group) {
			$model = array_shift($group);

			if (count($group)) {
				$model->aggregated = true;
				$model->data       = array_reduce($group, function($data, $child) {
					$data[] = $child->data;

					return $data;
				}, []);
			}

			return $model;
		});

		return $aggregated;
	}

}
