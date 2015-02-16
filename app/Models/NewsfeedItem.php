<?php namespace klubitus;

use \Illuminate\Database\Eloquent\Collection;


class NewsfeedItem extends Entity {
	const CREATED_AT = 'stamp';

	protected $table = 'newsfeeditems';
	protected $visible = [ 'id', 'user_id', 'stamp', 'class', 'type', 'target_id', 'data', 'user' ];
	protected $appends = [ 'text' ];

	public $aggregated = false;

	/** @var  array */
	protected static $config;


	/**
	 * Create new Entity.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = array()) {
		parent::__construct($attributes);

		if (!static::$config) {
			static::config();
		}
	}


	/**
	 * Get config.
	 *
	 * @return  array
	 */
	public static function config() {
		if (!static::$config) {
			static::$config = \Config::get('newsfeed.items');
		}

		return static::$config;
	}


	/**
	 * Get data.
	 * @param   string  $value
	 * @return  array
	 */
	public function getDataAttribute($value) {
		return $value ? json_decode($value) : null;
	}


	/**
	 * Get text.
	 *
	 * @return  string
	 */
	public function getTextAttribute() {
		$path   = $this->class . '.' . $this->type;
		$config = array_get(self::$config, $path, []);
		$model  = array_get($config, 'target_model');

		$text   = array_get($config, $this->aggregated ? 'text_aggregated' : 'text', 'did something strange (' . $path . ')');
		$links  = [];

		// Get target links
		if ($model) {
			$targetIds = (array)$this->target_id;
			foreach ($targetIds as $targetId) {
				$links[] = $this->_link($model, $targetId);
			}
		}
		$links = array_filter($links);

		// Special cases
		switch ($path) {

			case 'user.friend':
				$last = array_pop($links);
				if ($this->aggregated) {
					$text  = sprintf($text, implode(', ', $links), $last);
					$links = null;
				} else {
					$text = sprintf($text, $last);
				}
				break;

		}

		return $text . ($links ? '<br>' . implode('<br>', $links) : '');
	}


	/**
	 * Get anchor to target model.
	 *
	 * @param   string   $targetModel
	 * @param   integer  $targetId
	 * @param   array    $dataModels
	 * @return  string
	 */
	private function _link($targetModel, $targetId, $dataModels = []) {
		switch ($targetModel) {

			case 'User':
				return HTML::user($targetId);

			default:
				if (class_exists($targetModel)) {

					/** @var  Eloquent $target */
					$target = new $targetModel;
					if ($target->find($targetId)) {
						return $target->getTable();
					}

				}

		}

		return null;
	}


	/**
	 * Eloquent Collection with aggregated item support.
	 *
	 * @param   array   $models
	 * @return  Collection|NewsfeedItemCollection
	 */
	public function newCollection(array $models = array()) {
		return new NewsfeedItemCollection($models);
	}


	/**
	 * Set data.
	 *
	 * @param  array  $value
	 */
	public function setDataAttribute(array $value = null) {
		$this->attributes['data'] = $value ? json_encode($value) : null;
	}


	/**
	 * Target model for non-aggregated items.
	 */
	public function target() {
		$path   = $this->class . '.' . $this->type;
		$config = array_get(self::$config, $path, []);
		$model  = array_get($config, 'target_model');

		return ($this->aggregated || !$model) ? null : $this->belongsTo($model, 'target_id');
	}


	public function user() {
		return $this->belongsTo('UserLight', 'user_id');
	}

}
