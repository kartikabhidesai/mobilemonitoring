var Login = function () {
    var genral = function(){
        
        jQuery('#forget-password').click(function () {
            window.location.href = baseurl + 'account/forgetPassword';
        });
        
        jQuery('#back-btn').click(function () {
            window.location.href = baseurl;
        });
    }
    
    var handleLogin = function () {
        $('#login_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
                    email: true,
                    required: true,
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit 
                $('.alert-danger').children('span').html('Enter valid email address and password.');
                $('.alert-danger', $('.login-form')).show();
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },
            submitHandler: function (form) {
                var username = $("#user").val();
                var password = $("#pass").val();
                var remember = $('#remember').is(':checked');
                var data = $(form).serialize();
                $.ajax({
                    type: "post",
                    url: baseurl + "account/login",
                    data: {email: username, password: password, remember: remember},
                    success: function (response) {
                        var response = JSON.parse(response);
                        
                        if (response.status == 'success')
                        {
                            $('.alert-danger', $('.login-form')).hide();
                            $('.alert-success').children('span').html(response.message);
                            $('.alert-success', $('.login-form')).show();
                            window.location.href = response.redirect;
                        }

                        else if (response.status == 'error')
                        {
                            $('.alert-danger').children('span').html(response.message);
                            $('.alert-danger', $('.login-form')).show();
                            $('.alert-success', $('.login-form')).hide();
                        }
                        else if (response.status == 'warning')
                        {
                            $('.alert-danger').children('span').html(response.message);
                            $('.alert-danger', $('.login-form')).show();
                            $('.alert-success', $('.login-form')).hide();
                        }
                    }
                });
            }
        });
        
        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit();
                }
                return false;
            }
        });
    }
   
    var handleRegistration = function(){
        $('#registration_form').validate({
        rules: {
            name: { required: true },
            email: { required: true , email: true},
            password: { required: true , minlength: 6},
            rpassword: { required: true, minlength: 6, equalTo: "#register_password"},
            phone : { required: true,number:true ,minlength: 10},
            company_name : { required: true,},
            url : { required: true,url:true},
            total_users : { required: true,number:true},
        },
        messages: {
            name: { required: "please enter full name" },
            email: { required: "please enter email" ,email : "please enter valid email address"},
            password: { required: "please enter password" , minlength : "please enter atleast 6 character"},
            rpassword: { required: "please enter password" , minlength : "password length must be greater then 6", equalTo : 'password does not match'},
            phone: { required: "please enter phone number" , minlength : "phone number be greater then 10", number : 'please enter valid phone number'},
            company_name : { required: "please enter company name"},
            url : { required: "please enter url",url:"please enter valid url"},
            total_users : { required: "please enter number of users",number:"please enter only number"},
        },
        error: function(label) {
            $(this).addClass("error");
        }
    });
    }
    
     var handleForgetPassword = function(){
        $('#forgotPass').validate({
            rules: {
                email: {required: true, email: true},
            },
            messages: {
                email: {required: "please enter email", email: "please enter valid email address"},
            },
            error: function(label) {
                $(this).addClass("error");
            }
        });
    }
    var handleresetPass = function(){
        $('#resetPass').validate({
            rules: {
                password: {required: true, minlength: 6},
                rpassword: {required: true, minlength: 6, equalTo: "#resetpassword"},
            },
            messages: {
                password: {required: "please enter password", minlength: "please enter atleast 6 character"},
                rpassword: {required: "please enter password", minlength: "password length must be greater then 6", equalTo: 'password does not match'},
            },
            error: function(label) {
                $(this).addClass("error");
            }
        });
    }
    return {
        //main function to initiate the module
        init: function () {
            genral();
            handleLogin();
            handleForgetPassword();
        },
        registration : function (){
            genral();
            handleRegistration();
        },
        resetPass: function (){
            handleresetPass();
        }
    };
} ();