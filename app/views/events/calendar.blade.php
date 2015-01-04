<aside id="calendar">
	<table class="ui seven column table">
		<thead>
			<tr>
				<th><a class="" href="{{{ $calendar->getPreviousLink() }}}"><i class="fa fa-chevron-left"></i></a></th>
				<th class="center aligned" colspan="5">{{{ $calendar->getDate()->format('F Y') }}}</th>
				<th class="right aligned"><a class="" href="{{{ $calendar->getNextLink() }}}"><i class="fa fa-chevron-right"></i></a></th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<th class="center aligned">Mon</th>
				<th class="center aligned">Tue</th>
				<th class="center aligned">Wed</th>
				<th class="center aligned">Thu</th>
				<th class="center aligned">Fri</th>
				<th class="center aligned">Sat</th>
				<th class="center aligned">Sun</th>
			</tr>

			@foreach ($calendar->getWeeks() as $week)
			<tr>
				@foreach ($week as $day)
				<td class="center aligned {{{ implode($day['classes']) }}}">
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
</aside>
