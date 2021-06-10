var main_json = [{"total_num" : 0}];

$(window).load(function(){
	$.post("show_collection.php", ,function(json){
		if(response_text == "PC404")
			main_json = [{"total_num": 0}];
		else{
			//alert(response_text);
			raw_json = response_text;
			main_json = JSON.parse(raw_json);
			t = main_json.length;
			var fir = {"total_num" : t};
			main_json.unshift(fir);
		}
		deviceprop1_show_total();
		deviceprop1_write_table(main_json[0].total_num);
	});
});
/*
function refresh_main_table(){
	var tab =document.getElementById("deviceprop1_main_table");
	var tr=tab.getElementsByTagName("tr");
	var trLength = tr.length;
	for(var i = trLength-1; i != 0; i--){
		tab.removeChild(tr[i]);
	}
}
*/

function deviceprop1_show_total(){
	document.getElementById('deviceprop1_total').innerHTML = '总共查询到<b>' + main_json[0].total_num +'</b>文献';
}

var tab =document.getElementById("deviceprop1_main_table");
var tr = new Array();
tr[1] = 'abc';

function deviceprop1_write_table(m){
	for(var i = 1; i <= m; i++)	{
		tr[i] = document.createElement("tr");
		num = document.createElement("td");
		num.innerHTML = '<input type="checkbox" style = "height: 20px; width: 100%" name = "exploit_document"/>'+
			'<button class="btn btn-default" style = "height: 20px; width: 100%; font-weight: bold" onclick="drop_paper('+main_json[i].id+')"></button>';
		//论文题目
		paper_name = document.createElement("td");
		paper_name.innerHTML = "<a class='l1' herf = '#' onclick='show_keywords("+main_json[i].id+")'>"+main_json[i].paper_name+"</a>";
		//作者(需要大改)
		author = document.createElement("td");
		//添加作者的个人信息
		author_lists = main_json[i].author;
		Auhtorlen = author_lists.length;
		for(var j = 0 ; j != Auhtorlen ; j++){
			author.innerHTML = author.innerHTML + "<a class =‘l1’ herf = '#', onclick=\"author_info('"+author_lists[j].name+"',"+main_json[i].id+")\">"+ author_lists[j].name + "</a> ;";
			//发行时间
		}
		publish_date = document.createElement("td");
		publish_date.innerHTML = main_json[i].publish_date;
		//期刊
		jname = document.createElement("td");
		jname.innerHTML = "<a class='l1' herf = '#' onclick='show_jinfo("+main_json[i].id+")'>" + main_json[i].jname + "</a>";
		tab.appendChild(tr[i]);
		tr[i].appendChild(num);
		tr[i].appendChild(paper_name);
		tr[i].appendChild(author);
		tr[i].appendChild(publish_date);
		tr[i].appendChild(jname);
	}
}
function show_keywords(obj){
	$.post("show_keyword.php", { paper_id:obj} ,function(data) {
		var raw_json = data;
		var pinfo_json = JSON.parse(raw_json);
		t = pinfo_json.length;
		key_string = '';
		if (t != 0){
			for(var i = 0; i != t;i++){
				key_string = key_string + pinfo_json[i].keyword + '; ';
			}
		}
		alert("related subjects:\n"+key_string);
	})
}

function show_jinfo(obj){
	$.post("show_jtimejplace.php", { paper_id:obj} ,function(data) {
		var raw_json = data;
		var pinfo_json = JSON.parse(raw_json);
		var i = 0;
		alert("期刊发行时间如下：\n"+ pinfo_json[0].jtime[0].jtime.substring(0,10) + "\n地点/版号如下：\n"+pinfo_json[0].jplace[0].jplace);
	})
}

function author_info(author,id){
	$.post("show_institution.php", { paper_id:id, author_name:author} ,function(data) {
		var raw_json = data;
		var pinfo_json = JSON.parse(raw_json);
		institution = pinfo_json[0].institution;
		alert("作者所在单位如下：\n"+institution);
	})
}

function drop_paper(obj) {
	var isDelete=confirm("真的要删除吗？");
	if(isDelete){
		id = obj.value();
		$.post("delete_collection", { paper_id:id} ,function(status) {
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

