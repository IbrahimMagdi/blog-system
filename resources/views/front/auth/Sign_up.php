<!-- Sign Up Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white rounded-4">

      <div class="modal-body p-5 text-center position-relative">

        <button type="button"
                class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                data-bs-dismiss="modal"></button>

        <h2 class="fw-bold mb-2 text-uppercase">{{ trans('main.sign_up') }}</h2>
        <p class="text-white-50 mb-4">Create a new account</p>

        <!-- عرض رسالة الخطأ (من السيشن) -->
        <?php if (session_has('error_signup')): ?>
          <div class="alert alert-danger text-start">
            <?= session('error_signup') ?>
          </div>
        <?php endif; ?>

        <form id="signUpForm" method="post" action="{{ url('sign-up') }}">
          <input type="hidden" name="_method" value="post" />

          <input type="text" name="name" class="form-control form-control-lg mb-3"
                 placeholder="{{ trans('user.name') }}" required>

          <input type="email" name="email" class="form-control form-control-lg mb-3"
                 placeholder="{{ trans('user.email') }}" required>

          <input type="tel" name="mobile" class="form-control form-control-lg mb-3"
                 placeholder="{{ trans('user.mobile') }}" pattern="[0-9+]{6,15}" required>

          <input id="signup-password" type="password" name="password"
                 class="form-control form-control-lg mb-3" placeholder="{{ trans('user.password') }}" required>

          <input id="signup-password-confirm" type="password" name="password_confirmation"
                 class="form-control form-control-lg mb-3" placeholder="{{ trans('user.password_confirmation') }}" required>

          <div id="signup-password-error" class="text-danger small mb-2 d-none"></div>

          <button id="signup-submit" type="submit" class="btn btn-outline-light btn-lg w-100">
            {{ trans('main.sign_up') }}
          </button>
        </form>

        <p class="mt-4 mb-0">
          Already have an account?
          <a href="#" class="text-info fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
        </p>

      </div>
    </div>
  </div>
</div>
