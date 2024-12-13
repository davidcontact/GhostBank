<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Create</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <style>
        body{
          background-color: #ffcc99;
        }
      </style>
  </head>
  <body>
    <!-- Page content-->
    <div class="d-flex justify-content-center mt-5">
        <div class="card p-3 w-25">
        <h3>Register</h3>
        <form method="POST" action="{{ route('Store_User')}} " enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">
                    Name
                </label>
                <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    Email 
                </label>
                <input type="text" placeholder="Email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">
                    Phone Number
                </label>
                <input id="phone" type="tel"
                    placeholder="Ex:01234567" 
                    class="form-control @error('phone') is-invalid @enderror" 
                    name="phone" 
                >
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    Password
                </label>
                <input id="password" type="password" 
                    placeholder="Password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" 
                >
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="mb-3">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
        
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

