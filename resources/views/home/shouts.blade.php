<aside id="shouts" class="pane pane-defult">
	<header class="pane-heading">

		<h3 class="pane-title">Shouts</h3>

	</header>
	<div class="pane-body">

		<ul class="list-unstyled">
			@foreach ($shouts->reverse() as $shout)
			<li>
				<span class="text-muted" title="{{ date('j.n.Y', $shout->created->timestamp) }}">{{ date('H:i', $shout->created->timestamp) }}</span>
				{!! Html::user($shout->author_id) !!}
				{{ $shout->shout }}
			</li>
			@endforeach
		</ul>

		@if (Auth::user())
	{!! Form::open([ 'url' => 'shouts/shout', 'class' => 'ajaxify' ]) !!}

	{!! Form::field([
		'name'        => 'shout',
		'placeholder' => 'Shout, and ye shall be heard..'
	]) !!}

			@if (isset($limit))
	{!! Form::hidden('limit', $limit) !!}
			@endif

	{!! Form::close() !!}
		@endif

	</div>
</aside>
