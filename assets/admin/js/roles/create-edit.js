'use strict';

$(document).ready(function() {

// submitting form after validation
$('#AddRoleForm').validator().on('submit', function (e)
{
    if (!e.isDefaultPrevented()) {
            
        KTApp.blockPage({
            overlayColor: '#000000',
            state: 'danger',
            message: 'Please wait...'
           });

        const $this = $(this);
        const action = $this.attr('action');
        const formData = new FormData($this[0]);

        axios.post(action, formData)
            .then(function (response) {
                const resp = response.data;

                if (resp.status == 'success') {
                    $this[0].reset();
                    toastr.success(resp.msg);
                    KTApp.unblockPage();
                    setTimeout(function () {
                        window.location.href = resp.url;
                    }, 2000)
                }

                if (resp.status == 'error') {
                    // $('.page-content').LoadingOverlay("hide");
                    toastr.error(resp.msg);
                    KTApp.unblockPage();
                    const errorBag = resp.errors;

                    $.each(errorBag, function (fieldName, value) {
                        $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                        $('.err_' + fieldName).text(value[0]).closest('span').show();
                    })
                }
            })
            .catch(function (error) {
                KTApp.unblockPage();
                // $('.page-content').LoadingOverlay("hide");
                const errorBag = error.response.data.errors;
                $.each(errorBag, function (fieldName, value) {
                    $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                    $('.err_' + fieldName).text(value[0]).closest('span').show();
                })
            });
            
    }
    return false;
})

// submitting form after validation
$('#EditRoleForm').validator().on('submit', function (e)
{
    if (!e.isDefaultPrevented()) {
       
        KTApp.blockPage({
            overlayColor: '#000000',
            state: 'danger',
            message: 'Please wait...'
        });

        const $this = $(this);
        const action = $this.attr('action');
        const formData = new FormData($this[0]);
 
        axios.post(action, formData)
            .then(function (response) {
                const resp = response.data;

                if (resp.status == 'success') {
                    KTApp.unblockPage();
                    $this[0].reset();
                    toastr.success(resp.msg);
                    // $('.card-body').LoadingOverlay("hide");
                    setTimeout(function () {
                        window.location.href = resp.url;
                    }, 2000)
                }

                if (resp.status == 'error') {
                    toastr.error(resp.msg);
                    KTApp.unblockPage();
                    const errorBag = resp.errors;

                    $.each(errorBag, function (fieldName, value) {
                        $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                        $('.err_' + fieldName).text(value[0]).closest('span').show();
                    })
                }
            })
            .catch(function (error) {
                // $('.card-body').LoadingOverlay("hide");
                KTApp.unblockPage();
                const errorBag = error.response.data.errors;

                $.each(errorBag, function (fieldName, value) {
                    $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                    $('.err_' + fieldName).text(value[0]).closest('span').show();
                })
            });
   
        return false;
    }
})
});





