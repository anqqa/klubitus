{!! Form::open([ 'route' => 'session.store', 'class' => 'ui form' ]) !!}

<div class="two fields">
  <div class="field">
    <label for="input-username">Username</label>
    <div class="ui icon input">
      <input id="input-username" name="username" type="text" placeholder=".. or email" autofocus>
      <i class="user icon"></i>
    </div>
  </div>

  <div class="field">
    <label for="input-password">Passphrase
      <sup class="text right">
        <a href="{{ URL::route('session.create') }}" class="text-muted">Forgot?</a>
      </sup>
    </label>
    <div class="ui icon input">
      <input id="input-password" name="password" type="password" placeholder="Passphrase">
      <i class="lock icon"></i>
    </div>
  </div>
</div>

<div class="two fields">
  <div class="field">
    <div class="ui checkbox">
      <input id="input-remember" name="remember" type="checkbox" value="me">
      <label for="input-remember">Stay logged in</label>
    </div>
  </div>

  <div class="field">
  {!! Form::button('Login', [ 'type' => 'submit',
                              'class' => 'ui secondary fluid submit button',
                              'title' => 'Remember to sign out if on a public computer!' ]) !!}
  </div>
</div>

{!! Form::close() !!}


<div class="ui horizontal divider">
  or
</div>

<a href="/" class="ui secondary fluid button" title="Did we mention it's free?">
  Sign Up
</a>

<br>

<a href="{{ URL::route('facebook-login') }}" class="ui fluid facebook button" title="Sign in with your Facebook account">
  <i class="facebook icon"></i> Connect with Facebook
</a>
