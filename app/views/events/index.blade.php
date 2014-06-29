

<section class="events">
	<div class="body">

		<ul class="media-list">

			@foreach ($events as $event)

			@if (!isset($date) || $date != $event->start_date)
			<li class="bg-info date">{{ $date = $event->start_date }}</li>
			@endif

			<li class="media">
				<div class="pull-left">
				</div>
				<div class="media-body">
					{{{ $event->name }}}
				</div>
			</li>

			@endforeach

		</ul>

	</div>
</section>
