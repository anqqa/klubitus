<?php

class NewsfeedItemCollection extends \Illuminate\Database\Eloquent\Collection {

	/**
	 * Aggregated collection.
	 *
	 * @return  \Illuminate\Support\Collection
	 */
	public function aggregated() {

		// Group items by date
		$aggregated = $this->groupBy(function($model, $key) {
			$path   = $model->class . '.' . $model->type;
			$config = array_get(NewsfeedItem::config(), $path);

			if ($config && isset($config['text_aggregated'])) {
				return implode('.', [ $path, $model->user_id, date('Ymd', $model->created_at->timestamp) ]);
			} else {
				return $key;
			}
		});

		// Flatten groups
		$aggregated->transform(function($group) {
			$model = array_shift($group);

			if (count($group)) {
				$aggregate = array_reduce($group, function($data, $child) {
					$data['data'][]      = $child->data;
					$data['target_id'][] = $child->target_id;

					return $data;
				}, [ 'data' => [], 'target_id' => [] ]);

				$model->aggregated = true;
				$model->data       = $aggregate['data'];
				$model->target_id  = $aggregate['target_id'];
			}

			return $model;
		});

		return $aggregated;
	}

}
