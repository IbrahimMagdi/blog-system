<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white rounded-4">

      <div class="modal-body p-5 text-center position-relative">

        <button type="button"
          class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
          data-bs-dismiss="modal"></button>

        <h2 class="fw-bold mb-2 text-uppercase">{{ trans('main.sign_in') }}</h2>
        <p class="text-white-50 mb-4">{{ trans('user.sign_in') }}</p>

        @if(session_has('error_sign_in'))
        <div class='alert alert-danger text-start' id="signinError">
          {{ session('error_sign_in') }}
        </div>
        @endif

        <form method="post" action="{{ url('sign-in') }}">
          <input type="hidden" name="_method" value="post" />
          <input type="email" name="email" class="form-control form-control-lg mb-3 {{!empty(get_error('email'))?'is-invalid': ''}}"  placeholder="{{ trans('user.email') }}" value="{{ old('email') }}" required>
          <input type="password" name="password" class="form-control form-control-lg mb-3 {{!empty(get_error('password'))?'is-invalid': ''}}" placeholder="{{ trans('user.password') }}" required>

          <button class="btn btn-outline-light btn-lg w-100">{{ trans('main.sign_in') }}</button>
        </form>

        <p class="mt-4 mb-0"> {{ trans('user.dont_have_account') }} <a href="#" class="text-info fw-bold" data-bs-toggle="modal" data-bs-target="#signUpModal">{{ trans('main.sign_up') }}</a> </p>

      </div>
    </div>
  </div>
</div>