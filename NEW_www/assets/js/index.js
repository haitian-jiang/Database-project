$(window).load(function(){
	//这里找作者
	$.getJSON("server.php", function(json){
		refresh_main_table();
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
	//
	$.getJSON("server.php", function(json){
		refresh_main_table();
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