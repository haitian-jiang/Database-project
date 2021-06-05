var main_json = [{"total_num" : 0}];

$(function(){
	$("#deviceprop1_inquire").ajaxForm(function(response_text)	{
	//	alert(response_text);
		refresh_main_table();
		if(response_text == "PC404")
			main_json = [{"total_num": 0}];
		else{
	//		alert(response_text);
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
		num = document.createElement("td");
		num.innerHTML = i;
		//论文题目
		paper_name = document.createElement("td");
		paper_name.innerHTML = main_json[i].paper_name;
		//作者
		author = document.createElement("td");
		//添加作者的个人信息
		author.innerHTML = main_json[i].author.sort();
		author.setAttribute('id',"author");
		publish_date = document.createElement("td");
		publish_date.innerHTML = main_json[i].publish_date;
		//期刊
		jname = document.createElement("td");
		//添加期刊的详细信息
		jname.innerHTML = main_json[i].jname;
		//查看期刊的信息
		collection = document.createElement("td");
		collection.innerHTML = '<button id = "colloect_paper"><span hidden>' + main_json[i].id +
			'</span> </button>'
		exploit = document.createElement("td");
		exploit.innerHTML = '<input type="checkbox" id = "exploit_document">';
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

function deviceprop1_collect_paper() {
	alert("Successfully collect the paper !!!")
}

function getpapers()
{
	var url = ''; // 放php的地方
	var pre_url = document.referrer;
	var pars = '&url='+pre_url;
	var myAjax = new Ajax.Request(url,{method: 'get', parameters: pars} )
}

/*
function deviceprop1_show_details(x)
{
	alert("cpu:    " + main_json[x].pc_cpu + "\n" + "内存:   " + main_json[x].pc_ram + "\n" + "硬盘:   " + main_json[x].pc_hdd + "\n" + "显卡:   " + main_json[x].pc_gpu + "\n");
}
 */