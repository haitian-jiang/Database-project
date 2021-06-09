/*
$(function(){
	$("#devicepropman_add").ajaxForm(function(response_text)
	{
		var zz = /success/i;
		if (zz.test(response_text))
			swal(response_text, "信息添加成功！", "success");
		else
			swal(response_text, "信息添加失败，请检查您的输入！", "error");
	});
});
 */

var tab = document.getElementById("author-institution");

inter = 0;
total_au = 0;

function AddRow(obj = ""){
	inter++;
	total_au++;
	$("#total_au").val(total_au);
	tr = document.createElement("tr");
	let del = document.createElement("td");
	del.innerHTML = '<button class="btn btn-default" onclick="deleteCurrentRow(this)">删除作者</button>';
	let author = document.createElement("td");
	author.innerHTML = '<input class="form-control input-rounded" type="text" name="author[]" value = "' + obj +'" required="required">';
	let institution = document.createElement("td");
	institution.innerHTML = '<input class="form-control input-rounded" type="text" name="institution[]">'
	tab.appendChild(tr);
	tr.appendChild(del);
	tr.appendChild(author);
	tr.appendChild(institution);
}

function deleteCurrentRow(obj){
	var isDelete=confirm("真的要删除吗？");
	if(isDelete){
		total_au--;
		$("#total_au").val(total_au);
		var tr=obj.parentNode.parentNode;
		var tbody=tr.parentNode;
		tbody.removeChild(tr);
	}
}

// 接受数据并且填入表格
$(function(){
	$("#upfile").ajaxForm(function(response_text)
	{
		alert(response_text);
		if(response_text.substring(0,7) == "#ERROR#")
			alert("请检查您的文件！以下为错误代码：\n"+response_text)
		else{
			var raw_json = response_text;
			var pinfo_json = JSON.parse(raw_json);
			$("#paper_name").val(pinfo_json.Title);
			$("#publish_date").val(pinfo_json.publish_date);
			$("#jname").val(pinfo_json.jname);
			$("#keywords").val(pinfo_json.Keywords);
			//清空已经有的作者表单
			tr=tab.getElementsByTagName("tr");
			trlength = tr.length;
			for(var i = trlength-1; i != 0; i--){
				tab.removeChild(tr[i]);
			}			//添加表单
			/* 如果是列表的话
			author_lists = pinfo_json.Author;
			t = author_lists.length;
			if (t != 0){
				for(var i = 0; i != t;i++){
					AddRow(author_lists[i])
				}
			}
			*/
			AddRow(pinfo_json.Author);
		}
	});
});
