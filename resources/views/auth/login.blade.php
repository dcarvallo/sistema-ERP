
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
  <div class="row align-items-center justify-content-center vh-100 bg-secondary">
    <div class="col-md-6 d-flex justify-content-center align-items-center bg-dark vh-100">
      <a href="#login">  
        <div>
          <h1 class="text-white"> Sistema ERP </h1>
        </div>
      </a>
    </div>
    <div class="col-md-6 d-flex justify-content-center align-items-center  vh-100" id="login">
          <div class="card w-75">
            <div class="card-header">{{ __('Login') }}</div>     
            <div class="card-body">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group row">
                  <label for="username" class="col-md-4 col-form-label text-md-right">Nombre de usuario</label>
                  
                  <div class="col-md-6">
                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Login') }}
                  </button>
                </div>
              </div>
              </form>
            </div>
          </div>
    </div>
    
  </div>
</body>
</html>
