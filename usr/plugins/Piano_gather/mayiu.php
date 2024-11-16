<?php 
$content = ob_get_clean();
$options = Typecho_Widget::widget('Widget_Options');
require __DIR__ . '/config.php';
$MayiConfig = @file_get_contents(__DIR__ . './config.json');
if(!$MayiConfig){
	$MayiConfig1 = @file_get_contents(__DIR__ . '/config.json');
	if(!$MayiConfig1){
		$MayiConfig2 = @file_get_contents($options->siteUrl.'usr/plugins/Piano_gather/config.json');
		$MayiConfig = $MayiConfig2;
	}else{
		$MayiConfig = $MayiConfig1;
	}
}
?>
<link href="<?php echo $options->siteUrl; ?>usr/plugins/Piano_gather/js/layui.css" rel="stylesheet">
<script src="<?php echo $options->siteUrl; ?>admin/js/jquery.js?v=1.2.1"></script>
<script type="text/javascript">let GATHER = '<?php echo $options->siteUrl; ?>';let Jihuarw = '<?php echo $BT_config["BT_MISHI"];?>';</script>
<script src="<?php echo $options->siteUrl; ?>usr/plugins/Piano_gather/js/turndown.js"></script>
<script src="<?php echo $options->siteUrl; ?>usr/plugins/Piano_gather/js/layer/layer.js"></script>
<script charset="utf-8" src="<?php echo $options->siteUrl; ?>usr/plugins/Piano_gather/js/Mass_Emall.js"></script>
<div id="Piano_message"></div>
<div class="layui-row layui-col-space15" style="max-width: 1300px;margin: 0 auto;">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md7">
      <div class="layui-card">
        <div class="layui-card-header">卡片面板</div>
        <div class="layui-card-body">
		<form id="Gather_Post">
			<div class="yyui_tab">
				<ul>
					<li class="yyui_tab_title_this">规则</li>
					<li class="yyui_tab_title">网址</li>
					<li class="yyui_tab_title">列表</li>
					<li class="yyui_tab_title">内容</li>
					<li class="yyui_tab_title">入库</li>
					<li class="yyui_tab_title">密匙</li>
					<li class="yyui_tab_title">使用说明</li>
					<a class="layui-btn layui-btn-normal" style="position: absolute;right:16px;text-decoration-line: none;height:37px;line-height:36px;width: 74px;padding: 0 5px;border-radius:0px" href="javascript:Gather_btn();">保存配置</a>
				</ul>
				<div class="yyui_tab_content_this">
					<table class="layui-table">
						<thead>
						  <tr>
							<th style="width:60px">序号</th>
							<th>名称</th>
							<th style="width:60px">页数</th>
							<th style="width:70px">自动采集</th>
							<th style="width:160px">操作<a style="float:right" href="javascript:Online_rule();">在线规则</a></th>
						  </tr> 
						</thead>
						<tbody id="demoContent"></tbody>
					</table>	
					<ul class="page" id="page"></ul>
				</div>
				<div class="yyui_tab_content">
					<div class="layui-card">
						<div class="layui-card-header">网址采集规则<a style="float:right" href="javascript:Gather_preview();">生成预览</a></div>
						<div class="layui-card-body">
							<div class="layui-form-item">
								<label class="layui-form-label">采集规则名称</label>
								<input type="text" name="Toname" placeholder="分类采集" class="layui-input">
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">起始网址<a style="float:right" href="javascript:Gather_variable();">[地址参数]</a>
								</label>
								<input type="text" name="origin_url" id="origin_url" placeholder="http://www.qinyin.com/page/[地址参数]"
								class="layui-input">
							</div>
							<div class="layui-form-item">
								<div class="layui-inline">
									<label class="layui-form-label">数字范围</label>
									<div class="layui-input-inline" style="width: 100px;">
										<input type="text" name="scope_min" value="1" class="layui-input">
									</div>
									<div class="layui-form-mid">-</div>
									<div class="layui-input-inline" style="width: 100px;">
										<input type="text" name="scope_max" value="10" class="layui-input">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="yyui_tab_content">
					<div class="layui-card">
						<div class="layui-card-header">网址列表规则<a style="float:right" href="javascript:Take_Url();">测试</a></div>
						<div class="layui-card-body">
							<div class="layui-form-item">
								<label class="layui-form-label">测试网址</label>
								<input type="text" name="tabulation_url" placeholder="网址" class="layui-input">
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">指定元素 <span class="layui-badge layui-bg-green" onclick="Additional(this,'tabulation_Class')">.</span> <span class="layui-badge layui-bg-green" onclick="Additional(this,'tabulation_Class')">#</span> <span class="layui-badge layui-bg-green" onclick="Additional(this,'tabulation_Class')">*</span></label>
								<input type="text" name="tabulation_Class" placeholder="变量" class="layui-input">
							</div>
							<div class="layui-row layui-col-space15">
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">必须包含</label>
										<input type="text" name="tabulation_containon" placeholder="html" class="layui-input">
									</div>
								</div>
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">不得包含</label>
										<input type="text" name="tabulation_containoff" placeholder="php" class="layui-input">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="yyui_tab_content">
					<div class="layui-card">
						<div class="layui-card-header">内容页规则<a style="float:right" href="javascript:Blog_Url();">测试</a></div>
						<div class="layui-card-body">
							<div class="layui-form-item">
								<label class="layui-form-label">测试网址</label>
								<input type="text" name="Blog_url" placeholder="网址" class="layui-input">
							</div>
							<div class="layui-row layui-col-space15">
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">标题指定元素 <span class="layui-badge layui-bg-green" onclick="Additional(this,'Blog_Class')">.</span> <span class="layui-badge layui-bg-green" onclick="Additional(this,'Blog_Class')">#</span> <span class="layui-badge layui-bg-green" onclick="Additional(this,'Blog_Class')">*</span></label>
										<input type="text" name="Blog_Class" placeholder="变量" class="layui-input">
									</div>
								</div>
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">内容指定元素 <span class="layui-badge layui-bg-green" onclick="Additional(this,'Blog_contClass')">.</span> <span class="layui-badge layui-bg-green" onclick="Additional(this,'Blog_contClass')">#</span> <span class="layui-badge layui-bg-green" onclick="Additional(this,'Blog_contClass')">*</span></label>
										<input type="text" name="Blog_contClass" placeholder="变量" class="layui-input">
									</div>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">删除内容指定元素</label>
								<input type="text" name="Fun_Class" placeholder="多个元素用,隔开 例如.mzsm, .widget" class="layui-input">
							</div>
							<div class="layui-row layui-col-space15">
								<div class="layui-col-md12">
									<div class="layui-form-item">
										<label class="layui-form-label">删除指定文本及后面文本</label>
										<input type="text" name="Blog_delete" class="layui-input">
									</div>
								</div>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">标题/内容/标签/摘要 替换（原文本----替换后）一行一条</label>
								<textarea name="Blog_replace" placeholder="请输入内容" class="layui-textarea"></textarea>
							</div>
							<div class="layui-form-item">
								<label class="layui-form-label">增强功能</label>
								<div class="RadioStyle">
									<div class="Block PaddingL">
										<input type="checkbox" name="Fun_img" id="love1" />
										<label for="love1">图片本地化</label>
										<input type="checkbox" name="Fun_tag" id="love2" />
										<label for="love2">标签/摘要入库</label>
									</div>
								</div>
							</div>
							<div class="layui-row layui-col-space15">
								<div class="layui-col-md12">
									<div class="layui-form-item">
										<label class="layui-form-label">正则替换指定超文本链接</label>
										<input type="text" name="Blog_regular" class="layui-input">
									</div>
								</div>
							</div>
							<div class="layui-form-item" style="display: none;">
								<label class="layui-form-label">可执行php脚本(入库前处理)</label>
								<textarea name="Blog_canonical" placeholder="请注意，此功能不可乱填，不懂的请留空，乱填造成的一切损失概不负责&#10;$title：标题&#10;$content：内容&#10;$excerpt：摘要&#10;$cover：封面图" class="layui-textarea"></textarea>
							</div>
							<div class="layui-form-item" style="display: none;">
								<label class="layui-form-label">可执行php脚本(入库时处理)</label>
								<textarea name="logData_canonical" placeholder="请注意，此功能不可乱填，不懂的请留空，乱填造成的一切损失概不负责&#10;$logData：是一个数组，它包含了&#10;title，content，excerpt，sortid，cover，author，hide，date&#10;你可以在$logData数组里追加你想要的字段" class="layui-textarea"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="yyui_tab_content">
					<div class="layui-card">
						<div class="layui-card-header">默认文章分类设置（获取分类方法：数据库文件：typecho_metas 对应的UID就是文章分类）</div>
						<div class="layui-card-body">
							<div class="layui-row layui-col-space15">
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">发布文章分类ID</label>
										<input type="text" name="sortid" class="layui-input">
									</div>
								</div>
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">文章作者ID</label>
										<input type="text" name="author" class="layui-input">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">增强插件设置【默认关闭状态，请点击开启】</label>
						<div class="RadioStyle">
							<div class="Block PaddingL">
								<input type="checkbox" name="sort_2" id="love3" />
								<label for="love3">【圈子帖子采集】开/关</label>
								<input type="checkbox" name="sort_hide" id="love4" />
								<label for="love4">【隐藏回复可见】开/关</label>
							</div>
						</div>
					</div>
					<div class="layui-card">
						<div class="layui-card-header">圈子帖子分类设置（获取分类方法：数据库文件：typecho_forum_section 对应的ID就是圈子分类）</div>
						<div class="layui-card-body">
							<div class="layui-row layui-col-space15">
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">帖子发布分类ID</label>
										<input type="text" name="sortid1" class="layui-input">
									</div>
								</div>
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">帖子发布子ID</label>
										<input type="text" name="sortid2" class="layui-input">
									</div>
								</div>
								<div class="layui-col-md6">
									<div class="layui-form-item">
										<label class="layui-form-label">帖子作者ID</label>
										<input type="text" name="author1" class="layui-input">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="yyui_tab_content">
					<div class="layui-form-item">
						<label>宝塔计划任务密匙</label>
						<input type="tel" id="BT_MISHI" class="layui-input" value="<?php echo $BT_config['BT_MISHI'];?>">
					</div>
					<div class="layui-form-item">
						<button type="button" class="layui-btn" onclick="Bt_buton()">保存配置</button>
					</div>
				</div>
				<div class="yyui_tab_content">
				  <div class="layui-card">
					<div class="layui-card-header">示例代码</div>
					<div class="layui-card-body">
						<div class="alert alert-success">&lt;div class="art-content" id="content"&gt;内容&lt;/div&gt;</div>
						取中间文本用通配符 <span style="color:#4C33E5;">*</span> 表示要取的内容</br>
						<span style="color:#4C33E5;">&lt;div class="art-content"&gt;</span><span style="color:#4C33E5;">*</span><span style="color:#4C33E5;">&lt;/div&gt;</span></br>
						取指定class元素内容用 <span style="color:#4C33E5;">.</span> 表示</br>
						<span style="color:#4C33E5;"></span><span style="color:#4C33E5;">.art-content</span></br>
						取指定ID内容用 <span style="color:#4C33E5;">#</span> 表示</br>
						<span style="color:#4C33E5;">#content</span></br></br>
						免费版本会有适当的广告并且不支持使用图片本地化/自动采集/可执行代码/标签摘要入库
					</div>
				  </div>
				</div>
			</div>
			<input type="hidden" name="Blog_edit" value="-1">
		</form>
        </div>
      </div>
    </div>
    <div class="layui-col-md5">
      <div class="layui-card">
        <div class="layui-card-header"><svg t="1663668765124" style="margin-top:-3px" class="icon" viewBox="0 0 1024 1024" version="1.1" p-id="2343" width="15" height="15"><path d="M268.780203 512.006305A243.638379 243.638379 0 1 0 512.418581 268.367927 244.142806 244.142806 0 0 0 268.780203 512.006305z m412.117092 0A167.974286 167.974286 0 1 1 512.418581 344.032019 168.478713 168.478713 0 0 1 680.392867 512.006305z" fill="#438CFF" p-id="2437"></path><path d="M947.739329 476.696395v7.061982a34.301055 34.301055 0 0 0 40.354182 30.770065 40.85861 40.85861 0 0 0 34.301056-44.389601A511.993695 511.993695 0 1 0 512.418581 1024a514.515831 514.515831 0 0 0 478.197067-329.391017 37.832046 37.832046 0 0 0-70.61982-27.239074 436.329602 436.329602 0 1 1 27.239073-190.673514z" fill="#438CFF" p-id="2438"></path></svg> 状态检测<a style="float:right" target="_blank" href="https://www.baidu.com">视频教程</a></div>
        <div class="layui-card-body piano_article" id="fanKui" style="background-color: rgb(51,51,51);color: #f1f1f1;max-height:600px;overflow:auto">
			【状态检测】</br>
			-------------------------------------------------------------------------------</br>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
