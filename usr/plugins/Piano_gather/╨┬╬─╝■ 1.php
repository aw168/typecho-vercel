<?php
define('__TYPECHO_ADMIN__', true);
if (!defined('__TYPECHO_ROOT_DIR__') && !@include_once '../../../config.inc.php') {}
\Widget\Init::alloc();
\Widget\Options::alloc()->to($options);
// function Piano_DoMain($url){
	// if(empty($url)){return '';}
	// if(strpos($url,'http://') !== false){$url = str_replace('http://','',$url);}
	// if(strpos($url,'https://') !== false){$url = str_replace('https://','',$url);}
	// $n = 0;
	// for($i = 1;$i <= 3;$i++) {$n = strpos($url, '/', $n);$i != 3 && $n++;}
	// $nn = strpos($url, '?');
	// $mix_num =  min($n,$nn);
	// if($mix_num > 0 || !empty($mix_num)){$url = mb_substr($url,0,$mix_num);}
	// $data = explode('.', $url);
	// $co_ta = count($data);
	// $no_tow = true;
	// $host_cn = 'com.cn,net.cn,org.cn,gov.cn';
	// $host_cn = explode(',', $host_cn);
	// foreach($host_cn as $val){if(strpos($url,$val)){$no_tow = false;}}
	// $del = strpos($data[$co_ta-1], '/');
	// if($del > 0 || !empty($del)){$data[$co_ta-1] = mb_substr($data[$co_ta-1],0,$del);}
	// if($no_tow == true){$host = $data[$co_ta-2].'.'.$data[$co_ta-1];}else{$host = $data[$co_ta-3].'.'.$data[$co_ta-2].'.'.$data[$co_ta-1];}
	// return $host;
// }
// $Piano_pid = '42';//应用ID
// $Piano_code = 'M8P10V57QJ8BWOEGK46IBXRSU';//应用KEY
// $Piano_domain = Piano_DoMain(strtolower($_SERVER["HTTP_HOST"])).'----'.gethostbyname($_SERVER["SERVER_NAME"]);
// $Piano_arr1 = explode("----", $Piano_domain);
// $Piano_arr2 = array();
// foreach ($Piano_arr1 as $val) {$Piano_arr2[] = $val;}
// $Piano_opts = ["ssl" => ["verify_peer"=>false,"verify_peer_name"=>false,]];
// $Piano_File = fopen($_SERVER['DOCUMENT_ROOT']."/content/plugins/Piano_gather/auth.ini", "r");
// if(!$Piano_File){exit("【错误代码】200</br>【错误提示】授权文件不存在</br>【联系作者】QQ：827665774");}
// $Piano_auth = fread($Piano_File,filesize($_SERVER['DOCUMENT_ROOT']."/content/plugins/Piano_gather/auth.ini"));
// $Piano_Key = <<<___
// -----BEGIN PUBLIC KEY-----
// MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnwAJdro9ndc0M4/vEjiB
// e3XaIktsvEXwmaOFErOGWamtkga5QCgr96fJEq6Z6NIkqBAJVxLSRG+8+AQCGHpZ
// HVThacSmR0Y5lbY3Zi0pu3xcvJVOJ7qrPZ04OLPGGpwU0vsfUtSBSiKEJB/CBSIq
// E5k/5ULbLMp2Lw1DTE5m9pfZBvgoWoFlKhWDJRdm9bthJZrNjwAQWV7Qxn+vZZzO
// 713tTC7bLsxt2dV1QMZgyhNhs48f53BfiPMq/9WQq66LurgfIGcpheQD4+b3+oLo
// KuifUzdP9pt2h8/ah0OA1huOrZvJXpc/lFrOXsWdU9DsPBlOrdPFruIMRXatPTwq
// yQIDAQAB
// -----END PUBLIC KEY-----
// ___;
// if (openssl_public_decrypt(base64_decode($Piano_auth), $Piano_tedAuth, $Piano_Key)){
	// $Piano_data = json_decode($Piano_tedAuth, true);
	// if (in_array($Piano_data["url"], $Piano_arr2)) {
		// if($Piano_data["code"] === $Piano_code){
			// if(time() > $Piano_data["time"]){
				// $Piano_url = 'https://app.su1018.cn/content/templates/qinyin_app/json/application.php?renew=empower&pid='.$Piano_pid.'&data='.$Piano_domain;
				// $Piano_result = file_get_contents($Piano_url, false, stream_context_create($Piano_opts));
				// $Piano_filename = $_SERVER['DOCUMENT_ROOT']."/content/plugins/Piano_gather/auth.ini";
				// if (file_put_contents($Piano_filename, $Piano_result)) {
					// header("Refresh:0");
				// } else {
					// echo '授权信息写入失败';
				// }
			// }
		// }else{
			// exit("【错误代码】203</br>【错误提示】KEY验证失败</br>【联系作者】QQ：827665774");
		// }
	// } else {
		// exit("【错误代码】202</br>【错误提示】没有找到您的授权信息</br>【联系作者】QQ：827665774");
	// }
