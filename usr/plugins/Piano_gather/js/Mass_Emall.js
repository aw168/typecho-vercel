$(document).ready(function(){
	$(".yyui_tab_title , .yyui_tab_title_this ").click(function(){
		$(this).siblings('li').attr('class','yyui_tab_title');
		$(this).attr('class','yyui_tab_title_this');
		$(this).parent().siblings('div').attr('class','yyui_tab_content');
		$(this).parent().siblings('div').eq($(this).index()).attr('class','yyui_tab_content_this');
	});
}); 
function yyui_menu(ulclass){
	$(document).ready(function(){
		$(ulclass+' li').hover(function(){
			$(this).children("ul").show(); //mouseover
		},function(){
			$(this).children("ul").hide(); //mouseout
		});
	});
}
function switchTab(tabIndex) {
	$('.yyui_tab_title').eq(tabIndex).siblings('li').attr('class', 'yyui_tab_title');
	$('.yyui_tab_title').eq(tabIndex).attr('class', 'yyui_tab_title_this');
	var element = $(".yyui_tab_content_this");
	element.addClass("yyui_tab_content");
	element.removeClass("yyui_tab_content_this");
	$('.yyui_tab_content').eq(tabIndex).attr('class', 'yyui_tab_content_this');
}
function Gather_paste(id) {
	layer.confirm('您是要编辑还是复制这个采集规则？', {
		area: ['110px', 'auto'],
		title: '温馨提示',
		btn: ['编辑', '复制'],btn2: function(index, elem){
			Gather_Url(GATHER+'usr/plugins/Piano_gather/config.json',function(responseText) {
				let datasd = JSON.parse(responseText)[id];
				if (datasd['Fun_img']) {
					$('input[name="Fun_img"]').prop('checked', true);
				}
				if (datasd['Fun_tag']) {
					$('input[name="Fun_tag"]').prop('checked', true);
				}
				if (datasd['sort_2']) {
					$('input[name="sort_2"]').prop('checked', true);
				}
				if (datasd['sort_hide']) {
					$('input[name="sort_hide"]').prop('checked', true);
				}
				for (const key in datasd){
					const value = datasd[key];
					$(`[name='${key}']`).val(value);
				}
			});
			switchTab(1);
		}}, function(index) {
			$("input[name='Blog_edit']").val(id);
			Gather_Url(GATHER+'usr/plugins/Piano_gather/config.json',function(responseText) {
				let datasd = JSON.parse(responseText)[id];
				if (datasd['Fun_img']) {
					$('input[name="Fun_img"]').prop('checked', true);
				}
				if (datasd['Fun_tag']) {
					$('input[name="Fun_tag"]').prop('checked', true);
				}
				if (datasd['sort_2']) {
					$('input[name="sort_2"]').prop('checked', true);
				}
				if (datasd['sort_hide']) {
					$('input[name="sort_hide"]').prop('checked', true);
				}
				for (const key in datasd){
					const value = datasd[key];
					$(`[name='${key}']`).val(value);
				}
			});
			switchTab(1);
			layer.close(index);
		}
	);
}
function getMainDomain(url) {
	const parsedUrl = new URL(url, 'http://kong.null');  // 第二个参数只是为了使 URL 解析正确
	const parts = parsedUrl.hostname.split('.');  // 将主机名部分按点号分隔成数组
	if (parts.length >= 2) {  // 如果数组元素个数大于等于2，说明至少有一个主域名和一个顶级域名
		return parts[parts.length - 2] + '.' + parts[parts.length - 1];  // 取倒数第二个和最后一个元素作为主域名和顶级域名
	} else {  // 否则说明主机名部分不合法，无法提取主域名
		return null;
	}
}
function replaceAllImages(code,mainUrl) {
	// 匹配所有图片地址
	const regex = /<img.*?src=["']([^"']+)["']/gi;
	let match;
	let newCode = code;
	// 遍历所有匹配到的图片地址，逐个替换
	while ((match = regex.exec(code))) {
		const oldUrl = match[1];
		const domain = new URL(mainUrl);
		const mainDomain = getMainDomain(oldUrl);
		if (mainDomain.indexOf('kong.null') != -1) {//说明不含主域名
			newCode = newCode.replace(oldUrl, domain.origin+'/'+oldUrl);
		}else if (domain.host.indexOf(mainDomain) != -1) {//跟主网站域名一样
			if(oldUrl.indexOf("http") != -1){
				newCode = newCode.replace(oldUrl, oldUrl);
			}else{
				const news = new URL(oldUrl, mainUrl).href;
				newCode = newCode.replace(oldUrl, news);
			}
		}else{
			const news = new URL(oldUrl, mainUrl).href;
			newCode = newCode.replace(oldUrl, news);
		}
	}
	return newCode;
}
// 内容页测试//.desDiv，.titleImg,.content
function Blog_Url() {
	$("#fanKui").html('');
	var arr = [];
	const url = $("input[name='Blog_url']").val();
	const Class = $("input[name='Blog_Class']").val();
	const Blog_replace = $("textarea[name='Blog_replace']").val();
	const ContClass = $("input[name='Blog_contClass']").val();
	const containon = $("input[name='tabulation_containon']").val();
	const containoff = $("input[name='tabulation_containoff']").val();
	const Blog_delete = $("input[name='Blog_delete']").val();
	const Fun_Class = $("input[name='Fun_Class']").val();
	var divID = document.getElementById("fanKui");
	Gather_Url(url, function(responseText) {
		var $html = $('<div>').html(responseText);
		const temp = document.createElement('div');
		temp.innerHTML = responseText;
		const keywordsEl = temp.querySelector('meta[name="keywords"]');
		var keywords = keywordsEl ? keywordsEl.getAttribute('content') : '';
		const descriptionEl = temp.querySelector('meta[name="description"]');
		var description = descriptionEl ? descriptionEl.getAttribute('content') : '';
		if(Class.indexOf(".") != -1){
			var title = $html.find(Class).text();
		}else if(Class.indexOf("#") != -1){
			var title = $html.find(Class).text();
		}else if(Class.indexOf("*") != -1){
			var match = Class.match(/^(.*?)\*(.*)$/);
			var title = getSubstr_among(responseText,match[1],match[2]);
		}else{
			var match = /<title>([\s\S]*?)<\/title>/i.exec(responseText);
			var title = match[1];
		}
		if(Fun_Class){
			$html.find(Fun_Class).remove();
			var $html = $($html.html());
		}//.desDiv,.titleImg,.content
		const newContClass = ContClass.replace('，', ',');
		if(newContClass.trim() === ''){
			var content = '没有指定采集位置';//暂无
		}else if(newContClass.indexOf("*") != -1){
			var matchs = newContClass.match(/^(.*?)\*(.*)$/);
			var content = getSubstr_among(responseText,matchs[1],matchs[2]);
		}else{
			var elementsContent = $html.find(newContClass).map(function() {
			  return $(this).html();
			}).get();
			var content = elementsContent.join("\n");
		}
// 		var turndownService = new window.TurndownService();
// 		var content = turndownService.turndown(content);
		let contents = null
		if(Blog_replace){
			const lines = Blog_replace.split("\n");
			lines.forEach(function(line) {
				var match = line.match(/^(.*?)\----(.*)$/);
				content = content.replace(new RegExp(match[1], "g"), match[2]);
				description = description.replace(new RegExp(match[1], "g"), match[2]);
				keywords = keywords.replace(new RegExp(match[1], "g"), match[2]);
				title = title.replace(new RegExp(match[1], "g"), match[2]);
			});
		}
		if(Blog_delete){
			let index = content.indexOf(Blog_delete);
			if (index !== -1) {
				var content = content.substring(0, index);
			}
		}
		let newStr = '';
		newStr = content;
		console.log(newStr);
		const newCode = replaceAllImages(newStr, url);
		divID.innerHTML += '<span style="color:#99BB00;">【文章标题】</span></br>'+title+'</br><span style="color:#99BB00;">【文章标签】</span></br>'+keywords+'</br><span style="color:#99BB00;">【文章摘要】</span></br>'+description+'</br><span style="color:#99BB00;">【文章正文】</span></br>'+newCode+'</br>';
	});
	divID.scrollTop = divID.scrollHeight;
}
//取文本中间
function getSubstr_among(content,min,max) {
	var data = content.split(min)[1];
	var data = data.split(max)[0];
	return data;
}
function Additional(obj,name) {
	var text = obj.textContent;
	var input = document.getElementsByName(name)[0];
	input.value += text;
}
function Gather_bendihua(id) {
	Gather_Url('https://app.su1018.cn/content/plugins/Piano_gather/config.json',function(responseText) {
		let datasd = JSON.parse(responseText)[id];
		for (const key in datasd){
			const value = datasd[key];
			$(`[name='${key}']`).val(value);
			console.log(value);
		}
	});
	switchTab(1);
}
//网址获取测试
function Take_Url(){
	$("#fanKui").html('');
	var arr = [];
	const url = $("input[name='tabulation_url']").val();
	const Class = $("input[name='tabulation_Class']").val();
	const containon = $("input[name='tabulation_containon']").val();
	const containoff = $("input[name='tabulation_containoff']").val();
	Gather_Url(url, function(responseText) {
		console.log(responseText); 
		var $html = $('<div>').html(responseText);
		if(Class.indexOf(".") != -1){
			var $links = $html.find(Class+' a');
		}else if(Class.indexOf("#") != -1){
			var $links = $html.find(Class+' a');
		}else if(Class.indexOf("*") != -1){
			var match = Class.match(/^(.*?)\*(.*)$/);
			var $linurl = $('<div>').html(getSubstr_among(responseText,match[1],match[2]));
			var $links = $linurl.find('a');
		}else{
			var $links = $html.find('a');
		}
		$links.each(function() {
			var linkes = $(this).attr('href');
			var Urla = document.createElement('a');
			Urla.href = url;
			var baseUrl = Urla.protocol + "//" + Urla.host;
			if(linkes && linkes.indexOf("http") !== 0) { // 判断是否需要补全
				var linkes = baseUrl+linkes;
			}
			if(containon){
				if (linkes.indexOf(containon) !== -1) {
					if(containoff){
						if (linkes.indexOf(containoff) === -1) {
							arr.push(linkes);
						}
					}else{
						arr.push(linkes);
					}
				}
			}else{
				if(containoff){
					if (linkes.indexOf(containoff) === -1) {
						arr.push(linkes);
					}
				}else{
					arr.push(linkes);
				}
			}
		});
		var uniqueArr = [...new Set(arr)];
		var divID = document.getElementById("fanKui");
		for (let index=0; index < uniqueArr.length; index++) {
			const elem = uniqueArr[index];
			divID.innerHTML += elem+'</br>';
		}
		divID.innerHTML += '-------------------------------------------------------------------------------</br>测试完毕</br>';
		divID.scrollTop = divID.scrollHeight;
	});
}
//网址变量预览
function Gather_preview(){
	$("#fanKui").html('');
	const url = $("input[name='origin_url']").val();
	const min = $("input[name='scope_min']").val();
	const max = $("input[name='scope_max']").val();
	const arr = Gather_a(url,min,max);
	for (let index=0; index < arr.length; index++) {
		const elem = arr[index];
		var divID = document.getElementById("fanKui");
		divID.innerHTML += elem+'</br>';
		divID.scrollTop = divID.scrollHeight;
	}
}
//保存配置
function Gather_btn() {
	if(!$("input[name='Toname']").val()){layer.alert('规则名称不可为空', {icon: 2});return;}
	if(!$("input[name='origin_url']").val()){layer.alert('起始网址不可为空', {icon: 2});return;}
	layer.confirm('是否确认保存采集规则？', {
		area: ['110px', 'auto'],
		title: '温馨提示',
		btn: ['确定', '取消'] //按钮
	}, function(index) {
		$.ajax({
			url: GATHER+"usr/plugins/Piano_gather/main.php?Gather=btn",
			type: "post",
			data: $('#Gather_Post').serialize(),
			dataType: "json",
			success: function(result) {
				if(result.code == 200){
					layer.alert(result.message, {icon: 1}, function(){location.reload();});
				}else{
					layer.alert(result.message, {icon: 2});
				}
			}
		});
		layer.close(index);
	});
}
//删除配置
function Gather_dell(id) {
	layer.confirm('是否删除该条采集规则？', {
		area: ['110px', 'auto'],
		title: '温馨提示',
		btn: ['确定', '取消'] //按钮
	}, function(index) {
		$.ajax({
			url: GATHER+"usr/plugins/Piano_gather/main.php?Gatherss=dell",
			type: "post",
			data: {pid:id},
			dataType: "json",
			success: function(result) {
				if(result.code == 200){
					layer.alert(result.message, {icon: 1}, function(){location.reload();});
				}else{
					layer.alert(result.message, {icon: 2});
				}
			}
		});
		layer.close(index);
	});
}
function Bt_buton() {
	$.ajax({
		url: GATHER+"admin/options-plugin.php?config=Piano_gather&action=setting",
		type: "post",
		data: {bt:$("#BT_PANEL").val(),api:$("#BT_KEY").val(),mishi:$("#BT_MISHI").val()},
		dataType: "json",
	});
}
//宝塔任务开启
function BT_Button(id) {
	layer.prompt({title: '输入结束页数，默认从1开始', formType: 1}, function(hour, index){
		layer.close(index);
			layer.open({
			  type: 1,
			  shade: true,
			  area: ['600px', 'auto'],
			  title: '手动计划任务说明',
			  content: '<div style="padding:20px 15px;">宝塔计划任务选择访问URL，URL填写以下地址,设置好任务名称和执行周期</br>URL地址：<span style="color:#E53333;">'+GATHER+'usr/plugins/Piano_gather/bt.php?cid='+id+'&max='+hour+'&key='+Jihuarw+'</span></div>', 
			});
	});

}
//插入网址变量
function Gather_variable(){
	const inputElement = document.getElementById("origin_url"); // 获取输入框元素
	const textToInsert = "[地址参数]"; // 要插入的文本
	const currentPosition = inputElement.selectionStart; // 获取光标位置
	const newValue = inputElement.value.slice(0, currentPosition) + textToInsert + inputElement.value.slice(currentPosition); // 将文本插入输入框中
	inputElement.value = newValue; // 更新输入框的值
	inputElement.selectionStart = currentPosition + textToInsert.length; // 将光标移动到插入文本的末尾
	inputElement.selectionEnd = currentPosition + textToInsert.length;
}
//网址生成
function Gather_a(url,min,max) {
	var arr = [];
	for (let i = parseInt(min); i <= max; i++) {
		const newUrl = url.replace("[地址参数]", i);
		arr.push(newUrl);
	}
	return arr;
}
//取源码
function Gather_Url(url, callback) {
	var xhr = new XMLHttpRequest();
	xhr.open('GET', GATHER+"usr/plugins/Piano_gather/main.php?User=caiji&url="+url, true);
	xhr.send();
	xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
		var responseText = xhr.responseText;
		callback(responseText);
    }
  }
}
let myGlobalVariable = 'Hello world!';
//线程采集
function Gather_Button(id) {
	layer.confirm('是否开始采集数据？', {
		area: ['110px', 'auto'],
		title: '温馨提示',
		btn: ['确定', '取消'] //按钮
	}, function(index) {
		$("input[name='Blog_edit']").val(id);
		$("#fanKui").html('');
		const url = JSON_DATAS[id].origin_url;
		const min = JSON_DATAS[id].scope_min;
		const max = JSON_DATAS[id].scope_max;
		const arr = Gather_a(url,min,max);
		loopThroughArray(arr,JSON_DATAS[id],0);
		layer.close(index);
	});
}
function loopThroughArray(array,data,index) {
	const Class = data.tabulation_Class;
	var divID = document.getElementById("fanKui");
	if (index < array.length) {
		divID.innerHTML += '<span style="color:#fff;">【 处理页面 】'+array[index]+'</span></br>';
		Gather_Url(array[index], function(responseText) {
			var arr = [];
			var $html = $('<div>').html(responseText);
			const containon = data.tabulation_containon;
			const containoff = data.tabulation_containoff;
			if(Class.indexOf(".") != -1){
				var $links = $html.find(Class+' a');
			}else if(Class.indexOf("#") != -1){
				var $links = $html.find(Class+' a');
			}else if(Class.indexOf("*") != -1){
				var match = Class.match(/^(.*?)\*(.*)$/);
				var $linurl = $('<div>').html(getSubstr_among(responseText,match[1],match[2]));
				var $links = $linurl.find('a');
			}else{
				var $links = $html.find('a');
			}
			$links.each(function() {
				var linkes = $(this).attr('href');
				var Urla = document.createElement('a');
				Urla.href = array[index];
				var baseUrl = Urla.protocol + "//" + Urla.host;
				if(linkes && linkes.indexOf("http") !== 0) { // 判断是否需要补全
					var linkes = baseUrl+linkes;
				}
				if(containon){
					if (linkes.indexOf(containon) !== -1) {
						if(containoff){
							if (linkes.indexOf(containoff) === -1) {
								arr.push(linkes);
							}
						}else{
							arr.push(linkes);
						}
					}
				}else{
					if(containoff){
						if (linkes.indexOf(containoff) === -1) {
							arr.push(linkes);
						}
					}else{
						arr.push(linkes);
					}
				}
			});
			var uniqueArr = [...new Set(arr)];
			loopThroughArrays(array,data,index,uniqueArr,0);
		});
	} else {
		divID.innerHTML += '<span style="color:#fff;">采集完成</span>';
		divID.scrollTop = divID.scrollHeight;
	}
}
function loopThroughArrays(array,data,index,arr,i) {
	var divID = document.getElementById("fanKui");
	if (i < arr.length) {
		divID.innerHTML += '<span style="color:#767b8d;margin-left:35px">-----------------------------------------------------------</span></br><span style="color:#aad32d;margin-left:30px">【 获取正文 】</span>'+arr[i]+'</br>';
		Gather_storage(array,data,index,arr,i,arr[i]);
	} else {
		divID.innerHTML += '<span style="color:#767b8d;margin-left:35px">-----------------------------------------------------------</span></br></br>';
		divID.scrollTop = divID.scrollHeight;
		setTimeout(() => loopThroughArray(array,data,index + 1), 0); // 使用setTimeout模拟异步操作
	}
}
function Gather_storage(array,data,index,arr,i,url) {
	var divID = document.getElementById("fanKui");
	Gather_Url(arr[i], function(responseText) {
		var $html = $('<div>').html(responseText);
		var temp = document.createElement('div');
		temp.innerHTML = responseText;
		var keywordsEl = temp.querySelector('meta[name="keywords"]');
		var keywords = keywordsEl ? keywordsEl.getAttribute('content') : '';
		var descriptionEl = temp.querySelector('meta[name="description"]');
		var description = descriptionEl ? descriptionEl.getAttribute('content') : '';
		var sort = data.Blog_sort;
		var Class = data.Blog_Class;
		var Contsort = data.Blog_contsort;
		var ContClass = data.Blog_contClass;
		var Blog_replace = data.Blog_replace;
		var Fun_Class = data.Fun_Class;
		var Blog_delete = data.Blog_delete;
		var Blog_delete = Blog_delete.replace(/\\/g, "\\");
		if(Class.indexOf(".") != -1){
			var title = $html.find(Class).html();
		}else if(Class.indexOf("#") != -1){
			var title = $html.find(Class).html();
		}else if(Class.indexOf("*") != -1){
			var match = Class.match(/^(.*?)\*(.*)$/);
			var title = getSubstr_among(responseText,match[1],match[2]);
		}else{
			var match = /<title>([\s\S]*?)<\/title>/i.exec(responseText);
			var title = match[1];
		}
		if(Fun_Class){
			$html.find(Fun_Class).remove();
			var $html = $($html.html());
		}
		const newContClass = ContClass.replace('，', ',');
		if(newContClass.trim() === ''){
			var content = '没有指定采集位置';//暂无
		}else if(newContClass.indexOf("*") != -1){
			var matchs = newContClass.match(/^(.*?)\*(.*)$/);
			var content = getSubstr_among(responseText,matchs[1],matchs[2]);
		}else{
			var elementsContent = $html.find(newContClass).map(function() {
			  return $(this).html();
			}).get();
			var content = elementsContent.join("\n");
		}
// 		var turndownService = new window.TurndownService();
// 		var content = turndownService.turndown(content);
		if(Blog_replace){
			const lines = Blog_replace.split("\n");
			lines.forEach(function(line) {
				var match = line.match(/^(.*?)\----(.*)$/);
				try {
					content = content.replace(new RegExp(match[1], "g"), match[2]);
					description = description.replace(new RegExp(match[1], "g"), match[2]);
					keywords = keywords.replace(new RegExp(match[1], "g"), match[2]);
					title = title.replace(new RegExp(match[1], "g"), match[2]);
				} catch (e) {}
			});
		}
		if(Blog_delete){
			let index = content.indexOf(Blog_delete);
			if (index !== -1) {
				var content = content.substring(0, index);
			}
		}
		let newcontent = null
			newcontent = content;
		let newCode = replaceAllImages(newcontent, url);
		$.ajax({
			url: GATHER+"usr/plugins/Piano_gather/main.php?posts=blog",
			type: "post",
			data: {id:$("input[name='Blog_edit']").val(),title:title,content:newCode,excerpt:description,sort:data.sortid,uid:data.author,cover:'',log_tags:keywords,url:url},
			dataType: "json",
			success: function(result) {
				divID.innerHTML += '<span style="color:#f7ffe0;margin-left:30px">【 文章标题 】</span>'+title+'</br><span style="color:#f7ffe0;margin-left:30px">【 入库状态 】</span>'+result.message+'</br>';
				divID.scrollTop = divID.scrollHeight;
				setTimeout(() => loopThroughArrays(array,data,index,arr, i + 1), 0); // 使用setTimeout模拟异步操作
			}
		});
	});
}
/**
 * Created by zzg on 2017/4/26.
 */