let JSON_DATAS=<?php echo $MayiConfig;?>;
var options={
	"id":"page",//显示页码的元素
	"data":JSON_DATAS,//显示数据
	"maxshowpageitem":3,//最多显示的页码个数
	"pagelistcount":12,//每页显示数据个数
	"callBack":function(result){
		var cHtml="";
		for(var i=0;i<result.length;i++){
			cHtml+='<tr><td style="text-align:center;">'+i+'</td><td>'+ result[i].Toname+'</td><td style="text-align:center;">'+ result[i].scope_min+'/'+ result[i].scope_max+'</td><td style="text-align:center;"><button type="button"class="layui-btn layui-btn-xs layui-btn-normal"onclick="BT_Button('+i+')">查看</button></td><td style="text-align:center;"><button type="button"class="layui-btn layui-btn-xs layui-btn-danger"onclick="Gather_dell('+i+')">删除</button><button type="button"class="layui-btn layui-btn-xs"onclick="Gather_paste('+i+')">编辑</button><button type="button"class="layui-btn layui-btn-xs layui-btn-normal"onclick="Gather_Button('+i+')">采集</button></td></tr>';//处理数据
		}
		$("#demoContent").html(cHtml);//将数据增加到页面中
	}
};
page.init(JSON_DATAS.length,1,options);
$("#menu_ext").addClass('show');
$("#Piano_gather").addClass('active');
</script>
<?php 
if( @$_GET['action'] == 'setting' &&isset($_GET['action'])){
	require __DIR__ . '/config.php';
	$newConfig = '<?php
	$BT_config = array(
		"BT_MISHI" => "'.$_POST["mishi"].'",
	);';
	echo $newConfig;
	@file_put_contents(__DIR__ . '/config.php', $newConfig);
}
?>
<?php exit;?>