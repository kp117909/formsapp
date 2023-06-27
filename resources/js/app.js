import './bootstrap';
$(document).ready(function() {

    $('.remove-button').click(function (event) {
        event.preventDefault();
        var id = $(this).data('id');

        var url = $(this).data('url');

        $.ajax({
            url: url,
            method: 'GET',
            data: {
                id: id
            },
            success: function (response) {
                Swal.fire({
                    title: response.message,
                    icon: "success",
                    text: "Forms App",
                    showConfirmButton: false
                })
                setTimeout(function () {
                    location.reload();
                }, 1250);
            },
            error: function (xhr) {
                Swal.fire({
                    title: xhr.responseJSON.message,
                    icon: "error",
                    text: "Forms App",
                    showConfirmButton: false
                })
            }
        });
    });

    document.getElementById('addButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Enter option text:',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Add',
            showLoaderOnConfirm: true,
            preConfirm: (text) => {
                const questionId = this.getAttribute('data-id');
                console.log(questionId)
                const url = this.getAttribute('data-url');

                return $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        questionId: questionId, text: text
                    },
                    success: function (response) {
                        setTimeout(function () {
                            location.reload();
                        }, 1250);
                    },
                    error: function (xhr) {
                        Swal.fire({
                            title: xhr.responseJSON.message,
                            icon: "error",
                            text: "Forms App",
                            showConfirmButton: false
                        })
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        })
            .then(result => {
                if (result.value) {
                    Swal.fire({
                        title: result.value.message,
                        icon: 'success',
                        text: 'Forms App',
                        showConfirmButton: false
                    });
                }
            });
    });

});


