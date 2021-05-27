var main_json = [{"total_num" : 0}];
/*
var ckt = 0;

$(function(){
	$("#ck_model").hide();
	$("#input_model").hide();
	ckt = 0;
});
function listener_method()
{
	met = document.getElementById('method').value;
	if(met == 'brand')
	{
		$("#ck_model").show();
		ckt = 0;
	}
	else
	{
		$("#ck_model").hide();
		$("#input_model").hide();
	}
}

function listener_model()
{
	ckt++;
	if(ckt % 2)
		$("#input_model").show();
	else
		$("#input_model").hide();
}
 */
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

// function http()
// {
// 	var req;
// 	req = new XMLHttpRequest();
// 	req.onreadystatechange=function()
// 	{
// 		if (req.readyState==4 && req.status==200)
// 		{
// 			raw_json = req.responseText;
// 			main_json = JSON.parse(raw_json);
// 		}
// 	}
// 	req.open("GET","deviceprop1.php",false);
// 	req.send();
// }

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
		id = document.createElement("td");
		id.innerHTML = main_json[i].id;
		id.setAttribute('id',"paper_id");
		paper_name = document.createElement("td");
		paper_name.innerHTML = main_json[i].paper_name;
		paper_name.setAttribute('id',"paper_name");
		author = document.createElement("td");
		author.innerHTML = main_json[i].author.sort();
		author.setAttribute('id',"author");
		publish_date = document.createElement("td");
		publish_date.innerHTML = main_json[i].publish_date;
		publish_date.setAttribute('id',"publish_date");
		jname = document.createElement("td");
		jname.innerHTML = main_json[i].jname;
		jname.setAttribute('id',"jname");
		institution = document.createElement("td");
		institution.innerHTML = main_json[i].institution;
		institution.setAttribute('id',"institution");
		keywords = document.createElement("td");
		keywords.innerHTML = main_json[i].keywords.sort();
		jtime = document.createElement("td");
		jtime.innerHTML = main_json[i].jtime;
		jplace = document.createElement("td");
		jplace.innerHTML = main_json[i].jplace;
		jplace.setAttribute('id',"jplace");
		collection = document.createElement("td");
		collection.innerHTML = '<button class="btn btn-link" style="font-size:12px" onclick="deviceprop1_collect_paper()" >';
		exploit = document.createElement("td");
		exploit.innerHTML = '<input type="checkbox" name = "exploit_document">';
		tab.appendChild(tr[i]);
		tr[i].appendChild(num);
		tr[i].appendChild(paper_name);
		tr[i].appendChild(author);
		tr[i].appendChild(publish_date);
		tr[i].appendChild(jname);
		tr[i].appendChild(institution);
		tr[i].appendChild(keywords);
		tr[i].appendChild(jtime);
		tr[i].appendChild(jplace);
		tr[i].appendChild(collection);
		tr[i].appendChild(exploit);
	}
}

function deviceprop1_collect_paper() {
	alert("Successfully collect the paper !!!")
}

/*
function deviceprop1_show_details(x)
{
	alert("cpu:    " + main_json[x].pc_cpu + "\n" + "内存:   " + main_json[x].pc_ram + "\n" + "硬盘:   " + main_json[x].pc_hdd + "\n" + "显卡:   " + main_json[x].pc_gpu + "\n");
}
 */