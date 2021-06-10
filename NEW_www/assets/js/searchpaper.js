var main_json = [{"total_num" : 0}];

$(function(){
	$("#search_paper_inquire").ajaxForm(function(response_text)	{
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
	var tab =document.getElementById("deviceprop1_main_table");
	var tr=tab.getElementsByTagName("tr");
	var trLength = tr.length;
	for(var i = trLength-1; i != 0; i--){
		tab.removeChild(tr[i]);
	}
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
		num.innerHTML = '<input type="checkbox" style = "height: 20px; width: 100%" name = "exploit_document"/>'+
			'<button class="btn btn-default" style = "height: 20px; width: 100%; font-weight: bold" onclick="collect_paper('+main_json[i].id+')"></button>';
		//论文题目
		paper_name = document.createElement("td");
		paper_name.innerHTML = "<a class='l1' href = '#' onclick='show_keywords("+main_json[i].id+")'>"+main_json[i].paper_name+"</a>";
		//作者(需要大改)
		author = document.createElement("td");
		//添加作者的个人信息
		author_lists = main_json[i].author;
		Auhtorlen = author_lists.length;
		for(var j = 0 ; j != Auhtorlen ; j++){
			author.innerHTML = author.innerHTML + "<a class='l1' href = '#', onclick=\"author_info('"+author_lists[j].name+"',"+main_json[i].id+")\">"+ author_lists[j].name + "</a> ;";
		//发行时间
		}
		publish_date = document.createElement("td");
		publish_date.innerHTML = main_json[i].publish_date;
		//期刊
		jname = document.createElement("td");
		jname.innerHTML = "<a class='l1' href = '#' onclick='show_jinfo("+main_json[i].id+")'>" + main_json[i].jname + "</a>";
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

function collect_paper(obj) {
	$.post("add_collection.php", {paper_id:obj} ,function(status) {
		if (status == 1) {
			alert("您已成功收藏该论文");
		}
		else {
			alert("对不起，添加失败");
		}
	})
}

function getQueryVariable(variable){
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split("=");
		if(pair[0] == variable){return pair[1];}
	}
	return(false);
}

$(window).load(function(){
	var kw = getQueryVariable("keywords");
	var pn = getQueryVariable("paper_name");
	var au = getQueryVariable("author");
	var ins = getQueryVariable("insitution");
	if (kw != false){
		$.post("searchpaper.php", {method:"keywords",usr_input:kw} ,function(response_text) {
			alert(response_text);
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
	}
	else if (pn != false){
		pn=pn.replace("%20","\40")
		$.post("searchpaper.php", {method:"paper_name",usr_input:pn} ,function(response_text) {
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
	}
	else if (au != false){
		au = au.replace(/%20/g,"\40");
		$.post("searchpaper.php", {method:"author",usr_input:au} ,function(response_text) {
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
	}
	else if (ins != false){
		ins = ins.replace(/%20/g,"\40");
		$.post("searchpaper.php", {method:"institution",usr_input:ins} ,function(response_text) {
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
	}
})