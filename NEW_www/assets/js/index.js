//这边是想要去一开始就拉文献
var main_json = [{"total_num" : 0}];

//清空table
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
		deviceprop1_write_table(main_json[0].total_num);
	})
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
		deviceprop1_write_table(main_json[0].total_num);
	})
}


var tab =document.getElementById("deviceprop1_main_table");
var tr = new Array();
tr[1] = 'abc';

function deviceprop1_write_table(m){
	for(var i = 1; i <= min(m,5); i++)	{
		tr[i] = document.createElement("tr");
		num = document.createElement("td");
		num.innerHTML = i;
//		id.setAttribute('id',"paper_id");
		paper_name = document.createElement("td");
		paper_name.innerHTML = main_json[i].paper_name;
//		paper_name.setAttribute('id',"paper_name");
		favour = document.createElement("td");
		favour.innerHTML = '<a >看看详情</a>'
		tab.appendChild(tr[i]);
		tr[i].appendChild(num);
		tr[i].appendChild(paper_name);
		tr[i].appendChild(favour);
	}
}