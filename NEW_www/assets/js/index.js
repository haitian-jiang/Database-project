var tab1 =document.getElementById("literature_table");
var tab2 =document.getElementById("keywords_table");

$(window).load(function(){	//这里找收藏量最多的文献
	$.post("mostpopularpaper.php", function(response_text){
		if(response_text == "PC404"){
			alert("not success");
			return 0;
		}			
		else{
			raw_json = response_text;
			main_json = JSON.parse(raw_json);
			t = main_json.length;
			var fir = {"total_num" : t};
			main_json.unshift(fir);
		}
		literature_write_table(main_json[0].total_num);
	});
	
	$.post("mostpopularkeywords.php", function(response_text){
		if(response_text == "PC404"){
			alert("not success");
			return 0;
		}			
		else{
			raw_json = response_text;
			main_json = JSON.parse(raw_json);
			t = main_json.length;
			var fir = {"total_num" : t};
			main_json.unshift(fir);
		}
		keywords_write_table(main_json[0].total_num);
	});
});

function literature_write_table(m){
	var tr = new Array();
	tr[1] = 'abc';
	for(var i = 1; i <= m; i++)	{
		tr[i] = document.createElement("tr");
		num = document.createElement("td");
		num.innerHTML = i
		//论文题目
		paper_name = document.createElement("td");
		paper_link = "http://localhost/searchpaper.html?paper_name="+main_json[i].paper_name;
		paper_name.innerHTML = "<a class='l1' href = "+paper_link+">"+main_json[i].paper_name+"</a>";
		tab1.appendChild(tr[i]);
		tr[i].appendChild(num);
		tr[i].appendChild(paper_name);
	}
}


function keywords_write_table(m){
	var tr = new Array();
	tr[1] = 'abc';
	for(var i = 1; i <= m; i++)	{
		tr[i] = document.createElement("tr");
		num = document.createElement("td");
		num.innerHTML = i
		//关键字
		keywords = document.createElement("td");
		paper_link = "http://localhost/searchpaper.html?keywords="+main_json[i].keyword;
		keywords.innerHTML = "<a class='l1' href = "+paper_link+">"+main_json[i].keyword+"</a>";
		tab2.appendChild(tr[i]);
		tr[i].appendChild(num);
		tr[i].appendChild(keywords);
	}
}