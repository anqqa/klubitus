@extends('layouts.aside')

@section('content')
	<ul class="list-unstyled">
		@foreach ($shouts->reverse() as $shout)
		<li>
			<span class="text-muted" title="{{ date('j.n.Y', $shout->created) }}">{{ date('H:i', $shout->created) }}</span>
			{{ HTML::user($shout->author_id) }}
			{{{ $shout->shout }}}
		</li>
		@endforeach
	</ul>

	@if ($viewer)
{{ Form::open([ 'url' => 'shouts/shout', 'class' => 'ajaxify' ]) }}

{{ Form::field([
	'name'        => 'shout',
	'placeholder' => 'Shout, and ye shall be heard..'
]) }}

		@if (isset($limit))
{{ Form::hidden('limit', $limit) }}
		@endif

{{ Form::close() }}
	@endif
@stop
