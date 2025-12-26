</main>
<footer class="py-5 text-center text-body-secondary bg-body-tertiary">
    <p>
        Blog template built for
        <a href="https://getbootstrap.com/">Bootstrap</a> by
        <a href="https://x.com/mdo">@mdo</a>.
    </p>
    <p class="mb-0"><a href="#">Back to top</a></p>
</footer>
<script src="{{url('assets/front')}}/dist/js/bootstrap.bundle.min.js" class="astro-vvvwv3sm"></script>
{{ view('front.auth.sign_in') }}
{{ view('front.auth.sign_up') }}

<script>
    document.addEventListener("DOMContentLoaded", function() {

        <?php if (session_has('error_sign_in')): ?>
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
            <?php
            session_forget('error_sign_in');
            ?>
        <?php endif; ?>

        <?php if (session_has('errors')): ?>
            var signUpModal = new bootstrap.Modal(document.getElementById('signUpModal'));
            signUpModal.show();
            <?php
            session_forget('errors');
            session_forget('old');
            ?>
        <?php endif; ?>

    });
</script>
</body>

</html>
@php
end_errors();
@endphp