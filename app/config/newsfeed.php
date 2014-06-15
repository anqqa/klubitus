<?php

return [

	'items' => [

		'blog' => [
			'comment' => [
				'target_model'    => 'BlogEntry',
				'text'            => 'commented to a blog entry',
				'text_aggregated' => 'commented to blog entries',
			],
			'entry' => [
				'target_model'    => 'BlogEntry',
				'text'            => 'wrote a new blog entry',
				'text_aggregated' => 'wrote new blog entries',
			],
		],

		'events' => [
			'event' => [
				'target_model'    => 'Events',
				'text'            => 'created a new event',
				'text_aggregated' => 'created new events',
			],
			'event_edit' => [
				'target_model'    => 'Events',
				'text'            => 'updated an event',
				'text_aggregated' => 'updated events',
			],
			'favorite' => [
				'target_model'    => 'Events',
				'text'            => 'added an event to favorites',
				'text_aggregated' => 'added events to favorites',
			],
		],

		'forum' => [
			'reply' => [
				'target_model'    => 'ForumPost',
				'data_models'     => [ 'topic_id' => 'ForumTopic' ],
				'text'            => 'replied to topic',
				'text_aggregated' => 'replied to topics',
			],
			'topic' => [
				'target_model'    => 'ForumTopic',
				'text'            => 'started a new topic',
				'text_aggregated' => 'started new topics',
			],
		],

		'galleries' => [
			'comment' => [
				'target_model'    => 'Image',
				'data_models'     => [ 'gallery_id' => 'Gallery' ],
				'text'            => 'commented a photo',
				'text_aggregated' => 'commented photos',
			],
			'comment_flyer' => [
				'target_model'    => 'Flyer',
				'data_models'     => [ 'image_id' => 'Image' ],
				'text'            => 'commented a flyer',
				'text_aggregated' => 'commented flyers',
			],
			'flyer_edit' => [
				'target_model'    => 'Flyer',
				'text'            => 'updated a flyer',
				'text_aggregated' => 'updated flyers',
			],
			'note' => [
				'target_model'    => 'Image',
				'data_models'     => [ 'gallery_id' => 'Gallery', 'user_id' => 'User' ],
				'text'            => 'tagged an image',
				'text_aggregated' => 'tagged images',
			],
			'upload' => [
				'target_model'    => 'Gallery',
				'text'            => 'added new photos to a gallery',
				'text_aggregated' => 'added new photos to a galleries',
			],
		],

		'music' => [
			'mixtape' => [
				'target_model'    => 'Music',
				'text'            => 'added a new mixtape',
				'text_aggregated' => 'added new mixtapes',
			],
			'track' => [
				'target_model'    => 'Music',
				'text'            => 'added a new track',
				'text_aggregated' => 'added new tracks',
			],
		],

		'user' => [
			'default_image' => [
				'text'            => 'changed their profile image',
			],
			'friend' => [
				'target_model'    => 'User',
				'text'            => 'added %s as a friend',
				'text_aggregated' => 'added %s and %s friends'
			],
		],

		'venues' => [
			'venue' => [
				'target_model'    => 'Venue',
				'text'            => 'created a new venue',
				'text_aggregated' => 'created new venues',
			],
			'venue_edit' => [
				'target_model'    => 'Venue',
				'text'            => 'updated a venue',
				'text_aggregated' => 'updated venues',
			],
		],

	],

];
