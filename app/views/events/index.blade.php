

<section class="events">
	<div class="body">

		<div class="ui divided items">
			@foreach ($events as $event)

			@if (!isset($date) || $date != $event->start_date)
				<span class="ui blue ribbon label">
					{{ $date = $event->start_date }}
				</span>
			@endif

			<div class="item">
				@if ($flyer = $event->flyer)
					<div class="ui tiny image">
						{{ HTML::image($flyer->image->thumbUrl, 'Flyer') }}
					</div>
				@else
					<div class="ui tiny image placeholder">
						<i class="bordered inverted disabled big calendar icon"></i>
					</div>
				@endif

				<div class="content">

					{{ HTML::linkRoute('event', $event->name, [ $event->slug ], [ 'class' => 'header' ]) }}

					<div class="meta">

						@if ($event->venue_id)
							{{ HTML::linkRoute('venue', $event->venue->name, [ $event->venue->slug ], [ 'class' => 'venue' ]) }}
						@elseif ($event->venue_name)
							<span class="venue">{{{ $event->venue_name }}}</span>
						@endif
						<span class="city">{{{ $event->city_name }}}</span>

					</div>

					<div class="extra">

						<span class="favorites">
							@if ($event->favorite_count >= 100)
								<span class="ui big red label">
									<i class="like icon"></i>{{{ $event->favorite_count }}}
								</span>
							@elseif ($event->favorite_count >= 50)
								<span class="ui black label">
									<i class="like icon"></i>{{{ $event->favorite_count }}}
								</span>
							@elseif ($event->favorite_count > 1)
								<span class="ui tiny black label">
									<i class="like icon"></i>{{{ $event->favorite_count }}}
								</span>
							@endif
						</span>

						@if ($event->favorite_count && $viewer && $friends = $event->favorites->toArray())
							<span class="friend favorites">
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
							</span>
						@endif

						<br>

						<small class="tags">{{{ $event->music }}}</small>
					</div>

				</div>

			</div>

			@endforeach
		</div>

	</div>
</section>
