
function changecode() {
    $("#password").val("");
    var number = Math.random() + new Date().getMilliseconds();
    $("#Vc_Text").val("");
    src = "../VerifyCode.aspx?";
    src = src + '?' + number;
    $("#Vc_Pic").attr("src", src);
}

function showInfo(str) {
    $('#alertMessage').removeClass('error success warning').html(str).stop(true, true).show().animate({ opacity: 1, right: '0' }, 500);
}
function showSuccess(str) {
    $('#alertMessage').removeClass('error warning').addClass('success').html(str).stop(true, true).show().animate({ opacity: 1, right: '0' }, 500);
}
function showWarning(str) {
    $('#alertMessage').removeClass('success warning').addClass('warning').html(str).stop(true, true).show().animate({ opacity: 1, right: '0' }, 500);
}

function showError(str) {
    $('#alertMessage').removeClass('success warning').addClass('error').html(str).stop(true, true).show().animate({ opacity: 1, right: '0' }, 500);
}

function hideTop() {
    $('#alertMessage').animate({ opacity: 0, right: '-20' }, 500, function () { $(this).hide(); });
}

function result(date, textStatus) {
    this; // 调用本次AJAX请求时传递的options参数
    alert(date);
    alert(textStatus);
}

//-----------
//Loading ......
function loading(name, overlay) {

    $('body').append('<div id="overlay"></div><div id="preloader">' + name + '..</div>');
    if (overlay == 1) {
        $('#overlay').css('opacity', 0.1).fadeIn(function () { $('#preloader').fadeIn(); });
        return false;
    }
    $('#preloader').fadeIn();
}

function unloading() {
    $('#preloader').fadeOut('fast', function () { $('#overlay').fadeOut(); });
}

//－－－－－－－－－
//Begin .......
function begin() {
    var username = $("#username").val("");
    var password = $("#password").val("");
    $("#login").fadeIn(800, function () {
        $("#login").animate({ top: '+40px' }, 500, function () {
            remember(); 
             $("#username").focus();    
        });


    });


}

//-----------------
//Login..........
function Login() {
    $("#login").animate({ opacity: 1, top: '-20px' }, 500, function () {
        $(this).fadeOut(500, function () {
            $(".text_success").slideDown();
            //$("#successLogin").animate({ opacity: 1, height: "200px" }, 500);
        });
    })
    setTimeout("window.location.href='index.php'", 3000);
}

//--------------------
//ajax.....
$('#actionform').ajaxStart(function () {
    $("#submit-form").attr("disabled", "disabled");
    showInfo('数据载入中...');
});
$('#actionform').ajaxStop(function () {
    setTimeout('hideTop()', 2000);
});
$('#actionform').ajaxError(function (event, request, settings) { showError('数据处理失败，错误：' + request.status); });

$("#actionform").ajaxComplete(function (event, request, settings) {
    $("#submit-form").removeAttr("disabled");
});

$('#alertMessage').click(function () { hideTop(); });

function remember() { 
    $.ajax({
        type: "post",   //访问WebService使用Post方式请求
        contentType: "application/json", //WebService 会返回Json类型
        url: "remembersys.php", //调用WebService的地址和方法名称组合 ---- WsURL/方法名
        data: "{}",
        dataType: 'text',
        success: function (result) {     //回调函数，result，返回值
            var u = result;
            if (u != "") {
                $("#username").val(u);
                $("#password").focus();
                $("#check-field").attr("checked", "checked");
            } else {
                $("#username").focus();
                $("#check-field").removeAttr("checked");
            }
        }
    });
}

//var passstate = true;
function submitcheck() {

    var username = $("#username").val();
    var password = $("#password").val();
    var code = $("#Vc_Text").val();

    if (username == "") {
        showError("请输入用户名");
        setTimeout('hideTop()', 5000);
        $("#username").focus();
        return false;
    }
    if (password == "") {
        showError("请输入密码");
        setTimeout('hideTop()', 5000);
        $("#password").focus();
        return false;
    } else {
        if (password.length < 3) {
            showError("输入的密码不合法");
            setTimeout('hideTop()', 5000);
            $("#password").focus();
            return false;
        }
    } 

    var number = Math.random() + new Date().getMilliseconds();  
    $.ajax({
        type: 'post',
        url: "loginsys.php?number=" + number,
        data: $("#actionform").serializeArray(),
        success: function (result) {
            var obj = jQuery.parseJSON(result);
            var ss=obj.status; 
            var text=obj.text; 
            if (ss== "fail") { 
                showError(text);
                changecode();
            }
            else if (ss== "success") {
                setTimeout("Login()", 500);
                showInfo(text);
            }
            else if (ss== "info") {                
                showInfo(text);
            }
            //alert(result);
        } 

    });
    //$("#actiondiv").load("login.aspx", $("#actionform").serializeArray(), result);
    return false;
} 
$(document).ready(function () { 
    begin(); 
    $("#submit-form").click(function () {
        submitcheck();
    });
});

  

