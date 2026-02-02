$(document).ready(function () {//doc ready func take care that all data load first before run jquery
    //events
    $("#btnHide").click(function () {
        $(".second").toggle(2000, function () {
            alert("task complete");
        });
    });
    $("#btnFade").click(function () {   
        $(".first").fadeTo("slow", 0.2);//fadeIn, fadeOut, fadeToggle
        $(".first").text("this is func one");//set text
        console.log($(".first").text());//text use for get text from elem.
        
    })
    $("#btnSlide").click(function () {
        $(".third").slideToggle("slow");
        console.log($(".third").html());
    })
    $("#btnAnimate").click(function () {
        $(".box").animate({
            width: "150px",
            height: "150px",
            fontSize: "20px",
        },"slow");
    })
    $("body").keydown(function (e) {
        if (e.which === 72) {
            $(".second").hide();
        }
        if (e.which === 83) {
            $(".second").show();
        }
    })
    //form events
    $("input").focus(function(){
        $(this).css("background-color","coral")
    })
     $("input").blur(function(){
        $(this).css("background-color","")
    })
     $("input").change(function(){
        console.log($(this).val());
    })
     $("#Form").submit(function(e){
        e.preventDefault();
        console.log("form submitted!");
    })
});