$(document).ready(() => {
    const passwordInput = $(".email");
    const mailLink = $(".mail-link");
    const initialHref = mailLink.attr("href");

    passwordInput.keyup(() => {
        const value = passwordInput.val();
        const newHref = initialHref + "?email=" + value;
        mailLink.attr("href", newHref);
    });

    mailLink.click((e) => {
        const re =
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!re.test(passwordInput.val())) {
            toastr.error("Enter a valid email");
            e.preventDefault();
            return;
        }
    });
});