var  page = {
    "pageId":"",
    "data":null,
    "maxshowpageitem":5,//最多显示的页码个数
    "pagelistcount":10,//每一页显示的内容条数
      "init":function(listCount,currentPage,options){
      	this.data=options.data,
      	this.pageId=options.id,
    this.maxshowpageitem=options.maxshowpageitem,//最多显示的页码个数
    this.pagelistcount=options.pagelistcount//每一页显示的内容条数
    page.initPage(listCount,currentPage);
  },
  /**
     * 初始化数据处理
     * @param listCount 列表总量
     * @param currentPage 当前页
     */
  "initPage":function(listCount,currentPage){
        var maxshowpageitem = page.maxshowpageitem;
        if(maxshowpageitem!=null&&maxshowpageitem>0&&maxshowpageitem!=""){
            page.maxshowpageitem = maxshowpageitem;
        }
        var pagelistcount = page.pagelistcount;
        if(pagelistcount!=null&&pagelistcount>0&&pagelistcount!=""){
            page.pagelistcount = pagelistcount;
        }   
        page.pagelistcount=pagelistcount;
        if(listCount<0){
            listCount = 0;
        }
        if(currentPage<=0){
            currentPage=1;
        }
        page.setPageListCount(listCount,currentPage);
   },
    /**
     * 初始化分页界面
     * @param listCount 列表总量
     */
    "initWithUl":function(listCount,currentPage){
        var pageCount = 1;
        if(listCount>=0){
            var pageCount = listCount%page.pagelistcount>0?parseInt(listCount/page.pagelistcount)+1:parseInt(listCount/page.pagelistcount);
        }
        var appendStr = page.getPageListModel(pageCount,currentPage);
        $("#"+page.pageId).html(appendStr);
    },
    /**
     * 设置列表总量和当前页码
     * @param listCount 列表总量
     * @param currentPage 当前页码
     */
    "setPageListCount":function(listCount,currentPage){
        listCount = parseInt(listCount);
        currentPage = parseInt(currentPage);
        page.initWithUl(listCount,currentPage);
        page.initPageEvent(listCount);
        page.viewPage(currentPage,listCount,page.pagelistcount,page.data)
//      fun(currentPage);
    },
    //页面显示功能
     "viewPage":function (currentPage,listCount,pagelistcount,data){
            var NUM=listCount%pagelistcount==0?listCount/pagelistcount:parseInt(listCount/pagelistcount)+1;
            if(currentPage==NUM){
                var result=data.slice((currentPage-1)* pagelistcount,data.length);
            }
            else{
                var result=data.slice((currentPage-1)*pagelistcount,(currentPage-1)*pagelistcount+pagelistcount);
            }
            options.callBack(result);
    },
    "initPageEvent":function(listCount){
        $("#"+page.pageId +">li[class='pageItem']").on("click",function(){
            page.setPageListCount(listCount,$(this).attr("page-data"),page.fun);
        });
    },
    "getPageListModel":function(pageCount,currentPage){
        var prePage = currentPage-1;
        var nextPage = currentPage+1;
        var prePageClass ="pageItem";
        var nextPageClass = "pageItem";
        if(prePage<=0){
            prePageClass="pageItemDisable";
        }
        if(nextPage>pageCount){
            nextPageClass="pageItemDisable";
        }
        var appendStr ="";
        appendStr+="<li class='"+prePageClass+"' page-data='"+prePage+"' page-rel='prepage'>上一页</li>";
        var miniPageNumber = 1;
        if(currentPage-parseInt(page.maxshowpageitem/2)>0&&currentPage+parseInt(page.maxshowpageitem/2)<=pageCount){
            miniPageNumber = currentPage-parseInt(page.maxshowpageitem/2);
        }else if(currentPage-parseInt(page.maxshowpageitem/2)>0&&currentPage+parseInt(page.maxshowpageitem/2)>pageCount){
            miniPageNumber = pageCount-page.maxshowpageitem+1;
            if(miniPageNumber<=0){
                miniPageNumber=1;
            }
        }
        var showPageNum = parseInt(page.maxshowpageitem);
        if(pageCount<showPageNum){
            showPageNum = pageCount;
        }
        for(var i=0;i<showPageNum;i++){
            var pageNumber = miniPageNumber++;
            var itemPageClass = "pageItem";
            if(pageNumber==currentPage){
                itemPageClass = "pageItemActive";
            }
            appendStr+="<li class='"+itemPageClass+"' page-data='"+pageNumber+"' page-rel='itempage'>"+pageNumber+"</li>";
        }
        appendStr+="<li class='"+nextPageClass+"' page-data='"+nextPage+"' page-rel='nextpage'>下一页</li>";
       return appendStr;
    }
}