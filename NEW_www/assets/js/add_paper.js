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

var tab = document.getElementById("author-institution");

function AddRow(obj = ""){
		tr = document.createElement("tr");
		let del = document.createElement("td");
		del.innerHTML = '<button class="btn btn-default" onclick="deleteCurrentRow(this)">删除作者</button>';
		let author = document.createElement("td");
		author.innerHTML = '<input class="form-control input-rounded" type="text" name="author" value = "' + obj +'" required="required">';

		let institution = document.createElement("td");
		institution.innerHTML = '<input class="form-control input-rounded" type="text" name="institution">'
		tab.appendChild(tr);
		tr.appendChild(del);
		tr.appendChild(author);
		tr.appendChild(institution);
}

function deleteCurrentRow(obj){
	var isDelete=confirm("真的要删除吗？");
	if(isDelete){
		var tr=obj.parentNode.parentNode;
		var tbody=tr.parentNode;
		tbody.removeChild(tr);
	}
}

// 接受数据并且填入表格
$(function(){
	$("#upfile").ajaxForm(function(response_text)
	{
		var raw_json = response_text;
		var pinfo_json = JSON.parse(raw_json);
		$("#paper_name").val(pinfo_json.paper_name.text());
		$("#publish_date").val(pinfo_json.publish_date.text());
		$("#jname").val(pinfo_json.jname.text());
		$("#keywords").val(pinfo_json.keywords.text());
		$("#jtime").val(pinfo_json.jtime.text());
		$("#jplace").val(pinfo_json.jplace.text());
		//清空已经有的作者表单
		tr=tab.getElementsByTagName("tr");
		trlength = tr.length;
		for(var i = 1; i != trlength; i++){
			tab.removeChild(tr[i]);
		}
		//添加表单
		author_lists = pinfo_json.author.records;
		t = pinfo_json.author.records.length;
		if (t != 0){
			for(var i = 0; i != t;i++){
				AddRow(pinfo_json.author.records[i-1].author.text())
			}
		}
	});
});
