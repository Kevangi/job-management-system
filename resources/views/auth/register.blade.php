<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Section: Design Block -->
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
          background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
          height: 300px;
          "></div>
    <!-- Background image -->
  
    <div class="card mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
          margin-top: -100px;
          backdrop-filter: blur(30px);
          ">
      <div class="card-body py-5 px-md-5">
  
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <h2 class="fw-bold mb-5">Register now</h2>
            <form action="{{route('register')}}" method="POST">
                @csrf  
              <!-- Name input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="name" name="name" class="form-control" />
                <label class="form-label" for="name">Name</label>
              </div>
              @error('name')
                  <div class="text-danger">{{$message}}</div>
              @enderror

              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control" />
                <label class="form-label" for="email">Email address</label>
              </div>
              @error('email')
                  <div class="text-danger">{{$message}}</div>
              @enderror

              <div class="row">
                <div class="col-md-6 mb-4">
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline">
                        <input type="password" name="password" id="password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                    </div>
                </div>
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror

                <div class="col-md-6 mb-4">
                    <!-- Password Confirmation input -->
                    <div data-mdb-input-init class="form-outline">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                    </div>
                </div>
              </div>

              <select class="form-select" name="role" aria-label="Default select example">
                <option value="jobSeeker" selected>Find a Job</option>
                <option value="employer">Hire a Candidate</option>
              </select>
              <label class="form-label" for="form3Example4">Purpose</label>
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
  
              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" name="remember" value="" id="remember" />
                <label class="form-check-label" for="remember">
                  Remember Me
                </label>
              </div>
  
              <!-- Submit button -->
              <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Register
              </button>
  
            </form>
          </div>
        </div>
        Already Registered? 
        <a href="{{route('login-form')}}">Login</a> Here
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>