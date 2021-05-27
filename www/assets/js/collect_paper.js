$(document).ready(function () {
    $("#colloect_paper").click(function (){
        var p_id = $(this).text();
        $.post("",{paper_id:p_id},function(status){
            if (status == 1) {
                alert("您已成功添加该论文");
            }
            else {
                alert("对不起，添加失败");
            }
        })
    })
})

