<!-- Place this in the head of the site you want to use recaptcha in -->
<?php define("SITE_KEY", "6Lc-eW4aAAAAACd-DCdtjciuLNOVZqSKOj0r1ArI"); ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= SITE_KEY ?>"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('<?= SITE_KEY?>', {action: 'contact'}).then(function (token) {
            const recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>