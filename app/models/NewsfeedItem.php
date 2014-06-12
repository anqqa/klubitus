<?php
class NewsfeedItem extends Entity {
	protected $table = 'newsfeeditems';

	public $aggregated = false;


	/**
	 * Get text.
	 *
	 * @return  string
	 */
	public function getTextAttribute() {
		switch ($this->class) {

			// Blogs
			case 'blog':
				switch ($this->type) {

					// Comment a blog entry
					case 'comment':
						return $this->aggregated
							? 'commented to blog entries'
							: 'commented to a blog entry';

					// Create a blog entry
					case 'entry':
						return $this->aggregated
							? 'wrote new blog entries'
							: 'wrote a new blog entry';

				}
				break;

			// Events
			case 'events':
				switch ($this->type) {

					// Create an event
					case 'event':
						return $this->aggregated
							? 'created new events'
							: 'created a new event';

					// Edit an event
					case 'event_edit':
						return $this->aggregated
							? 'updated events'
							: 'updated an event';

					// Favorite an event
					case 'favorite':
						return $this->aggregated
							? 'added events to favorites'
							: 'added an event to favorites';
				}
				break;

			// Forum
			case 'forum':
				switch ($this->type) {

					// Reply to a topic
					case 'reply':
						return $this->aggregated
							? 'replied to topics'
							: 'replied to topic';

					// Create a topic
					case 'topic':
						return $this->aggregated
							? 'started new topics'
							: 'started a new topic';

				}
				break;

			// Galleries
			case 'galleries':
				switch ($this->type) {

					// Commente an image
					case 'comment':
						return $this->aggregated
							? 'commented photos'
							: 'commented a photo';

					// Commente flyer
					case 'comment_flyer':
						return $this->aggregated
							? 'commented flyers'
							: 'commented a flyer';

					// Edit a flyer
					case 'flyer_edit':
						return $this->aggregated
							? 'updated flyers'
							: 'updated a flyer';

					// Create a noew
					case 'note':
						return $this->aggregated
							? 'tagged images'
							: 'tagged an image';

					// Upload images
					case 'upload':
						return $this->aggregated
							? 'added new photos to a galleries'
							: 'added new photos to a gallery';

				}
				break;

			// Music
			case 'music':
				switch ($this->type) {

					// Add a mixtape
					case 'mixtape':
						return $this->aggregated
							? 'added new mixtapes'
							: 'added a new mixtape';

					// Add a track
					case 'track':
						return $this->aggregated
							? 'added new tracks'
							: 'added a new track';

				}
				break;

			// Users
			case 'user':
				switch ($this->type) {

					// Change default image
					case 'default_image':
						return 'changed their profile image';

					// Friend a user
					case 'friend':
						return $this->aggregated
							? 'added friends'
							: 'added a friend';

				}
				break;

			// Venus
			case 'venues':
				switch ($this->type) {

					// Add a venue
					case 'venue':
						return $this->aggregated
							? 'created new venues'
							: 'created a new venue';

					// Edit a venue
					case 'venue_edit':
						return $this->aggregated
							? 'updated venues'
							: 'updated a venue';

				}
				break;

		}

		return 'did something weird (' . $this->class . '.' . $this->type . ')';
	}


	/**
	 * Eloquent Collection with aggregated item support.
	 *
	 * @param   array   $models
	 * @return  \Illuminate\Database\Eloquent\Collection|NewsfeedItemCollection
	 */
	public function newCollection(array $models = array()) {
		return new NewsfeedItemCollection($models);
	}

}
