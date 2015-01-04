

<section class="events">
	<div class="body">

		<div class="ui divided items">
			@foreach ($events as $event)

			@if (!isset($date) || $date != $event->start_date)
				<span class="ui black ribbon label">
					{{ $date = $event->start_date }}
				</span>
			@endif

			<div class="item">
				<div class="ui tiny image">
					@if ($flyer = $event->flyer)
					{{ HTML::image($flyer->image->thumbUrl, 'Flyer') }}
					@endif
				</div>

				<div class="content">

					{{ HTML::linkRoute('event', $event->name, [ $event->slug ], [ 'class' => 'header' ]) }}

					<div class="meta">

						@if ($event->favorite_count >= 100)
						<span class="ui right floated big red horizontal label">
							<a href="#">{{{ $event->favorite_count }}} <i class="like icon"></i></a>
						</span>
						@elseif ($event->favorite_count >= 50)
						<span class="ui right floated horizontal label">
							<a href="#">{{{ $event->favorite_count }}} <i class="like icon"></i></a>
						</span>
						@elseif ($event->favorite_count > 1)
						<span class="ui right floated tiny horizontal label">
							<a href="#">{{{ $event->favorite_count }}} <i class="like icon"></i></a>
						</span>
						@endif

						@if ($event->venue_id)
						{{ HTML::linkRoute('venue', $event->venue->name, [ $event->venue->slug ], [ 'class' => 'venue' ]) }}
						@elseif ($event->venue_name)
						<span class="venue">{{{ $event->venue_name }}}</span>
						@endif
						<span class="city">{{{ $event->city_name }}}</span>

					</div>

					@if ($event->favorite_count && $viewer && $friends = $event->favorites->toArray())
					<div class="description">

						@if (count($friends) > ($max = 10) + 1)
							@foreach (array_rand($friends, $max) as $key)
							{{ HTML::avatar($friends[$key]) }}
							@endforeach
							<span class="ui avatar image">+{{ count($friends) - $max }}</span>
						@else
							@foreach ($friends as $userId)
							{{ HTML::avatar($userId) }}
							@endforeach
						@endif

					</div>
					@endif

					<div class="extra">
						<small class="tags">{{{ $event->music }}}</small>
					</div>

				</div>

			</div>

			@endforeach
		</div>

	</div>
</section>
