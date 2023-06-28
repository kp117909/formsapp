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


    $('.survey-edit-button').click(function (event) {
        var url = this.getAttribute('data-url');
        var name = this.getAttribute('data-name');
        var description = this.getAttribute('data-description');
        var slug = this.getAttribute('data-slug');
        var d_public = this.getAttribute('data-public');
        var d_open = this.getAttribute('data-open');
        Swal.fire({
            title: 'Edit Survey',
            html:
                '<input type="text" value = "'+name+'" id="surveyName" class="swal2-input m-2" placeholder="New Name Text"><br>' +
                '<input type="text" value = "'+description+'" id="surveyDescription" class="swal2-input m-2" placeholder="New Description Text"><br>' +
                '<input type="text" value = "'+slug+'" id="surveySlug" class="swal2-input m-2" placeholder="New Slug Text"><br>' +
                '<label for="isRequired" class="swal2-label">Is Public: </label>' +
                '<input type="checkbox" id="isPublic" class="form-check-input" ' + (d_public == 1 ? 'checked' : '') + '>'+
                '<label for="isRequired" class="swal2-label">Is Open: </label>' +
                '<input type="checkbox" id="isOpen" class="form-check-input" ' + (d_open == 1 ? 'checked' : '') + '>',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                return {
                    surveyName: document.getElementById('surveyName').value,
                    surveyDescription: document.getElementById('surveyDescription').value,
                    surveySlug: document.getElementById('surveySlug').value,
                    isPublic: document.getElementById('isPublic').checked,
                    isOpen: document.getElementById('isOpen').checked
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var surveyName = result.value.surveyName;
                var surveyDescription = result.value.surveyDescription;
                var surveySlug = result.value.surveySlug;
                const surveyId = this.getAttribute('data-id');
                var isPublic = result.value.isPublic ? 1 : 0;
                var isOpen = result.value.isOpen ? 1 : 0;
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: surveyId,
                        s_name: surveyName,
                        s_description:surveyDescription,
                        slug: surveySlug,
                        is_public:isPublic,
                        is_open:isOpen,
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Survey updated',
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


    var submitButton = document.getElementById('submit-button');
    var answerInputs = document.querySelectorAll('input[name="answers[]"]');

    submitButton.addEventListener('click', function(event) {
        // Sprawdzanie, czy wszystkie wymagane odpowiedzi zostały dodane
        for (var i = 0; i < answerInputs.length; i++) {
            var input = answerInputs[i];
            var isRequired = input.getAttribute('data-req') === "1";
            var questionType = input.closest('.row').querySelector('[name="question_type"]').value;

            if (isRequired) {
                if (questionType === "text" && !input.value) {
                    event.preventDefault(); // Zablokowanie wysłania formularza
                    alert('To pytanie jest wymagane. Dodaj odpowiedź.'); // Wyświetlenie komunikatu o błędzie
                    return;
                }

                if (questionType === "checkbox" && !isAnyCheckboxChecked(input)) {
                    event.preventDefault(); // Zablokowanie wysłania formularza
                    alert('To pytanie jest wymagane. Wybierz co najmniej jedną opcję.'); // Wyświetlenie komunikatu o błędzie
                    return;
                }

                if (questionType === "radio" && !isAnyRadioChecked(input)) {
                    event.preventDefault(); // Zablokowanie wysłania formularza
                    alert('To pytanie jest wymagane. Wybierz jedną opcję.'); // Wyświetlenie komunikatu o błędzie
                    return;
                }
            }
        }
    });

    function isAnyCheckboxChecked(input) {
        var checkboxes = input.closest('.row').querySelectorAll('input[name="' + input.name + '"]');
        for (var j = 0; j < checkboxes.length; j++) {
            if (checkboxes[j].checked) {
                return true;
            }
        }
        return false;
    }

    function isAnyRadioChecked(input) {
        var radios = input.closest('.row').querySelectorAll('input[name="' + input.name + '"]');
        for (var j = 0; j < radios.length; j++) {
            if (radios[j].checked) {
                return true;
            }
        }
        return false;
    }


});


