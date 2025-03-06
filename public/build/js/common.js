function showPreload(){
    $('.preload').show();
    $('.form-control').removeClass('is-invalid');
    $('.error.invalid-feedback').remove();
}

function hidePreload() {
    $('.preload').hide();
}
function showErrorValidate(error) {
    if(typeof error.responseJSON !== "undefined" && typeof error.responseJSON.errors !== "undefined"){
        console.log(1);
        $.each(error.responseJSON.errors, function(key, value){
            if(key.includes('.')){
                key = key.replace(/(.*)\.(.*)/, function(match, p1, p2) {
                    return p1 + "[" + p2 + "]";
                });
            }
            console.log(key);
            let errorField = $('[name="'+key+'"]');
            if(errorField.length){
                errorField.addClass('is-invalid').parent().append('<span class="error invalid-feedback">'+value[0]+'</span>');
            }
        });


    }else if(error.status == 403 && error.responseJSON.message){
        location.reload();
    }
    else{
    }
}
function showErrorMessage(message) {
    toastr.error(message);
}

function showSuccessMessage(message) {
    toastr.success(message);
}
