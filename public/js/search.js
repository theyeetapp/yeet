"use strict";

$(document).ready(() => {
    const searchForm = $('.search-form');
    const searchInput = $('.input-search');
    const searchRoute = searchForm.attr('action');

    searchInput.keyup(() => {
        const newSearchRoute = searchRoute + '?symbol=' + searchInput.val();
        searchForm.attr('action', newSearchRoute);
    });

    searchForm.submit(e => {
        if(searchInput.val().length < 2) {
            e.preventDefault();
            toastr.error('minimum 2 search characters required');
        }
    })
});