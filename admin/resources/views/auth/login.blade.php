<x-guest-layout>
   <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-8 mx-auto login-form">
              <div class="card-body login-container">
                <img class="login-image" src="{{ asset('assets/images/auth/login_image.jpg') }}" alt="EzKafe Image">
                <div class="login-content">
                  <h3 class="card-title text-left my-0">Welcome,</h3>
                  <h4 class="card-subtitle text-left mt-0 mb-3">Please login your account</h4>
                  <x-jet-validation-errors class="mb-4" />
                  <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="form-group">
                      <label>Email or Username</label>
                      <input type="text" class="form-control p_input"name="loginname" placeholder="Enter your email or username" :value="old('loginname')" required autofocus>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control p_input" name="password" placeholder="Enter your password" required autocomplete="current-password">
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="remember" value="forever"> Remember me </label>
                      </div>
                      <a href="{{route('password.request')}}" class="forgot-pass">Forgot password</a>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-block enter-btn">Login</button>
                    </div>
                    <!-- <p class="sign-up">Don't have an Account?<a href="{{route('register')}}"> Sign Up</a></p> -->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-guest-layout>
