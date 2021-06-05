var main_json = [{"total_num" : 0}];

window.onload = function () {
	$.post("",{},function(response_text){
		refresh_main_table();
		if(response_text == "PC404")
			main_json = [{"total_num": 0}];
		else{
			raw_json = response_text;
			main_json = JSON.parse(raw_json);
			t = main_json.length;
			var fir = {"total_num" : t};
			main_json.unshift(fir);
		}
		deviceprop1_show_total();
		deviceprop1_write_table(main_json[0].total_num);
	})
}

function refresh_main_table(){
	for(var i = 1; i <= main_json[0].total_num; i++)
		tab.removeChild(tr[i]);
}

function deviceprop1_show_total(){
	document.getElementById('deviceprop1_total').innerHTML = '总共查询到<b>' + main_json[0].total_num +'</b>文献';
}

var tab =document.getElementById("deviceprop1_main_table");
var tr = new Array();
tr[1] = 'abc';

function deviceprop1_write_table(m){
	for(var i = 1; i <= m; i++)	{
		tr[i] = document.createElement("tr");
		tr.setAttribute('style="font-size: 16px; font-family:"Times New Roman", "华文宋体"; color: #0c0c0c"')
		num = document.createElement("td");
		num.innerHTML = i;

		//论文题目
		paper_name = document.createElement("td");
		paper_name.innerHTML = "<a herf = '#' onclick='show_keywords("+main_json[i].id+")'>"+main_json[i].paper_name+"</a>";

		//作者
		author = document.createElement("td");
		//添加作者的个人信息
		author_lists = main_json[i].author.records;
		Auhtorlen = author_lists.length;
		for(var j = 0; j <= Auhtorlen ; j++)
			author.innerHTML = author.innerHTML + "<a herf = '', onclick=author_info("
				+author_lists[j]+","+main_json[i].id+")>"+ author_lists[j] + "</a> ;";
		//发行时间
		publish_date = document.createElement("td");
		publish_date.innerHTML = main_json[i].publish_date;
		//期刊
		jname = document.createElement("td");
		jname.innerHTML = "<a herf = '#' onclick='show_jinfo("+main_json[i].id+")'>" + main_json[i].jname + "</a>";
		collection = document.createElement("td");
		collection.innerHTML = '<button onclick="drop_paper(this)" value ='+main_json[i].id+'></inputbutton>'
		exploit = document.createElement("td");
		exploit.innerHTML = '<input type="checkbox" name = "exploit_document"/>';
		tab.appendChild(tr[i]);
		tr[i].appendChild(num);
		tr[i].appendChild(paper_name);
		tr[i].appendChild(author);
		tr[i].appendChild(publish_date);
		tr[i].appendChild(jname);
		tr[i].appendChild(collection);
		tr[i].appendChild(exploit);
	}
}

function show_keywords(obj){
	$.post("", { paper_id:obj} ,function(data) {
		var raw_json = data;
		var pinfo_json = JSON.parse(raw_json);
		keywords_lists = pinfo_json.keywords.records;
		t = pinfo_json.keywords.records.length;
		key_string = '';
		if (t != 0){
			for(var i = 0; i != t;i++){
				key_string = key_string + keywords_lists[i] + ';';
			}
		}
		alert("related subjects:"+key_string);
	})
}

function show_jinfo(obj){
	$.post("", { paper_id:obj} ,function(data) {
		var raw_json = data;
		var pinfo_json = JSON.parse(raw_json);
		alert("期刊发行时间:"+ pinfo_json.jdate + "地点/版号："+pinfo_json.jplace);
	})
}

function author_info(author,id){
	$.post("", { paper_id:id, author_name:author} ,function(data) {
		var raw_json = data;
		var pinfo_json = JSON.parse(raw_json);
		institution = pinfo_json.institution.records;
		t = institution.length;
		ins_string = '';
		if (t != 0){
			for(var i = 0; i != t;i++){
				ins_string = ins_string + institution[i] + ';';
			}
		}
		alert("作者所在单位"+ins_string);
	})
}

function drop_paper(obj) {
	var isDelete=confirm("真的要删除吗？");
	if(isDelete){
		id = obj.value();
		$.post("", { paper_id:id} ,function(status) {
			if (status == 1) {
					alert("您已成功删除该论文");
					var tr=obj.parentNode.parentNode;
					var tbody=tr.parentNode;
					tbody.removeChild(tr);
				}
			else {
				alert("对不起，删除失败");
			}
		})
	}
}

