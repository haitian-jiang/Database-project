function collect_paper(obj) {
    var id = obj.text();
    $.post("", { paper_id:id} ,function(status) {
        if (status == 1) {
            alert("您已成功收藏该论文");
        }
        else {
            alert("对不起，添加失败");
        }
    })
}