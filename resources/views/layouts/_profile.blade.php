@section('profile')

<div class="ui center aligned basic segment">

	{{ HTML::avatar() }}
	<br>
	<div class="ui inline left pointing dropdown">
		<span class="text hide mobile">{{ $viewer->username }}</span>
		<i class="dropdown icon"></i>
		<div class="menu" role="menu">
			<a class="item" role="menuitem" href="{{ URL::route('user.profile', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-user"></i> Profile</a>
			<a class="item" role="menuitem" href="{{ URL::route('forum.messages') }}"><i class="fa fa-fw fa-envelope"></i> Private messages</a>
			<a class="item" role="menuitem" href="{{ URL::route('user.favorites', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-heart"></i> Favorites</a>
			<a class="item" role="menuitem" href="{{ URL::route('user.friends', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-group"></i> Friends</a>
			<a class="item" role="menuitem" href="{{ URL::route('user.ignores', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-ban"></i> Ignores</a>
			<a class="item" role="menuitem" href="{{ URL::route('user.settings', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-cog"></i> Settings</a>
			<a class="item" role="menuitem" href="{{ URL::route('session.destroy') }}"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
		</div>
	</div>

</div>

@show
