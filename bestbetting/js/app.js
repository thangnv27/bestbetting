var User = function(){
    return {
        login:function(){
            $("form#loginform").submit(function(){
                var valid = true;
                var msg = "<p>Các trường có dấu * là bắt buộc!</p>";
                
                $("form#loginform input[type='text'], form#loginform input[type='password']").each(function(){
                    if($(this).val().length == 0){
                        $(this).parent('span.input-text').css({
                            'border': '1px solid red'
                        });
                        valid = false;
                    }else{
                        $(this).parent('span.input-text').css({
                            'border': '1px solid #CCCCCC'
                        });
                    }
                });
                
                if(!valid){
                    $("#message").html(msg).addClass('warning');
                    return false;
                }
            });
        },
        register:function(){
            $("form#registerform").submit(function(){
                var valid = true;
                var msg = "<p>Các trường có dấu * là bắt buộc!</p>";
                var emailField = $("form#registerform #inputEmail");
                var pwd1 = $("form#registerform #inputPassword");
                var pwd2 = $("form#registerform #inputPasswordCfm");
                
                $("form#registerform input[type='text'], form#registerform input[type='password']").each(function(){
                    if($(this).attr('name') != 'user_dob_year'){
                        if($(this).val().length == 0){
                            $(this).parent('span.input-text').css({
                                'border': '1px solid red'
                            });
                            valid = false;
                        }else{
                            $(this).parent('span.input-text').css({
                                'border': '1px solid #CCCCCC'
                            });
                        }
                    }
                });
                if(pwd2.val() != pwd1.val()){
                    pwd2.parent('span.input-text').css({
                        'border': '1px solid red'
                    });
                    valid = false;
                    msg += "<p>Xác nhận mật khẩu không chính xác!</p>";
                }else{
                    pwd2.parent('span.input-text').css({
                        'border': '1px solid #CCCCCC'
                    });
                }
                if(!isValidEmail(emailField.val())){
                    emailField.parent('span.input-text').css({
                        'border': '1px solid red'
                    });
                    valid = false;
                    msg += "<p>Địa chỉ email không hợp lệ!</p>";
                }else{
                    emailField.parent('span.input-text').css({
                        'border': '1px solid #CCCCCC'
                    });
                }
                
                if(!valid){
                    $("#message").html(msg).addClass('warning');
                    return false;
                }
            });
        }
    }
}();

// Run
jQuery(function($){
    
    i18n.init({
        lng: lang,
        fallbackLng: lang,
        detectLngQS: "lang",
        resGetPath: themeUrl + '/locales/__lng__/__ns__.json',
        resPostPath: themeUrl + '/locales/add/__lng__/__ns__'
    },
    function(t) {
        // translate 
        $("body.i18n").i18n();

    // programatical access
    //                var appName = t("app.name");
    }
    );
    
    $('.eshop').live('mouseenter', function() {
        if ($(".cart").html().trim().length == 0){
            AjaxCart.loadCart();
        }
        $('.cart').show();
    });
    $('.eshop').live('mouseleave', function() {
        $('.cart').hide();
    });
    
    User.login();
    User.register();
    
    var list=4;
    function PrevNext(a) {
        var ulWidth = $('#thumb li').length;
        var left = $('#thumb').position().left;
        if (a == 1) {
            if (ulWidth > 4 && list < ulWidth) {
                $('#thumb').animate({
                    left: '-=113'
                }, 500);
                list++;
                $('.thumbprev').show();                    
            }
            else {
                $('.thumbnext').hide();
                $('.thumbprev').show();
            }
        } else {
            if (list > 4) {
                $('#thumb').animate({
                    left: '+=113'
                }, 500);
                list--;
                $('.thumbnext').show();                    

            }
            else {
                $('.thumbprev').hide();
                $('.thumbnext').show();
            }
        }
    }

    $('#thumb li a').click(function () {
        $('#thumb li a img').removeClass('selecImg');
        $('#imgView').attr('src', $(this).attr('href')).parent('a').attr('href', $(this).attr('href'));
        $(this).children('img').addClass('selecImg');
        return false;
    });
    if ($('#thumb li').length <= 4) {
        $('.thumbnext').hide();
    }
    $('.thumbnext').click(function () {
        PrevNext(1);
    });
    $('.thumbprev').click(function () {
        PrevNext(0);
    });
    
    
    $(document).ready(function(){
        $('.bxslider').bxSlider({
            auto: true,
            captions: false,
            controls: false
        });
    });
    
    // jQuery placeholder for IE
    $("input, textarea").placeholder();

    $('.description-info').expander({
        slicePoint: 200,
        expandText: 'More +',
        userCollapseText: 'Collapse +',
        expandEffect: 'show',
        expandSpeed: 0,
        collapseEffect: 'hide',
        collapseSpeed: 0
    });
    
    $(".read-more a").attr('data-i18n', 'link.more');
    $(".read-less a").attr('data-i18n', 'link.collapse');
    $("a.home").attr('data-i18n', 'link.home');
    //    --------
    $(".other-product-item").each(function(index){
        $(this).hoverIntent({
            over: function(){
                $(".other-product-item-hover").eq(index).fadeIn("normal");
            },
            out: function(){
                $(".other-product-item-hover").eq(index).fadeOut("normal");
            }
        });
    });
    //    ------
    
    // expanding-collapse categories on Sidebar
    $(".sidebar ul.list-cat li").each(function(){
        if ($(this).children('ul.children').length > 0) {
            if ($(this).hasClass('current-cat') || $(this).hasClass('current-cat-parent')) {
                $(this).children('ul.children').show();
            } else {
                var $li_child = $(this).children('ul.children').children('li');
                if ($li_child.children('ul.children').length > 0) {
                    if ($li_child.hasClass('current-cat') || $li_child.hasClass('current-cat-parent')) {
                        $(this).children('ul.children').prev('a').css('font-weight', 'bold');
                        $(this).children('ul.children').show();
                    } else {
                        $(this).children('ul.children').hide();
                    }
                } else {
                    $(this).children('ul.children').hide();
                }
            }
        }
    });
    $(".sidebar ul.list-cat").children('li:last').css({
        'border-bottom':'1px solid #D9D9D9'
    });
    if ($(".catalog").height() < $(".sidebar").outerHeight(true)) {
        $(".catalog").height($(".sidebar").outerHeight(true));
    }

    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('#toTop').fadeIn();
        } else if($(this).width() >= 1200){
            $('#toTop').fadeOut();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $("#toTop").click(function(){
        scrollToElement("#header"); 
    });
});