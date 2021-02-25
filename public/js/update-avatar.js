"use strict";

$(document).ready(function() {
    
    const avatarFormParent = $('.avatar-form-parent');
    const fileInput = avatarFormParent.find('input');
    const changeAvatar = $('.change-avatar');
    const avatar = $('.avatar');

    changeAvatar.click(() => {
        fileInput.click();
    });

    fileInput.change(e => {
        
        const file = e.target.files[0];

        if(validateFile(file)) {
            const reader = new FileReader();
            reader.onload = e => {
                avatarFormParent.removeClass('hidden');
                avatar.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    const validateFile = file => {

        const allowedTypes = ['jpg', 'png', 'jpeg'];
        const type = file.type.split('/')[1];

        if(!allowedTypes.includes(type)) {
            toastr.error('invalid image format');
            return false;
        }

        if(file.size > 7000000) {
            toastr.error('image is too large');
            return false;
        }

        return true;
    }
});