// }else{
	// exit("【错误代码】201</br>【错误提示】授权文件错误</br>【联系作者】QQ：827665774");
// }
require_once 'config.php';
$cid = isset($_GET['cid']) ? addslashes(trim($_GET['cid'])) : 1;
$min = isset($_GET['min']) ? addslashes(trim($_GET['min'])) : 1;
$max = isset($_GET['max']) ? addslashes(trim($_GET['max'])) : 1;
$key = isset($_GET['key']) ? addslashes(trim($_GET['key'])) : '';
if($key != $BT_config["BT_MISHI"]){
	echo '计划任务密匙错误';exit;
}
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
$configData = json_decode($MayiConfig, TRUE);
require_once 'phpQuery.php';
if(isset($_GET['start'])){
	
	
	$start = intval($_GET['start']);
	$filename = __DIR__ . '/cache/'.$configData[$cid]["Toname"].'.txt';
	$lines = file($filename);
	$numLines = count($lines);//总共有多少行
	if ($start > 0 && $start <= $numLines) {
		$lineContent = $lines[$start - 1]; // 数组索引是从 0 开始的，所以要减去 1
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		var_dump($lineContent);
	} else {
		echo "指定的行号无效。";
	}
	
	
	
	
}else{
	//开始采集
	for ($i = $min; $i <= $max; $i++) {
		$url = str_replace("[地址参数]", $i, $configData[$cid]["origin_url"]);
		$doc = phpQuery::newDocumentFile($url);
		// 创建一个空数组来保存所有的网址
		$links = array();
		// 遍历所有的链接元素，获取 href 属性并保存到数组中
		foreach ($doc->find($configData[$cid]["tabulation_Class"])->find('a') as $link) {
			$href = pq($link)->attr('href');
			if ($href) {
				$parsed = parse_url($url)["scheme"].'://'.parse_url($url)["host"];
				if(strstr($href,'http')){ 
					$href = $href;
				}else{
					$href = $parsed.$href;
				}
				if($configData[$cid]["tabulation_containon"]){
					if($configData[$cid]["tabulation_containoff"]){//必须包含
						//必须包含和不包含同时
						if (strpos($href, $configData[$cid]["tabulation_containon"]) !== false && strpos($href, $configData[$cid]["tabulation_containoff"]) === false) { 
							$links[] = $href;
						}
					}else{
						if (strpos($href, $configData[$cid]["tabulation_containon"]) !== false) { 
							$links[] = $href;
						}
					}
				}elseif($configData[$cid]["tabulation_containoff"]){//不得包含
					if (strpos($href, $configData[$cid]["tabulation_containoff"]) === false) { 
						$links[] = $href;
					}
				}else{
					$links[] = $href;
				}
			}
		}
		// 去重复
		$links = array_unique($links);
		// 文件路径，使用正斜杠表示路径
		$filename = __DIR__ . '/cache/'.$configData[$cid]["Toname"].'.txt';

		// 检查目标文件夹是否存在，如果不存在则创建
		if (!is_dir(dirname($filename))) {
			mkdir(dirname($filename), 0777, true); // 递归创建目录
		}

		// 使用file_put_contents函数将数据写入文件
		$result = file_put_contents($filename, implode(PHP_EOL, $links));

		// 检查写入是否成功
		if ($result !== false) {
			echo '数据已成功写入文件';
		} else {
			echo '写入文件失败';
		}
	}
}














