
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema ERP</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body  class="row align-items-center justify-content-center bg-secondary">
  {{-- <div> --}}
    <div class="col-md-6 d-flex justify-content-center align-items-center bg-dark min-vh-100">
      <a href="#login">  
        <div>
          <h1 class="text-white"> Sistema ERP </h1>
        </div>
      </a>
    </div>
    <div class="col-md-6 d-flex justify-content-center align-items-center min-vh-100" id="login">
          <div class="card w-75">
            <div class="card-header text-center">Inicio de sesión</div>     
            <div class="card-body">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group row">
                  <label for="username" class="col-md-5 col-form-label">Nombre de usuario</label>
                  
                  <div class="col-md-7">
                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    
                    @error('username')
                      <span class="invalid-feedback pb-0 mb-0" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    @error('active')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-5 col-form-label">{{ __('Password') }}</label>
                
                <div class="col-md-7">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  
                </div>
              </div>

              

              <div class="form-group text-right mb-0">
                  <button type="submit" class="btn btn-primary">
                      Ingresar
                  </button>
              </div>
              </form>
            </div>
          </div>
    </div>
    
  {{-- </div> --}}
</body>
</html>
