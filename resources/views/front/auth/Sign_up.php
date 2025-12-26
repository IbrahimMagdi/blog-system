<div class="modal fade" id="signUpModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white rounded-4">

      <div class="modal-body p-5 text-center position-relative">

        <button type="button"
          class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
          data-bs-dismiss="modal"></button>

        <h2 class="fw-bold mb-2 text-uppercase">{{ trans('main.sign_up') }}</h2>
        <p class="text-white-50 mb-4">{{ trans('user.new_account') }}</p>




        @if(any_errors())
        <div class='alert alert-danger text-start' id="signupError">
          <ol>
            @foreach(all_errors() as $error)
            <li><?php echo $error; ?></li>
            @endforeach
          </ol>
        </div>
        @endif
        <form id="signUpForm" method="post" action="{{ url('sign-up') }}">
          <input type="hidden" name="_method" value="post" />

          <input type="text" name="name" class="form-control form-control-lg mb-3"
            value="{{ old('name') }}"
            placeholder="{{ trans('user.name') }}" required>

          <input type="email" name="email" class="form-control form-control-lg mb-3"
            value="{{ old('email') }}"
            placeholder="{{ trans('user.email') }}" required>

          <input type="tel" name="mobile" class="form-control form-control-lg mb-3"
            value="{{ old('mobile') }}"
            placeholder="{{ trans('user.mobile') }}" pattern="[0-9+]{6,15}" required>

          <input id="signup-password" type="password" name="password"
            class="form-control form-control-lg mb-3" placeholder="{{ trans('user.password') }}" required>

          <button id="signup-submit" type="submit" class="btn btn-outline-light btn-lg w-100">
            {{ trans('main.sign_up') }}
          </button>
        </form>

        <p class="mt-4 mb-0">{{trans('user.have_account')}}<a href="#" class="text-info fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">{{ trans('main.sign_in') }}</a>
        </p>

      </div>
    </div>
  </div>
</div>