$(window).load(function() {
    $.post("getname.php",function(response_text) {
        username = response_text;
        if(username == "") {
            swal("Oops!", "您还没有登陆！", "info")
                .then(() => {
                    window.location.href="login.html";
                });
        }
        else
            document.getElementById('user-avatar').innerHTML = '<div class="header-icon user-avatar">欢迎您，' + username + '</div>';
    });
})

