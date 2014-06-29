<aside id="newsfeed">
	<header>

		<h3>What's happening?</h3>

	</header>
	<div class="body">

		<ul class="media-list">

			@foreach ($items->aggregated() as $item)
			<li class="media">
				<!--
				<div class="pull-left">
					{{ HTML::avatar($item->user_id) }}
				</div>
				-->
				<div class="media-body">
					<small class="text-muted pull-right" title="{{ date('j.n.Y', $item->created_at->timestamp) }}">{{ date('H:i', $item->created_at->timestamp) }}</small>
					{{ HTML::user($item->user_id) }}
					{{ $item->text }}
				</div>
			</li>
			@endforeach

		</ul>

	</div>
</aside>