exit;

























//取文本中间
function get_string_between($string, $start, $end){
    $start_pos = strpos($string, $start);
    if ($start_pos !== false) {
        $end_pos = strpos($string, $end, $start_pos + strlen($start));
        if ($end_pos !== false) {
            $length = $end_pos - $start_pos - strlen($start);
            return substr($string, $start_pos + strlen($start), $length);
        }
    }
    return false;
}
//获取源码
function source_code($url){
	$UserAgent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36';
	$curl = curl_init(); 
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_ENCODING, '');
	curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	$html = curl_exec($curl);
	curl_close($curl); 
	if($html){
		return $html;
	}else{
		$result = file_get_contents($url);
		return $result;
	}
}




//批量替换
function blog_tihuan($content,$tihuan) {
	$lines = explode("\n", $tihuan);
	foreach ($lines as $line) {
		$pos = strpos($line, "----");
		if ($pos !== false) {
			$before = substr($line, 0, $pos);
			$after = substr($line, $pos + strlen("----"));
			$field[] = $before;
			$fields[] = $after;
		}
	}
	$con = str_replace($field, $fields, $content);
	return $con;///<img src=\\\\"(.*?)\\\\"/i
}
//检测php目录不存在则创建
function ActionMkdirs($a1, $mode = 0777){
    if (is_dir($a1) || @mkdir($al, $mode)) return TRUE;
    if (!ActionMkdirs(dirname($a1), $mode)) return FALSE;
    return @mkdir($a1, $mode);
}
/**
 * [SaveImageFromUrl 保存远程图片或文件；
 * $url      图片地址 http://www.xxxx.com/xxxx.jpeg
 * $savePath 保存目录 ./uploadfiles/xxxxx/
 * $saveName 新的文件名 默认空 为空时使用原文件名
 */
