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


$(function(){
	$("#upfile").ajaxForm(function(response_text)
	{
		var raw_json = response_text;
		var pinfo_json = JSON.parse(raw_json);
		$("#paper_name").val(pinfo_json.paper_name.text());
		$("#author.value").val(pinfo_json.author.text());
		$("#publish_date").val(pinfo_json.publish_date.text());
		$("#jname").val(pinfo_json.jname.text());
		$("#institution").val(pinfo_json.institution.text());
		$("#keywords").val(pinfo_json.keywords.text());
		$("#jtime").val(pinfo_json.jtime.text());
		$("#jplace").val(pinfo_json.jplace.text());
	});
});