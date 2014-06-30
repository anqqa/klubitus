

<section class="events">
	<div class="body">

		<ul class="media-list">
			@foreach ($events as $event)

			@if (!isset($date) || $date != $event->start_date)
			<li class="date">{{ $date = $event->start_date }}</li>
			@endif

			<li class="media">
				<div class="pull-left">
				</div>

				<div class="media-body">
					@if ($event->favorite_count >= 100)
					<span class="favorites">
						<a href="#" class="text-lovely">{{{ $event->favorite_count }}} <i class="fa fa-heart"></i></a>
					</span>
					@elseif ($event->favorite_count >= 50)
					<small class="favorites">
						<a href="#" class="text-success">{{{ $event->favorite_count }}} <i class="fa fa-heart"></i></a>
					</small>
					@elseif ($event->favorite_count > 1)
					<small class="favorites">
						<a href="#" class="text-muted">{{{ $event->favorite_count }}} <i class="fa fa-heart"></i></a>
					</small>
					@endif

					<h4 class="media-heading">
						{{ HTML::linkRoute('event', $event->name, array($event->slug)) }}
					</h4>

					{{{ $event->venue_name }}}, {{{ $event->city_name }}}<br>
					<small class="tags">{{{ $event->music }}}</small>

				</div>
			</li>

			@endforeach
		</ul>

	</div>
</section>
