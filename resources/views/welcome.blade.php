<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Training Certificate Portal</title>
      <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
</head>

<body>

  <div class="login-page">
  <div class="form">
    <form class="register-form" role="form" method="POST" action="{{ url('/register') }}">
      {{ csrf_field() }}
      <input type="text" placeholder="name" name="name" value="{{ old('name') }}" required />
      <input type="hidden" name="role" value="2"/>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

      <input type="password" placeholder="password" name="password" required/>
      @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif

      <input type="email" placeholder="email address" name="email" value="{{ old('email') }}" required/>
      @if ($errors->has('email'))
          <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif
      <button type="submit">create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>

    <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
      <input type="text" placeholder="Email" name="email" required />
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      <input type="password" placeholder="password" name="password" required="" />
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      <button type="submit">login</button>
      <!-- <p class="message">Not registered? <a href="#">Create an account</a></p> -->
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="{{url('assets/js/index.js')}}"></script>

</body>

</html>
