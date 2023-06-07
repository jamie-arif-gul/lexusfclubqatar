<div class="container-fluid p0">
    <div class="col-lg-3 col-md-4 col-sm-5 p0 lexus_bg">
        <img src="images/lexus_logo.png">
    </div>
    <div class="col-sm-4"></div>
    <div class="col-lg-4 col-md-5 col-sm-5 p0 abdullah_bg pull-right">
        <img src="images/abdul_logo.png">
    </div>
</div>

<div class="container p0">
    <div class="co-sm-12 footer">
        <p>Copyright &copy; 2018 LEXUS QATAR</p>
    </div>
</div>
<style type="text/css">
    .error{
        clear: inherit;
        color: #ff0000 !important;
        font-size: 14px !important;
        font-weight: bold !important;
        font-family: 'gesslight' !important;
    }
</style>
<!--<script src="js/jquery.js"></script>-->
<!--<script src="js/jquery-3.1.1.js"></script>-->
<script src="js/jquery-1.11.1.js"></script>
<script src="js/slippry.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/thumbnail-slider.js" type="text/javascript"></script>
<!--<script src="notify/bootstrap-notify.js"></script>-->
<!--<script src="notify/bootstrap-notify.min.js"></script>-->
<script src="jquery_external/jquery.validate.js"></script>
<script src="notify/messages_ar.js"></script>
<script>
    $.validator.setDefaults({
        submitHandler: function() {
//            alert("submitted!");
            return true;
        }
    });

    $(document).ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#signupForm_arabic").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
//                last_name: "required",
                last_name: {
                    required: true,
                    minlength: 2
                },
                qid: "required",
                phone: "required",
                vehicle: "required",
                chassis_number: "required",
                registration_number: "required",
                year_of_make: "required",
//                t_shirt_size: "required",
//                username: {
//                    required: true,
//                    minlength: 2
//                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirm: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                email: {
                    required: false,
                    email: true
                }
//                topic: {
//                    required: "#newsletter:checked",
//                    minlength: 2
//                },
//                agree: "required"
            },
            messages: {
//                name: "Please enter your First Name",
//                last_name: "Please enter your Last Name",
//                username: {
//                    required: "Please enter a username",
//                    minlength: "Your username must consist of at least 2 characters"
//                },
//                password: {
//                    required: "Please provide a password",
//                    minlength: "Your password must be at least 6 characters long"
//                },
//                confirm_password: {
//                    required: "Please provide a password",
//                    minlength: "Your password must be at least 6 characters long",
//                    equalTo: "Please enter the same password as above"
//                },
//                email: "Please enter a valid email address",
//                agree: "Please accept our policy",
//                topic: "Please select at least 2 topics"
            }
        });
        $("#booking_form").validate({
            rules:{
                name:{
                    required: true,
                    minlength: 3
                },
                phone_number: "required",
                email:{
                    required: false,
                    email: true
                },
                model: "required",
                drive_date: "required",
                drive_time: "required"
            }
        });
        $("#accessories_form").validate({
            rules:{
                name:{
                    required: true,
                    minlength: 3
                },
                phone_number: "required",
                email:{
                    required: false,
                    email: true
                },
                model: "required",
                chassis_number: "required",
                part_description: "required"
            }
        });

        // propose username by combining first- and lastname
//        $("#username").focus(function() {
//            var firstname = $("#firstname").val();
//            var lastname = $("#lastname").val();
//            if (firstname && lastname && !this.value) {
//                this.value = firstname + "." + lastname;
//            }
//        });

        //code to hide topic selection, disable for demo
//        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
//        var inital = newsletter.is(":checked");
//        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
//        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
//        newsletter.click(function() {
//            topics[this.checked ? "removeClass" : "addClass"]("gray");
//            topicInputs.attr("disabled", !this.checked);
//        });
//        function showNotification(){

//        }
//        test('aksdlf');

<!--        --><?php //if(isset($error))?>
//        test('<?php //echo $error ?>//');
//            test('abcsdf');
//        test('dsd');
    });
</script>
<script type="text/javascript">
    function test(type,msg){
        $.notify({
            // options
//                icon: 'glyphicon glyphicon-remove',
//                title: 'Bootstrap notify',
//                message: 'Turning standard Bootstrap alerts into "notify" like notifications'
            message: msg
//                url: 'https://github.com/mouse0270/bootstrap-notify'
//                target: '_blank'
        },{
            // settings
            element: 'body',
            position: null,
            type: type,
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "top",
                align: "center"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
//                url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">�</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
    }
    $(".mouse").click(function(){
        scroll();
    });
    $(".m_scroll_arrows").click(function(){
        scroll();
    });
    function scroll(){
        $('html, body').animate({
            scrollTop: $("#registration_form").offset().top
        }, 1000);
    }
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118671243-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-118671243-1');
</script>
<script>
    //Note: this script should be placed at the bottom of the page, or after the slider markup. It cannot be placed in the head section of the page.
    var thumbs1 = document.getElementById("thumbnail-slider");
    var thumbs2 = document.getElementById("thumbs2");
    var closeBtn = document.getElementById("closeBtn");
    var slides = thumbs1.getElementsByTagName("li");
    for (var i = 0; i < slides.length; i++) {
        slides[i].index = i;
        slides[i].onclick = function(e) {
            var li = this;
            var clickedEnlargeBtn = false;
            if (e.offsetX > 220 && e.offsetY < 25) clickedEnlargeBtn = true;
            if (li.className.indexOf("active") != -1 || clickedEnlargeBtn) {
                thumbs2.style.display = "block";
                mcThumbs2.init(li.index);
            }
        };
    }

    thumbs2.onclick = closeBtn.onclick = function(e) {
        //This event will be triggered only when clicking the area outside the thumbs or clicking the CLOSE button
        thumbs2.style.display = "none";
    };
</script>
<script>
    $(function() {
        var demo1 = $("#demo1").slippry({
            // transition: 'fade',
            // useCSS: true,
            // speed: 1000,
            // pause: 3000,
            // auto: true,
            // preload: 'visible',
            // autoHover: false
        });

        $('.stop').click(function() {
            demo1.stopAuto();
        });

        $('.start').click(function() {
            demo1.startAuto();
        });

        $('.prev').click(function() {
            demo1.goToPrevSlide();
            return false;
        });
        $('.next').click(function() {
            demo1.goToNextSlide();
            return false;
        });
        $('.reset').click(function() {
            demo1.destroySlider();
            return false;
        });
        $('.reload').click(function() {
            demo1.reloadSlider();
            return false;
        });
        $('.init').click(function() {
            demo1 = $("#demo1").slippry();
            return false;
        });
    });
    $("#join_the_club").click(function(){
        $('html, body').animate({
            scrollTop: $("#reg_form_arabic").offset().top
        }, 2000);
    });
    $(".thumb").click(function(){
        window.location.assign('<?php echo base_url("frange"); ?>');
    });
</script>
<script>
    $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') + "<small>"+item.el.attr('alt')+"</small>";
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.image-link').magnificPopup({type:'image'});
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118671243-1"></script>
</body>

</html>