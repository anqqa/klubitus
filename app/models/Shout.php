<?php
/**
 * Shout model.
 */
class Shout extends Eloquent {

	/**
	 * Get end time in unix format.
	 *
	 * @return  integer
	 */
	public function getCreatedAttribute() {
		return strtotime($this->created_at);
	}


	/**
	 * Scope: latest.
	 *
	 * @param   \Illuminate\Database\Eloquent\Builder  $query
	 * @return  \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeLatest(\Illuminate\Database\Eloquent\Builder $query) {
		return $query->orderBy('id', 'DESC');
	}


	/**
	 * Get user.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo('User', 'author_id');
	}

}
