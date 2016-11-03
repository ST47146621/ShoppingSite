
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
// 右下 浮動 購物車
  $(document).ready(function(){
    $(".shopping_Icon").click(function(){
        $(".shopping_Box").toggle();
    
    });
});
// End 右下 浮動 購物車


/*$(function(){
    // 幫 #D 的 ul 子元素加上 .accordionPart
    // 接著再找出 li 中的第一個 a 子元素加上 .qa_title
    // 並幫其加上 hover 及 click 事件
    // 同時把兄弟元素加上 .qa_content 並隱藏起來
    $('#D ul').addClass('accordionPart').find('li a:nth-child(1)').addClass('qa_title').hover(function(){
        $(this).addClass('qa_title_on');
    }, function(){
        $(this).removeClass('qa_title_on');
    }).click(function(){
        // 當點到標題時，若答案是隱藏時則顯示它，同時隱藏其它已經展開的項目
        // 反之則隱藏
        var $qa_content = $(this).next('a.qa_content');
        if(!$qa_content.is(':visible')){
            $('#D ul li a.qa_content:visible').slideUp();
        }
        $qa_content.slideToggle();
    }).siblings().addClass('qa_content').hide();
});
*/



//重新填寫紐
function formReset(myForm)  {
  document.getElementById(myForm).reset();
  }