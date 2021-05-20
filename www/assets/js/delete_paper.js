$(document).ready(function () {
    $("#delete_paper").click(function (){
        var p_id = $(this).text();
        $.post("",{paper_id:p_id},function(status){
            if (status == 1) {
                alert("您已成功删除该论文");
            }
            else {
                alert("对不起，删除失败");
            }
        })
    })
})

