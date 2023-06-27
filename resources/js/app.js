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

    $('.add-button').click(function (event) {
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

    $('.edit-button').click(function (event) {
        var url = this.getAttribute('data-url');
        var value = this.getAttribute('data-value');
        var req = this.getAttribute('data-req');
        console.log(req)
        Swal.fire({
            title: 'Edit question',
            html:
                '<input type="text" value = "'+value+'" id="questionText" class="swal2-input m-2" placeholder="New Question Text"><br>' +
                '<label for="isRequired" class="swal2-label">Is Required: </label>' +
                '<input type="checkbox" id="isRequired" class="form-check-input" ' + (req == 1 ? 'checked' : '') + '>',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                return {
                    questionText: document.getElementById('questionText').value,
                    isRequired: document.getElementById('isRequired').checked
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var questionText = result.value.questionText;
                const questionId = this.getAttribute('data-id');
                var isRequired = result.value.isRequired ? 1 : 0;
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: questionId,
                        question_text: questionText,
                        is_required: isRequired
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Question updated',
                            icon: 'success',
                            text: 'Forms App',
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1250);
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            icon: 'error',
                            text: 'Forms App'
                        });
                    }
                });
            }
        });
    });


    $('.edit-button-option').click(function (event) {
        var url = this.getAttribute('data-url');
        var value = this.getAttribute('data-value');
        Swal.fire({
            title: 'Edit question',
            html:
                '<input type="text" value = "'+value+'" id="optionText" class="swal2-input m-2" placeholder="New Option Text"><br>',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                return {
                    optionText: document.getElementById('optionText').value,
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var optionText = result.value.optionText;
                const optionId = this.getAttribute('data-id');
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: optionId,
                        option_text: optionText,
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Option updated',
                            icon: 'success',
                            text: 'Forms App',
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1250);
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            icon: 'error',
                            text: 'Forms App'
                        });
                    }
                });
            }
        });
    });

});