function SaveImageFromUrl($url,$savePath,$saveName=''){
	$imageSize = @getimagesize($url);
	if ($imageSize !== false) {
		if(empty($url)||empty($savePath)) return false;
		if (!is_dir($savePath)){
			mkdir($savePath,0777,true);
		}
		$localPath = $savePath . '/' . basename($url);
		file_put_contents($localPath, file_get_contents($url));
		$width = $imageSize[0];
		$height = $imageSize[1];
		$mime = $imageSize["mime"];
		$size = 0;
		$create_time = time();
		$mulu = str_replace(EMLOG_ROOT, "..", $savePath).$saveName;
		// $DB = Database::getInstance();
		// $DB->query("INSERT INTO `emlog_attachment` (`author`, `filename`, `filesize`, `filepath`, `addtime`, `width`, `height`, `mimetype`) VALUES ('1', '$saveName', '$size', '$mulu', '$create_time', '$width', '$height', '$mime')");
		// $wangzhi = str_replace('../', BLOG_URL, $mulu);
		return $wangzhi;
	} else {
		return $url;
	}
}
//图片本地化
function img_localization($content,$cid,$url) {
	$MayiConfig = @file_get_contents(__DIR__ . './config.json');
	if(!$MayiConfig){
		$MayiConfig1 = @file_get_contents(__DIR__ . '/config.json');
		if(!$MayiConfig1){
			$MayiConfig2 = @file_get_contents(BLOG_URL.'content/plugins/Piano_gather/config.json');
			$MayiConfig = $MayiConfig2;
		}else{
			$MayiConfig = $MayiConfig1;
		}
	}
	$configData = json_decode($MayiConfig, TRUE);
	$data = gmdate('Ym');
	// $save_dir = EMLOG_ROOT."/content/uploadfile/".$data.'/';// 定义要下载图片的存储目录
	ActionMkdirs($save_dir);
	if($configData[$cid]['Blog_Markdown'] == 1){
		preg_match_all('/<img[^>]+src="([^"]+)"/i', stripslashes($content), $matches);
		$Img_Arr = $matches[1];
	}else{
		preg_match_all('/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i', $content, $matches);
		$Img_Arr = $matches[1];
	}
	foreach ($Img_Arr as $img_url) {// 遍历匹配到的图片链接
		$host = parse_url($url)["scheme"];
		$segments = explode('.', $host);
		$main_domain = $segments[count($segments) - 2] . '.' . $segments[count($segments) - 1];
		$parsed_url = parse_url($img_url)["host"];
		if (strpos($img_url, $main_domain) != false) {
			//包含主域名
			if(strpos($img_url, 'http') !== false){
				$img_urls = $img_url;
			}else{
				$img_urls = parse_url($url)["scheme"].'://'.$img_url;
			}
		}elseif($parsed_url){
			//不包含主域名但包含前缀
			if(strpos($img_url, 'http') !== false){
				$img_urls = $img_url;
			}else{
				$img_urls = parse_url($url)["scheme"].'://'.$img_url;
			}
		}else{
			//不包含主域名
			$img_urls = parse_url($url)["scheme"].'://'.parse_url($url)["host"].$img_url;
		}
		if($configData[$cid]['Fun_img']){
			$filename = basename($img_urls);    // 从链接中提取文件名
			// $filepath = BLOG_URL.'content/uploadfile/'.$data.'/'. $filename;
			$filepath = SaveImageFromUrl($img_urls,$save_dir,$filename);
		}else{
			$filepath = $img_urls;
		}
		$content = str_replace($img_url, $filepath, $content);	// 替换 HTML 中的图片链接为本地路径
	}
	return $content;
}
//发布
function publish_code($title,$content,$excerpt,$sort,$cover,$author,$cid,$keywords,$url){
	$MayiConfig = @file_get_contents(__DIR__ . './config.json');
	if(!$MayiConfig){
		$MayiConfig1 = @file_get_contents(__DIR__ . '/config.json');
		if(!$MayiConfig1){
			$MayiConfig2 = @file_get_contents(BLOG_URL.'content/plugins/Piano_gather/config.json');
			$MayiConfig = $MayiConfig2;
		}else{
			$MayiConfig = $MayiConfig1;
		}
	}
	$configData = json_decode($MayiConfig, TRUE);
	if($configData[$cid]['Blog_delete']){
		$pos = strstr($content, $configData[$cid]['Blog_delete']); // 查找目标字符串及其后面的内容
		if ($pos !== false) {
		  $content = substr($content, 0, strpos($content, $pos)); // 删除目标字符串及其后面的内容
		}
	}
	if($configData[$cid]['Blog_replace']){
		$lines = explode("\n", $configData[$cid]['Blog_replace']);
		foreach ($lines as $line) {
			$pos = strpos($line, "----");
			if ($pos !== false) {
				$before = substr($line, 0, $pos);
				$after = substr($line, $pos + strlen("----"));
				$field[] = $before;
				$fields[] = $after;
			}
		}
		$content = str_replace($field, $fields, $content);
		$excerpt = str_replace($field, $fields, $excerpt);
		$keywords = str_replace($field, $fields, $keywords);
	}
	if($configData[$cid]['Fun_a']){
		$content = preg_replace('/<a\b[^>]*>(.*?)<\/a>/i', '', $content);
	}
	if($configData[$cid]['Fun_tag']){
		$excerpt = $excerpt;
		$tagstring = $keywords;
	}else{
		$excerpt = '';
		$tagstring = '';
	}
	if($configData[$cid]["Blog_canonical"]){
		eval($configData[$cid]["Blog_canonical"]);
	}
	$content = img_localization($content,$cid,$url);
	$DB = Database::getInstance();
	$Collection = $DB->fetch_array($DB->query("SELECT title FROM ".DB_PREFIX."blog WHERE title='$title'"));
	$ishide = isset($_POST['ishide']) && !empty($_POST['ishide']) && !isset($_POST['pubdf']) ? addslashes($_POST['ishide']) : 'n';
	$time = time();
	doAction('upload_blog');
	$Log_Model = new Log_Model();
	$Tag_Model = new Tag_Model();
	if($Collection){
		echo '【 入库状态 】文章标题已存在！'."\n".'-------------------------------------------------'."\n";
	}else{
		$logData = array(
			'title' => addslashes($title),
			'content' => addslashes($content),
			'excerpt' => addslashes($excerpt),
			'sortid' => $sort,
			'cover' => $cover,
			'author' => $author,
			'hide'   => $ishide,
			'date' => $time,
		);
		if($configData[$cid]["logData_canonical"]){
			eval($configData[$cid]["logData_canonical"]);
		}
		$blogid = $Log_Model->addlog($logData);
		$Tag_Model->addTag($tagstring, $blogid);
		// $CACHE->updateCache();
		doAction('saves_log', $blogid);
		echo '【 入库状态 】入库成功'."\n".'-------------------------------------------------'."\n";
	}
}
//开始采集
for ($i = $min; $i <= $max; $i++) {
	$url = str_replace("[地址参数]", $i, $configData[$cid]["origin_url"]);
	$doc = phpQuery::newDocumentFile($url);
	// 创建一个空数组来保存所有的网址
	$links = array();
	// 遍历所有的链接元素，获取 href 属性并保存到数组中
	foreach ($doc->find($configData[$cid]["tabulation_Class"])->find('a') as $link) {
		$href = pq($link)->attr('href');
		if ($href) {
			$parsed = parse_url($url)["scheme"].'://'.parse_url($url)["host"];
			if(strstr($href,'http')){ 
				$href = $href;
			}else{
				$href = $parsed.$href;
			}
			if($configData[$cid]["tabulation_containon"]){
				if($configData[$cid]["tabulation_containoff"]){//必须包含
					//必须包含和不包含同时
					if (strpos($href, $configData[$cid]["tabulation_containon"]) !== false && strpos($href, $configData[$cid]["tabulation_containoff"]) === false) { 
						$links[] = $href;
					}
				}else{
					if (strpos($href, $configData[$cid]["tabulation_containon"]) !== false) { 
						$links[] = $href;
					}
				}
			}elseif($configData[$cid]["tabulation_containoff"]){//不得包含
				if (strpos($href, $configData[$cid]["tabulation_containoff"]) === false) { 
					$links[] = $href;
				}
			}else{
				$links[] = $href;
			}
		}
	}
	// 去重复
	$links = array_unique($links);
	// 输出所有的网址
	foreach ($links as $link) {
		echo '【 获取网址 】'.$link . "\n";
		$docs = phpQuery::newDocumentFile($link);
		if(strpos($configData[$cid]["Blog_Class"], '.') !== false || strpos($configData[$cid]["Blog_Class"], '#') !== false){ 
			$elements = $docs->find($configData[$cid]["Blog_Class"]);
			$title = trim($elements->text());	
		}elseif(strpos($configData[$cid]["Blog_Class"], '*') !== false){ 
			$position = strpos($configData[$cid]["Blog_Class"], '*');
			$before = substr($configData[$cid]["Blog_Class"], 0, $position); // "The quick "
			$after = substr($configData[$cid]["Blog_Class"], $position + strlen('*')); // " fox jumps over the lazy dog."
			$title = trim(get_string_between($docs->html(), $before, $after));
		}else{
			$title = trim($docs->find('title')->text());
		}
		
		if($configData[$cid]["Fun_Class"]){
			$docs->find($configData[$cid]["Fun_Class"])->remove();
		}
		echo '【 文章标题 】' .$title."\n";
		$meta = $docs->find('meta[name="keywords"]');
		$keywords = $meta->attr('content');
		echo '【 文章标签 】' .$keywords. "\n";	
		$metas = $docs->find('meta[name="description"]');
		$description = $metas->attr('content');
		echo '【 文章描述 】' .$description. "\n";	
		if($configData[$cid]["Fun_Class"]){ 
			$selector = $configData[$cid]["Fun_Class"];
			$elementsToRemove = $docs->find($selector);
			$elementsToRemove->remove();
		}
		$NewcontClass = str_replace("，", ",", $configData[$cid]["Blog_contClass"]);
		if(strpos($NewcontClass, '.') !== false || strpos($NewcontClass, '#') !== false){ 
			$element = $docs->find($NewcontClass);
			$Blog = $element->html();
		}elseif(strpos($NewcontClass, '*') !== false){ 
			$position = strpos($NewcontClass, '*');
			$before = substr($NewcontClass, 0, $position);
			$after = substr($NewcontClass, $position + strlen('*')); 
			$Blog = trim(get_string_between($docs->html(), $before, $after));
		}else{
			$Blog = '未定义正文区域';
		}
		if($configData[$cid]["Blog_Markdown"] == 2){
			$Blog = mb_convert_encoding($Blog, 'HTML-ENTITIES', 'UTF-8');
			$converter = new HtmlToMarkdownConverter($Blog);
			$Blog = $converter->convert();
		}
		$Blog = preg_replace('/^\s+/m', '', $Blog);
		publish_code($title,$Blog,$description,$configData[$cid]["sortid"],'',$configData[$cid]["author"],$cid,$keywords,$link);
	}
}



