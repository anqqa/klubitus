@section("mainmenu")

<nav id="mainmenu" role="navigation" class="navbar navbar-inverse navbar-static-top">

	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu [role=menubar]">
			<i class="fa fa-bars"></i>
		</button>
		<a href="/" class="navbar-brand">klubitus</a>
	</div>

	<ul class="nav navbar-nav collapse navbar-collapse" role="menubar">
		<li role="menuitem" class="{{ $id == 'home' ? 'active' : '' }}">
			<a href="/">Events</a>
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
		search

		@if (!Auth::check())
		<li>
			<a href="{{ URL::route('register') }}" title="Did we mention it's FREE!">
				<i class="fa fa-heart"></i> Sign up
			</a>
		</li>

		<li id="signin" class="dropdown">
			<a href="{{ URL::route('login') }}" class="dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-sign-in"></i> Login
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				@include('home._login', [ 'form' => null ])
			</div>
		</li>

		@else
		<a href="{{ URL::route('logout') }}">Logout</a>
		@endif

		theme
	</ul>

</nav><!-- #mainmenu -->

@show
