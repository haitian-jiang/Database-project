$(window).load(function(){
    $.post("getname.php",function(response_text) {
        var user_avatarr = response_text;
        document.getElementById('user-avatar').innerHTML = "欢迎您，" + user_avatarr;
    });
});