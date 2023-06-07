var Script = function () {
/*
    $.validator.setDefaults({
        submitHandler: function() { alert("submitted!"); }
    });
*/
    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#new_page").validate({
            rules: {
                page_title: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                content: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                page_title: {
                    required: "Please enter Page Title",
                    minlength: "Page Title must consist of at least 3 characters",
                    maxlength: "Page Title max length is 255 characters"
                },
                content: {
                    required: "Please enter your page content",
                    minlength: "Your page content must consist of at least 10 characters"
                }
            }
        });
        
        
       //$("#adminLogin").validate();

        // validate signup form on keyup and submit
        $("#adminLogin").validate({
            rules: {
                email_login: {
                    required: true,
                    email: true,
                    maxlength: 255
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email_login: {
                    required: "Email adress is required",
                    email: "Please enter the Valid Email adress",
                    maxlength: "Email ID max length is 255 characters"
                },
                password: {
                    required: "Please enter your Password",
                    minlength: "Your Password must consist of at least 6 characters"
                }
            }
        });

        
        


        // validate signup form on keyup and submit
        $("#user_registration").validate({
            rules: {
                first_name: { 
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                last_name: {
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                user_name: {
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 32
                },
                conf_password: {
                    required: true,
                    minlength: 6,
                    maxlength: 32,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                }
//                topic: {
//                    required: "#newsletter:checked",
//                    minlength: 2
//                },
//                agree: "required"
            },
            messages: {
                first_name: {
                    required: "Please enter first name",
                    minlength: "Your first name must consist of at least 5 characters",
                    maxlength: "Your first name should not be more than 35 characters"
                },
                last_name: {
                    required: "Please enter last name",
                    minlength: "Your last name must consist of at least 5 characters",
                    maxlength: "Your last name should not be more than 35 characters"
                },
                user_name: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 5 characters",
                    maxlength: "Your username should not be more than 35 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                conf_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address"
            }
        });
        
        // validate edit profile form on keyup and submit
        $("#edit_profile").validate({
            rules: {
                first_name: { 
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                last_name: {
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                user_name: {
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                password: {
                    minlength: 6,
                    maxlength: 32
                },
                password_confirm: {
                    minlength: 6,
                    maxlength: 32,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                gender:{
                    required:true                    
                },
                dob:{
                    required:true
                },
                zip_code:{
                    required:true
                },
                feet:{
                    required:true
                },
                inches:{
                    required:true
                }
                
//                topic: {
//                    required: "#newsletter:checked",
//                    minlength: 2
//                },
//                agree: "required"
            },
            messages: {
                first_name: {
                    required: "Please enter first name",
                    minlength: "Your first name must consist of at least 5 characters",
                    maxlength: "Your first name should not be more than 35 characters"
                },
                last_name: {
                    required: "Please enter last name",
                    minlength: "Your last name must consist of at least 5 characters",
                    maxlength: "Your last name should not be more than 35 characters"
                },
                user_name: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 5 characters",
                    maxlength: "Your username should not be more than 35 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                password_confirm: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email:{
                    required: "Please enter a valid email address"
                },
                gender:{
                    required: "Please select the gender"
                },
                dob:{
                    required: "Please select the Date of birth"
                },
                zip_code:{
                    required:"Please enter the Zip/Postal code"
                },
                feet:{
                    required:"Please select the Feet"
                },
                inches:{
                    required:"Please select the Inches"
                }
                
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });


       // Forgot Password Validation
        $("#forgotPassword").validate({
            rules: {
                pass: {
                    required: true,
                    minlength:6,
                    maxlength: 255
                },
                conf_pass: {
                    required: true,
                    minlength: 6,
                    equalTo: "#pass",
                    maxlength: 255
                }
            },
            messages: {
                pass: {
                    required: "Password is required",
                    minlength: "Make sure password length grater then 6 character",
                    maxlength: "Password max length is 255 characters"
                },
                conf_pass: {
                    required: "Confirm Password is required",
                    minlength: "Make sure password length grater then 6 character",
                    equalTo: "Please enter the same password as above",
                    maxlength: "Password max length is 255 characters"
                    
                }
            }
        });



        // Change Password Validation
        $("#change_password").validate({
            rules: {
                old_password: {
                    required: true,
                    maxlength: 255
                },
                new_password: {
                    required: true,
                    minlength: 6,
                    maxlength: 255
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#new_password",
                    maxlength: 255
                }
            },
            messages: {
                old_password: {
                    required: "Old password is required",
                    maxlength: "Password max length is 255 characters"
                },
                new_password:{
                    required: "New Password is required",
                    minlength: "Make sure password length grater then 6 character",
                    maxlength: "Password max length is 255 characters"  
                },
                confirm_password: {
                    required: "Confirm Password is required",
                    minlength: "Make sure password length grater then 6 character",
                    equalTo: "Please enter the same password as above",
                    maxlength: "Password max length is 255 characters"                    
                }
            }
        });

//======add events form start====
$("#add_admin_events").validate({
            rules: {
                event_title: { 
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                event_type: {
                    required: true,
                    //minlength: 5,
                    //maxlength: 35
                },
                event_location: {
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                event_date: {
                    required: true,
                   
                },
                event_description: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                },
                event_description: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                },
                event_message: {
                    required: true,
                    minlength: 5,
                    maxlength: 100
                }
             },
            messages: {
                event_title: {
                    required: "Please enter event title",
                    minlength: "Your event title must consist of at least 5 characters",
                    maxlength: "Your event title should not be more than 35 characters"
                },
                event_type: {
                    required: "Please select event type",
                    //minlength: "Your last name must consist of at least 5 characters",
                    //maxlength: "Your last name should not be more than 35 characters"
                },
                event_location: {
                    required: "Please enter event location",
                    minlength: "Your event location must consist of at least 5 characters",
                    maxlength: "Your event location should not be more than 35 characters"
                },
                event_date: {
                    required: "Please enter event location",
                   
                },
                event_description: {
                    required: "Please type your event description",
                    minlength: "Your event description must consist of at least 5 characters",
                    maxlength: "Your event description should not be more than 100 characters"
                },
                event_message: {
                    required: "Please type your event message",
                    minlength: "Your event message must consist of at least 5 characters",
                    maxlength: "Your event message should not be more than 100 characters"
                }
                
                
            }
        });

//=====add events form end=======
//======edit events form start====
$("#edit_admin_event").validate({
            rules: {
                event_title: { 
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                event_type: {
                    required: true,
                    //minlength: 5,
                    //maxlength: 35
                },
                event_location: {
                    required: true,
                    minlength: 5,
                    maxlength: 35
                },
                event_date: {
                    required: true,
                   
                },
                event_description: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                },
                event_description: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                },
                event_message: {
                    required: true,
                    minlength: 5,
                    maxlength: 100
                }
             },
            messages: {
                event_title: {
                    required: "Please enter event title",
                    minlength: "Your event title must consist of at least 5 characters",
                    maxlength: "Your event title should not be more than 35 characters"
                },
                event_type: {
                    required: "Please select event type",
                    //minlength: "Your last name must consist of at least 5 characters",
                    //maxlength: "Your last name should not be more than 35 characters"
                },
                event_location: {
                    required: "Please enter event location",
                    minlength: "Your event location must consist of at least 5 characters",
                    maxlength: "Your event location should not be more than 35 characters"
                },
                event_date: {
                    required: "Please enter event location",
                   
                },
                event_description: {
                    required: "Please type your event description",
                    minlength: "Your event description must consist of at least 5 characters",
                    maxlength: "Your event description should not be more than 100 characters"
                },
                event_message: {
                    required: "Please type your event message",
                    minlength: "Your event message must consist of at least 5 characters",
                    maxlength: "Your event message should not be more than 100 characters"
                }
                
                
            }
        });

//=====edit events form end=======


        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();