</main>
<footer class="py-5 text-center text-body-secondary bg-body-tertiary">
    <p>
        Blog template built for
        <a href="https://getbootstrap.com/">Bootstrap</a> by
        <a href="https://x.com/mdo">@mdo</a>.
    </p>
    <p class="mb-0"><a href="#">Back to top</a></p>
</footer>
<script
    src="{{url('assets/front')}}/dist/js/bootstrap.bundle.min.js"
    class="astro-vvvwv3sm"></script>
{{ view('front.auth.sign_in') }}
{{ view('front.auth.sign_up') }}

<?php if (session_has('error_login')): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    new bootstrap.Modal(document.getElementById('loginModal')).show();
});
</script>
<?php session_flash('error_login'); endif; ?>

<?php if (session_has('error_signup')): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    new bootstrap.Modal(document.getElementById('signUpModal')).show();
});
</script>
<?php session_flash('error_signup'); endif; ?>


</body>

</html>