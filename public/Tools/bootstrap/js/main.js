
/*$(document).ready(function(){
    $("#moreNav").click(function(){
        $("#sideNav").slideToggle();
		
    })    ;
});
*/

function show_ANav()
{
	var x = $("#ANav").html()
	document.getElementById("sideNav").innerHTML = '<ul id="sideNav_Words" class="navbar-nav">'+x+"</ul>" ;
	
}

$(function () {

    $("#moreNav").click(function () {
        var $S_N = $("#sideNav");
        if ($S_N.position().left > 0 )
             $S_N.animate({ right: -$S_N.width(), opacity: 0 }, 1000,function(){
             	$(this).hide();
             }
             	);
        else
            $S_N.show().animate({ right: "", opacity: 1 }, 500);
    });

});

