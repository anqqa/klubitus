<aside id="calendar" class="pane pane-defult">
	<header class="pane-heading">

		<h3 class="pane-title">
			<a href="{{{ $calendar->getPreviousLink() }}}"><i class="fa fa-chevron-left"></i></a>
			{{{ $calendar->getDate()->format('F Y') }}}
			<a href="{{{ $calendar->getNextLink() }}}"><i class="fa fa-chevron-right"></i></a>
		</h3>

	</header>
	<div class="pane-body">

		<table class="table">
			<thead>
				<tr>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thu</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($calendar->getWeeks() as $week)
				<tr>
					@foreach ($week as $day)
					<td class="{{{ implode($day['classes']) }}}">
						{{ HTML::linkRoute('events', $day['date']->day, [
							'year'  => $day['date']->year,
							'month' => $day['date']->month,
							'day'   => $day['date']->day,
						]) }}
					</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</aside>
