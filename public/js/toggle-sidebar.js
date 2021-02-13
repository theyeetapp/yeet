$(document).ready(() => {

    const sidebar = $('.sidebar');
    const navToggle = $('.nav-toggle');
    const blocker = $('.blocker');

    navToggle.click(() => {
        sidebarToggle();
    });

    blocker.click(() => {
        sidebar.removeClass('active');
        blocker.removeClass('active');
    });

    const sidebarToggle = () => {
        if(!sidebar.hasClass('active')) {
            sidebar.addClass('active');
            blocker.addClass('active');
        }
        else {
            sidebar.removeClass('active');
            blocker.removeClass('active');
        }
    }
});