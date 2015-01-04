@section("mainmenu")

<div id="mainmenu" role="menu">

	@if (!$viewer)

	<div class="ui basic segment">
		{{ Form::open([ 'route' => 'session.store', 'class' => 'hide mobile' ]) }}

		<div class="ui fluid form">

			<div class="field">
				<input name="username" type="text" placeholder="Username/email" autofocus>
			</div>

			<div class="field">
				<div class="ui action input">
					<input name="password" placeholder="Passphrase" type="password">
					<a class="ui icon button" href="{{ URL::route('session.create') }}" title="Forgot your username or passphrase?">
						<i class="question icon"></i>
					</a>
				</div>
			</div>

			<div class="inline field">
				<div class="ui checkbox">
					<input id="login-remember" type="checkbox" name="remember" value="remember" checked>
					<label for="login-remember">Remember me</label>
				</div>
			</div>

			{{ Form::button('<i class="sign in icon"></i> Login', [ 'type' => 'submit', 'class' => 'tiny ui fluid primary submit compact labeled icon button', 'title' => 'Remember to sign out if on a public computer!' ]) }}

		</div>

		{{ Form::close() }}

		<a class="tiny ui fluid primary compact labeled icon button mobile only" href="{{ URL::route('session.create') }}" title="Login">
			<i class="sign in icon"></i>
		</a>

		<div class="ui horizontal divider hide mobile">
			or
		</div>

		<a class="tiny ui fluid pink compact labeled icon button" href="{{ URL::route('register') }}" title="Sign up - did we mention it's FREE!">
			<i class="signup icon"></i> <span class="text hide mobile">Sign up</span>
		</a>

		<a class="tiny ui fluid facebook compact labeled icon button" href="{{ URL::route('facebook-login') }}" title="Sign in with your Facebook account">
			<i class="facebook icon"></i> <span class="text hide mobile">Facebook</span>
		</a>

	</div>

	@else

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

	@endif

	<nav role="navigation" class="ui secondary fluid vertical pointing menu">
		<a role="menuitem" class="item" href="/">
			<i class="home icon"></i>
			<span class="text hide mobile">Home</span>
		</a>
		<a role="menuitem" class="item{{ $id == 'events' ? ' active' : '' }}" href="{{ URL::route('events') }}">
			<i class="calendar icon"></i>
			<span class="text hide mobile">Events</span>
		</a>
		<a role="menuitem" class="item{{ $id == 'forum' ? ' active' : '' }}" href="/">
			<i class="discussions icon"></i>
			<span class="text hide mobile">Forum</span>
		</a>
		<a role="menuitem" class="item{{ $id == 'galleries' ? ' active' : '' }}" href="/">
			<i class="photo icon"></i>
			<span class="text hide mobile">Galleries</span>
		</a>
		<a role="menuitem" class="item{{ $id == 'venues' ? ' active' : '' }}" href="/">
			<i class="marker icon"></i>
			<span class="text hide mobile">Venues</span>
		</a>
		<a role="menuitem" class="item{{ $id == 'music' ? ' active' : '' }}" href="/">
			<i class="music icon"></i>
			<span class="text hide mobile">Music</span>
		</a>
		<a role="menuitem" class="item{{ $id == 'blogs' ? ' active' : '' }}" href="/">
			<i class="book icon"></i>
			<span class="text hide mobile">Blogs</span>
		</a>
		<a role="menuitem" class="item{{ $id == 'members' ? ' active' : '' }}" href="/">
			<i class="users icon"></i>
			<span class="text hide mobile">Members</span>
		</a>
	</nav>

	<div class="ui centered eboard test ad" data-text="140x350"></div>

</div><!-- #mainmenu -->

@show
