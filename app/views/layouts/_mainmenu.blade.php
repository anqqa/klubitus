@section("mainmenu")

<nav id="mainmenu" role="navigation" class="navbar navbar-default navbar-static-top">
	<div class="container">

		<div class="navbar-header mainmenu">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu [role=menubar]">
				<i class="fa fa-bars"></i>
			</button>
			<a href="/" class="navbar-brand">klubitus</a>
		</div>

		<ul class="nav navbar-nav collapse navbar-collapse mainmenu" role="menubar">
			<li role="menuitem" class="{{ $id == 'events' ? 'active' : '' }}">
				<a href="{{ URL::route('events') }}">Events</a>
			</li>
			<li role="menuitem" class="{{ $id == 'forum' ? 'active' : '' }}">
				<a href="/">Forum</a>
			</li>
			<li role="menuitem" class="{{ $id == 'galleries' ? 'active' : '' }}">
				<a href="/">Galleries</a>
			</li>
			<li role="menuitem" class="{{ $id == 'music' ? 'active' : '' }}">
				<a href="/">Music</a>
			</li>
			<li role="menuitem" class="{{ $id == 'blogs' ? 'active' : '' }}">
				<a href="/">Blogs</a>
			</li>
			<li role="menuitem" class="{{ $id == 'venues' ? 'active' : '' }}">
				<a href="/">Venues</a>
			</li>
			<li role="menuitem" class="{{ $id == 'members' ? 'active' : '' }}">
				<a href="/">Members</a>
			</li>
		</ul>

		<ul class="nav navbar-nav navbar-right collapse navbar-collapse" role="menubar">
			<!--
			<li>
				search
			</li>
			-->

			@if (!$viewer)

			<li>
				<a href="{{ URL::route('register') }}" title="Did we mention it's FREE!">
					<i class="fa fa-heart"></i> Sign up
				</a>
			</li>

			<li id="signin" class="dropdown">
				<a href="{{ URL::route('session.create') }}" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-sign-in"></i> Login
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					@include('home._login', [ 'form' => null ])
				</div>
			</li>

			@else

			<li id="notifications"></li>

			<li class="hidden-xs">
				{{ HTML::avatar() }}
			</li>

			<li id="visitor" class="dropdown">
				<a class="user dropdown-toggle" href="#menu-profile" data-toggle="dropdown">{{{ $viewer->username }}}<span class="caret"></span></i></a>
				<ul class="dropdown-menu pull-right" role="menu">
					<li role="menuitem">
						<a href="{{ URL::route('user.profile', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-user"></i> Profile</a>
						<a href="{{ URL::route('forum.messages') }}"><i class="fa fa-fw fa-envelope"></i> Private messages</a>
						<a href="{{ URL::route('user.favorites', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-heart"></i> Favorites</a>
						<a href="{{ URL::route('user.friends', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-group"></i> Friends</a>
						<a href="{{ URL::route('user.ignores', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-ban"></i> Ignores</a>
						<a href="{{ URL::route('user.settings', [ 'user' => Text::slug($viewer->username) ]) }}"><i class="fa fa-fw fa-cog"></i> Settings</a>
						<a href="{{ URL::route('session.destroy') }}"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
					</li>
				</ul>
			</li>

			@endif

			<!--
			<li>
				theme
			</li>
			-->
		</ul>

	</div>
</nav><!-- #mainmenu -->

@show
