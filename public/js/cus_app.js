let _taggled = 1
$(document).ready(function(){
    $('.cus').click(function(){
        list()
    })
    let on = true
    function list(){
        if (on) {
            on = false
            $('.profile-list').removeClass('in-active')
        }else{
            on = true
            $('.profile-list').addClass('in-active')
        }
    }
    $("#arrow-clicker").click(()=>{
        if (_taggled) {
            $(".list").fadeOut('fast')
            $(".blue").animate({'minWidth':'100vw'})
            $(".nav-section").css('minWidth', '100vw')
            $("#arrow-clicker").removeClass('fa-arrow-left')
            $("#arrow-clicker").addClass('fa-arrow-right')
            $("#arrow-clicker").css('marginInline', '50px')
            $(".wrapper-page").css('paddingInlineStart', '30px')
            _taggled = 0
        }else{
            $(".list").fadeIn('slow')
            $(".blue").animate({'minWidth':'79vw'})
            $(".nav-section").css('minWidth', '80vw')
            $("#arrow-clicker").removeClass('fa-arrow-right')
            $("#arrow-clicker").addClass('fa-arrow-left')
            $("#arrow-clicker").css('marginInline', 'unset')
            _taggled = 1
        }
    })
})
