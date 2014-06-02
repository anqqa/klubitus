<a href="{{ URL::route('facebook-login') }}" class="btn btn-block btn-facebook" title="Sign in with your Facebook account">
	&nbsp;<i class="fa fa-facebook"></i> Connect with Facebook&nbsp;
</a>

<hr>

{{ Form::open([ 'route' => 'register' ]) }}

{{ Form::field([
	'form'      => $form,
	'name'      => 'username',
	'label'     => 'Username or email',
	'autofocus' => 'autofocus'
]) }}

{{ Form::field([
	'form'  => $form,
	'type'  => 'password',
	'name'  => 'password',
	'label' => 'Password'
]) }}

{{ Form::field([
	'form'  => $form,
	'type'  => 'checkbox',
	'name'  => 'remember',
	'value' => 'remember',
	'label' => 'Stay logged in'
]) }}

{{ Form::button('Login', [ 'class' => 'btn btn-block btn-primary', 'title' => 'Remember to sign out if on a public computer!' ]) }}

{{ Form::close() }}

<sub>
	<a href="#" class="text-muted">Forgot username or password?</a>
</sub>