$documentID = self::createDocumentWrapper(file_get_contents($file), $contentType);








class HtmlToMarkdownConverter{
    protected $html;
    protected $markdown;
    public function __construct($html){
        $this->html = $html;
        $this->markdown = '';
    }
    public function convert(){
        $this->markdown = $this->parseTag($this->html);
        // 移除多余的换行符
        $this->markdown = preg_replace('/\n{3,}/', "\n\n", $this->markdown);
        return $this->markdown;
    }
    protected function parseTag($html){
        $markdown = '';
        $tags = [
            'h1' => '# ',
            'h2' => '## ',
            'h3' => '### ',
            'h4' => '#### ',
            'h5' => '##### ',
            'h6' => '###### ',
            'p' => '',
            'br' => "\n",
            'ul' => "\n",
            'ol' => "\n",
            'li' => '- ',
        ];
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        foreach ($dom->childNodes as $node) {
            $markdown .= $this->parseNode($node, $tags);
        }
        return $markdown;
    }
    protected function parseNode($node, $tags){
        $markdown = '';
        if ($node instanceof DOMText) {
            $markdown .= $node->textContent;
        } elseif ($node instanceof DOMElement) {
            $tagName = strtolower($node->tagName);
            if (isset($tags[$tagName])) {
                $markdown .= $tags[$tagName];
            }
            if ($tagName === 'ins') {
                return ''; // 如果是 adsbygoogle 的 ins 元素，则直接返回空字符串
            }
            if ($tagName === 'script') {
                return ''; // 过滤掉 <script> 标签
            }
            if ($tagName === 'img') {
                $src = $node->getAttribute('src');
                $alt = $node->getAttribute('alt');
                $markdown .= "![{$alt}]({$src})";
            } else {
                foreach ($node->childNodes as $childNode) {
                    $markdown .= $this->parseNode($childNode, $tags);
                }
                if (in_array($tagName, ['ul', 'ol'])) {
                    $markdown .= "\n";
                }
            }
        }
        return $markdown;
    }
}