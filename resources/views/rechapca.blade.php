<script src="https://www.google.com/recaptcha/api.js?render={{ $token }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute("{{ $token }}", {
            action: 'submit'
        }).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script>
