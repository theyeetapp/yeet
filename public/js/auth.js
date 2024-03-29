$(document).ready(() => {
    const path = window.location.pathname;
    const form = $("form");
    const name = form.find(".name");
    const email = form.find(".email");
    const password = form.find(".password");

    form.submit((e) => {
        if (validateName() * validateEmail() * validatePassword()) {
        } else {
            e.preventDefault();
        }
    });

    const validateName = () => {
        $(".error-name").remove();

        if (path === "/login" || path.startsWith("/password/change")) {
            return true;
        }

        if (name.val().length === 0 || name.val().split(" ").length < 2) {
            name.after(
                '<p class="m-0 mt-2 text-red text-sm error-name">Full name is required</p>'
            );
            return false;
        }

        return true;
    };

    const validateEmail = () => {
        if (path.startsWith("/password/change")) {
            return true;
        }

        $(".error-email").remove();

        const re =
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!re.test(email.val())) {
            email.after(
                '<p class="m-0 mt-2 text-red text-sm error-email">Enter a valid email</p>'
            );
            return false;
        }

        return true;
    };

    const validatePassword = () => {
        $(".error-password").remove();

        if (password.val().length < 8) {
            password.after(
                '<p class="m-0 mt-2 text-red text-sm error-password">At least 8 characters are required</p>'
            );
            return false;
        }

        return true;
    };
});
