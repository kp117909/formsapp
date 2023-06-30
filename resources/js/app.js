import './bootstrap';
$(document).ready(function() {

    $('.questionSelect').select2();

    $('.question-modal').on('shown.bs.modal', function() {
        $(this).find('.questionSelect').select2({
            dropdownParent: $(this)
        });
    });

    // $('.question-modal').on('shown.bs.modal', function() {
    //     $('.questionSelect').each(function() {
    //         $(this).select2({
    //             dropdownParent: $(this).closest('.question-modal')
    //         });
    //     });
    // });

    // $('.questionSelect').select2({
    //     dropdownParent: $('.question-modal')
    // });

    $("#mySortableSurvey").sortable({
        axis: "y",
        handle: ".question-container",
        update: function(event, ui) {
            var questionContainers = $(this).find(".question-container");
            questionContainers.each(function(index) {
                $(this).attr("data-question-id", index + 1);
            });
        }
    }).disableSelection();

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

    window.onlyOne = onlyOne

    function onlyOne(checkbox) {
        console.log(checkbox.name)
        console.log(checkbox.id)
        var checkboxes = document.getElementsByName(checkbox.name)
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }

    $('.edit-button-response').click(function (event) {
        var url = this.getAttribute('data-url');
        var value = this.getAttribute('data-value');
        Swal.fire({
            title: 'Edit Response',
            html:
                '<input type="text" value = "'+value+'" id="questionText" class="swal2-input m-2" placeholder="New Response Text"><br>',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                return {
                    questionText: document.getElementById('questionText').value,
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var questionText = result.value.questionText;
                const questionId = this.getAttribute('data-id');
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: questionId,
                        question_text: questionText,
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Response updated',
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

    $('.edit-button-response-select').click(function (event) {
        var url = this.getAttribute('data-url');
        var surveyId = this.getAttribute('data-id');
        var checkboxes = document.getElementsByName('option_text_' + surveyId);
        var selectedOptionId = 'null';
        var selectedOptionText = '';

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedOptionId = checkbox.getAttribute('data-option-id');
                selectedOptionText = checkbox.getAttribute('data-option-text');
            }
        });

        Swal.fire({
            title: 'Confirm your select',
            html:
                '<input required disabled type="text" value="' + selectedOptionText + '" id="questionText" class="swal2-input m-2" placeholder="New Response Text"><br>'+
            '<input hidden disabled type="text" value="' + selectedOptionId + '" id="optionId" class="swal2-input m-2" placeholder="New Response Text"><br>',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                return {
                    selectedOption: document.getElementById('optionId').value,
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var selectedOption = result.value.selectedOption;

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: surveyId,
                        selectedOption: selectedOption,
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Response updated',
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

    $('.send-button-disabledQuestion').click(function () {
        var selectedQuestions = $('.questionSelect').val();
        var url = this.getAttribute('data-url');
        var option_id = this.getAttribute('data-option-id');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                option_id: option_id,
                questions: selectedQuestions
            },
            success: function(response) {
                Swal.fire({
                    title: 'Updated',
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

        $('#questionModal').modal('hide');
    });

    var radioButtons = document.querySelectorAll('input[type="radio"]');
    var previousDisabledInputs = [];

    radioButtons.forEach(function(radioButton) {
        radioButton.addEventListener('click', function() {
            var disabledQuestions = JSON.parse(this.getAttribute('data-disabled-questions'));

            // Usuń stare elementy z atrybutem disabled
            previousDisabledInputs.forEach(function(input) {
                input.disabled = false;
            });

            if (disabledQuestions && Array.isArray(disabledQuestions)) {
                disabledQuestions.forEach(function(disabledQuestion) {
                    var questionId = disabledQuestion.blocked_question_id.toString();
                    var inputs = document.querySelectorAll('input[data-id="' + questionId + '"]');

                    inputs.forEach(function(input) {
                        input.disabled = true;
                    });

                    previousDisabledInputs = inputs;
                });
            }
        });
    });

    document.getElementById('myForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var questions = document.querySelectorAll('[data-is-required="1"]');
        var errorText = document.getElementById('error-text');
        var surveyId = document.getElementById('submit-button').getAttribute('data-survey-id');

        var isFormValid = true;

        questions.forEach(function(question) {
            var questionId = question.getAttribute('data-id');
            console.log(question)
            if (question.type === 'checkbox' || question.type === "radio") {
                var checkboxes = document.querySelectorAll('input[name^="answers[' + questionId + ']"]:checked');
                if (checkboxes.length === 0) {
                    isFormValid = false;
                    question.classList.add('error');
                }
            } else if (question.type === 'text') {
                var questionInput = document.querySelector('input[name="answers[' + questionId + ']"]');
                var inputValue = questionInput.value.trim();
                if (inputValue === '') {
                    isFormValid = false;
                    question.classList.add('error');
                }
            }
        });

        if (!isFormValid) {
            errorText.style.display = 'block';
        } else {
            errorText.style.display = 'none';
            if (canFillSurvey(surveyId)) {
                setCooldown(surveyId, 1 / 96);
                document.getElementById('myForm').submit();
            } else {
                Swal.fire({
                    title: 'The survey has a cooldown, please wait 15 minutes before refilling',
                    icon: 'info',
                    text: 'Forms App',
                    showConfirmButton: false
                });
            }
        }
    });

    function isCooldownActive(surveyId) {
        return Cookies.get(`surveyCooldown_${surveyId}`) === 'true';
    }

    function setCooldown(surveyId, duration) {
        Cookies.set(`surveyCooldown_${surveyId}`, 'true', { expires: duration });
    }

    function canFillSurvey(surveyId) {
        return !isCooldownActive(surveyId);
    }

});



