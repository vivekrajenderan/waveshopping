/*
 * Created by css on 7/3/14.
 */


(function () {

    "use strict";

    var Register = {

        initialized: false,

        initialize: function () {

            if (this.initialized) return;
            this.initialized = true;

            this.build();
            this.events();

        },

        build: function () {

            // Containers
            var registerForm = $("#registerForm");

            // Validations Form Type
            if (registerForm.get(0)) {

                if (registerForm.data("type") == "advanced") {
                    this.advancedValidations();
                } else {
                    this.basicValidations();
                }

            }

        },

        events: function () {


        },

        basicValidations: function () {

            var registerForm = $("#registerForm"),
                url = registerForm.attr("action");

                     $.validator.addMethod("regex",function(value,element,regexp){
                    var re= new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },"Only Characters from A-z");

            registerForm.validate({
                submitHandler: function (form) {

                    // Loading State
                    var submitButton = $(this.submitButton);
                    submitButton.button("loading");

                    // Ajax Submit
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            "firstname": $("#firstname").val(),
                            "lastname": $("#lastname").val(),
                            "email": $("#email").val(),
                            "password": $("#password").val(),
                            "phoneno": $("#phoneno").val(),
                            "gender": $("#gender").val(),
                            "date": $("#date").val(),
                            "month": $("#month").val(),
                            "year": $("#year").val(),
                            "hometown": $("#hometown").val(),
                            "school_name": $("#school_name").val(),
                            "university_name": $("#university_name").val(),
                            "employed": $("#employed").val(),
                        },
                        dataType: "json",
                        success: function (data) {
                           
                            if (data.response == "success") {

                                $("#registerSuccess").removeClass("hidden");
                                $("#registerError").addClass("hidden");

                                // Reset Form
                                $("#registerForm .form-control")
                                    .val("")
                                    .blur()
                                    .parent()
                                    .removeClass("has-success")
                                    .removeClass("has-error")
                                    .find("label.error")
                                    .remove();

                                if (($("#registerSuccess").position().top - 80) < $(window).scrollTop()) {
                                    $("html, body").animate({
                                        scrollTop: $("#registerSuccess").offset().top - 80
                                    }, 300);
                                }

                            } else {

                                $("#registerError").removeClass("hidden");
                                $("#registerError").html(data.msg);
                                $("#registerSuccess").addClass("hidden");

                                if (($("#registerError").position().top - 80) < $(window).scrollTop()) {
                                    $("html, body").animate({
                                        scrollTop: $("#registerError").offset().top - 80
                                    }, 300);
                                }

                            }
                        },
                        complete: function () {
                            submitButton.button("reset");
                        }
                    });
                },
                rules: {
                    firstname: {
                        required: true,
                        minlength: 3,
                        maxlength:30,
                        regex:"^[a-zA-Z]+$"
                    },
                    lastname: {
                        required: true,
                        minlength: 3,
                        maxlength:30,
                        regex:"^[a-zA-Z]+$"
                    },
                    email: {
                        required: true,
                        minlength: 3,
                        maxlength:30,
                        email: true
                    },                    
                    password: {
                        required: true,
                        minlength: 4,
                        maxlength:30                        
                    },
                    phoneno: {
                        required: true,
                        digits:true,
                        minlength: 10,
                        maxlength:10                        
                    },
                    gender: {
                        required: true                                              
                    },
                    date: {
                        required: true                                              
                    },
                    month: {
                        required: true                                              
                    },
                    year: {
                        required: true                                              
                    },
                    hometown: {
                        required: true,
                        minlength: 3,
                        maxlength:30                                              
                    }


                },
                messages:
                    {
                        firstname:
                        {
                            required: 'Please enter first name'
                           
                        },
                        lastname:
                        {
                            required: 'Please enter last name'
                           
                        },
                        email:
                        {
                            required: 'Please enter email'
                           
                        },
                        password:
                        {
                            required: 'Please enter password'
                           
                        },
                        phoneno:
                        {
                            required: 'Please enter phone number'
                           
                        },
                        gender:
                        {
                            required: 'Please select gender'
                           
                        },
                        date:
                        {
                            required: 'Please select date'
                           
                        },
                        month:
                        {
                            required: 'Please select month'
                           
                        },
                        year:
                        {
                            required: 'Please select year'
                           
                        },
                         hometown:
                        {
                            required: 'Please enter home town'
                           
                        }


                        

                    },
                highlight: function (element) {
                    $(element)
                        .parent()
                        .removeClass("has-success")
                        .addClass("has-error");
                },
                success: function (element) {
                    $(element)
                        .parent()
                        .removeClass("has-error")
                        .addClass("has-success")
                        .find("label.error")
                        .remove();
                }
            });

        }

    };

    Register.initialize();

})();
