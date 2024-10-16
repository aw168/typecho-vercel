<?php
function _getAssets($assets, $type = true)
{
  $assetsURL = "";
  if (Helper::options()->JAssetsURL) {
    $assetsURL = Helper::options()->JAssetsURL . '/' . $assets;
  } else {
    $assetsURL = Helper::options()->themeUrl . '/' . $assets;
  }
  if ($type) echo $assetsURL;
  else return  $assetsURL;
}
_startCountTime();
function theAllViews()
{
  $db = Typecho_Db::get();
  $row = $db->fetchAll('SELECT SUM(VIEWS) FROM `typecho_contents`');
  echo number_format($row[0]['SUM(VIEWS)']);
}
function _Tagtotal()
{
  $db = Typecho_Db::get();
  return $db->fetchObject($db->select(array('COUNT(mid)' => 'num'))
    ->from('table.metas')
    ->where('table.metas.type = ?', 'tag'))->num;
}
function _Xc_img($item)
{
  $custom_thumbnail = Helper::options()->JWallpaper_picture_index;
  $result = [];
  if ($custom_thumbnail) {
    $custom_thumbnail_arr = explode("\r", $custom_thumbnail);
    $randomIndex = array_rand($custom_thumbnail_arr, 1);
    $result[] = trim(strtok($custom_thumbnail_arr[$randomIndex], "?"));
  } else {
    $result[] = "";
  }
  return $result;
}
function _getLazyload($type = true)
{
  if ($type) echo Helper::options()->JLazyload;
  else return Helper::options()->JLazyload;
}
function _getAvatarLazyload($type = true)
{
  $str = "/usr/themes/Xc/assets/img/txlazyload.png";
  if ($type) echo $str;
  else return $str;
}
function _getViews($item, $type = true)
{
  $db = Typecho_Db::get();
  $result = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $item->cid))['views'];
  if ($type) echo number_format($result);
  else return number_format($result);
}
function _getAgree($item, $type = true)
{
  $db = Typecho_Db::get();
  $result = $db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $item->cid))['agree'];
  if ($type) echo number_format($result);
  else return number_format($result);
}
function _startCountTime()
{
  global $timeStart;
  $mTime = explode(' ', microtime());
  $timeStart = $mTime[1] + $mTime[0];
  return true;
}
function _endCountTime($precision = 3)
{
  global $timeStart, $timeEnd;
  $mTime = explode(' ', microtime());
  $timeEnd   = $mTime[1] + $mTime[0];
  $timeTotal = number_format($timeEnd - $timeStart, $precision);
  echo $timeTotal < 1 ? $timeTotal * 1000 . 'ms' : $timeTotal . 's';
}
function _getParentReply($parent)
{
  if ($parent !== "0") {
    $db = Typecho_Db::get();
    $commentInfo = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ?', $parent)->limit(1));
    if ($commentInfo) {
      echo '<div class="parent"><span style="vertical-align: 0px;">@</span>' . $commentInfo['author'] . '</div>';
    }
  }
}
function _isMobile()
{
  if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
    return true;
  if (isset($_SERVER['HTTP_VIA'])) {
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
  }
  if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
      return true;
  }
  if (isset($_SERVER['HTTP_ACCEPT'])) {
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
      return true;
    }
  }
  return false;
}
function _getAvatarByMail($mail, $type = true)
{
  $gravatarsUrl = Helper::options()->JCustomAvatarSource ? Helper::options()->JCustomAvatarSource : 'https://gravatar.helingqi.com/wavatar/';
  $mailLower = strtolower($mail);
  $md5MailLower = md5($mailLower);
  $qqMail = str_replace('@qq.com', '', $mailLower);
  if (strstr($mailLower, "qq.com") && is_numeric($qqMail) && strlen($qqMail) < 11 && strlen($qqMail) > 4) {
    if ($type) {
      echo 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';
    } else {
      return 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';
    }
  } else {
    if ($type) {
      echo $gravatarsUrl . $md5MailLower . '?d=mm';
    } else {
      return $gravatarsUrl . $md5MailLower . '?d=mm';
    }
  }
};
function _getAsideAuthorMotto()
{
  $JMottoRandom = explode("\r\n", Helper::options()->JAside_Author_Motto);
  echo $JMottoRandom[array_rand($JMottoRandom, 1)];
}
function _getAbstract($item, $type = true, $maxLength = 200)
{
  $abstract = "";
  if ($item->password) {
    $abstract = "加密文章，请前往内页查看详情";
  } else {
    if ($item->fields->abstract) {
      $abstract = $item->fields->abstract;
    } else {
      $abstract = strip_tags($item->excerpt);
      if (strpos($abstract, '{hide') !== false) {
        $abstract = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '隐藏内容，请前往内页查看详情', $abstract);
      }
      $abstract = preg_replace('/{dplayer[^}]*}/', '视频内容，请前往内页查看详情', $abstract);
      $abstract = preg_replace('/{bilibili[^}]*}/', '视频内容，请前往内页查看详情', $abstract);
      $abstract = preg_replace('/{mp3[^}]*\/}/', '在线音乐，请前往内页查看详情', $abstract);
      $abstract = preg_replace('/{music[^}]*\/}/', '在线音乐，请前往内页查看详情', $abstract);
      $abstract = preg_replace('/{music-list[^}]*\/}/', '在线音乐，请前往内页查看详情', $abstract);
    }
  }
  if ($abstract === '') {
    $abstract = "暂无简介";
  }
  if (mb_strlen($abstract, 'utf-8') > $maxLength) {
    $abstract = mb_substr($abstract, 0, $maxLength, 'utf-8') . '...';
  }
  if ($type) {
    echo $abstract;
  } else {
    return $abstract;
  }
}
function _getThumbnails($item)
{
  $result = [];
  $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
  $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
  $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
  if ($item->fields->thumb) {
    $fields_thumb_arr = explode("\r\n", $item->fields->thumb);
    foreach ($fields_thumb_arr as $list) $result[] = $list;
  }
  if (preg_match_all($pattern, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  if (preg_match_all($patternMD, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  if (preg_match_all($patternMDfoot, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  if (sizeof($result) < 3) {
    $custom_thumbnail = Helper::options()->JThumbnail;
    if ($custom_thumbnail) {
      $custom_thumbnail_arr = explode("\r\n", $custom_thumbnail);
      for ($i = 0; $i < 3; $i++) {
        $result[] = $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);
      }
    } else {
      for ($i = 0; $i < 3; $i++) {
        $result[] = _getAssets('assets/thumb/' . rand(1, 42) . '.jpg', false);
      }
    }
  }
  return $result;
}
function _getAsideAuthorNav()
{
  if (Helper::options()->JAside_Author_Nav && Helper::options()->JAside_Author_Nav !== "off") {
    $limit = Helper::options()->JAside_Author_Nav;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $sql = "SELECT * FROM `{$prefix}contents` WHERE cid >= (SELECT floor( RAND() * ((SELECT MAX(cid) FROM `{$prefix}contents`)-(SELECT MIN(cid) FROM `{$prefix}contents`)) + (SELECT MIN(cid) FROM `{$prefix}contents`))) and type='post' and status='publish' and (password is NULL or password='') ORDER BY cid LIMIT $limit";
    $result = $db->query($sql);
    if ($result instanceof Traversable) {
      foreach ($result as $item) {
        $item = Typecho_Widget::widget('Widget_Abstract_Contents')->push($item);
        $title = htmlspecialchars($item['title']);
        $permalink = $item['permalink'];
        echo "<li class='item'>
<a class='link' href='{$permalink}' title='{$title}'>{$title}</a>
<svg class='icon' viewBox='0 0 1024 1024' xmlns='http://www.w3.org/2000/svg' width='16' height='16'><path d='M448.12 320.331a30.118 30.118 0 0 1-42.616-42.586L552.568 130.68a213.685 213.685 0 0 1 302.2 0l38.552 38.551a213.685 213.685 0 0 1 0 302.2L746.255 618.497a30.118 30.118 0 0 1-42.586-42.616l147.034-147.035a153.45 153.45 0 0 0 0-217.028l-38.55-38.55a153.45 153.45 0 0 0-216.998 0L448.12 320.33zM575.88 703.67a30.118 30.118 0 0 1 42.616 42.586L471.432 893.32a213.685 213.685 0 0 1-302.2 0l-38.552-38.551a213.685 213.685 0 0 1 0-302.2l147.065-147.065a30.118 30.118 0 0 1 42.586 42.616L173.297 595.125a153.45 153.45 0 0 0 0 217.027l38.55 38.551a153.45 153.45 0 0 0 216.998 0L575.88 703.64zm-234.256-63.88L639.79 341.624a30.118 30.118 0 0 1 42.587 42.587L384.21 682.376a30.118 30.118 0 0 1-42.587-42.587z'/></svg></li>";
      }
    }
  }
}
function _curl($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 3000);
  curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
  if (strpos($url, 'https') !== false) {
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  }
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36');
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
function _checkSensitiveWords($words_str, $str)
{
  $words = explode("||", $words_str);
  if (empty($words)) {
    return false;
  }
  foreach ($words as $word) {
    if (false !== strpos($str, trim($word))) {
      return true;
    }
  }
  return false;
}require_once('securlty.php');
function formatTime($older_date)
{
  if ($older_date == "no") {
    return;
  }
  $chunks = array(
    array(31536000, '年'),
    array(2592000, '个月'),
    array(86400, '天'),
    array(3600, '小时'),
    array(60, '分'),
    array(1, '秒'),
  );
  $newer_date = time();
  $since = abs($newer_date - $older_date);

  for ($i = 0, $j = count($chunks); $i < $j; $i++) {
    $seconds = $chunks[$i][0];
    $name = $chunks[$i][1];
    if (($count = floor($since / $seconds)) != 0) break;
  }
  $output = $count . $name . '前';
  return $output;
}
function convert($num)
{
  if ($num >= 100000) {
    $num = round($num / 10000) . 'w';
  } else if ($num >= 10000) {
    $num = round($num / 10000, 1) . 'w';
  } else if ($num >= 1000) {
    $num = round($num / 1000, 1) . 'k';
  }
  return $num;
}
function _handleViews($self)
{
  $self->response->setStatus(200);
  $cid = $self->request->cid;
  if (!preg_match('/^\d+$/',  $cid)) {
    return $self->response->throwJson(array("code" => 0, "data" => "非法请求！已屏蔽！"));
  }
  $db = Typecho_Db::get();
  $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
  if (sizeof($row) > 0) {
    $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
    $self->response->throwJson(array(
      "code" => 1,
      "data" => array('views' => number_format($db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views']))
    ));
  } else {
    $self->response->throwJson(array("code" => 0, "data" => null));
  }
}
function Postviews($archive)
{
  $db = Typecho_Db::get();
  $cid = $archive->cid;
  if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
    $db->query('ALTER TABLE `' . $db->getPrefix() . 'contents` ADD `views` INT(10) DEFAULT 0;');
  }
  $exist = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
  if ($archive->is('single')) {
    $cookie = Typecho_Cookie::get('contents_views');
    $cookie = $cookie ? explode(',', $cookie) : array();
    if (!in_array($cid, $cookie)) {
      $db->query($db->update('table.contents')
        ->rows(array('views' => (int)$exist + 1))
        ->where('cid = ?', $cid));
      $exist = (int)$exist + 1;
      array_push($cookie, $cid);
      $cookie = implode(',', $cookie);
      Typecho_Cookie::set('contents_views', $cookie);
    }
  }

  if ($exist == 0) {
    echo '0';
  } else {
    $exist = convert($exist);
    echo $exist;
  }
}
function _handleAgree($self)
{
  $self->response->setStatus(200);

  $cid = $self->request->cid;
  $type = $self->request->type;
  if (!preg_match('/^\d+$/',  $cid)) {
    return $self->response->throwJson(array("code" => 0, "data" => "非法请求！已屏蔽！"));
  }
  if (!preg_match('/^[agree|disagree]+$/', $type)) {
    return $self->response->throwJson(array("code" => 0, "data" => "非法请求！已屏蔽！"));
  }
  $db = Typecho_Db::get();
  $row = $db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $cid));
  if (sizeof($row) > 0) {
    if ($type === "agree") {
      $db->query($db->update('table.contents')->rows(array('agree' => (int)$row['agree'] + 1))->where('cid = ?', $cid));
    } else {
      if (intval($row['agree']) - 1 >= 0)
        $db->query($db->update('table.contents')->rows(array('agree' => (int)$row['agree'] - 1))->where('cid = ?', $cid));
    }
    $self->response->throwJson(array(
      "code" => 1,
      "data" => array('agree' => number_format($db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $cid))['agree']))
    ));
  } else {
    $self->response->throwJson(array("code" => 0, "data" => null));
  }
}
function _getCommentLately($self)
{
  $self->response->setStatus(200);

  $time = time();
  $num = 7;
  $categories = [];
  $series = [];
  $db = Typecho_Db::get();
  $prefix = $db->getPrefix();
  for ($i = ($num - 1); $i >= 0; $i--) {
    $date = date("Y/m/d", $time - ($i * 24 * 60 * 60));
    $sql = "SELECT coid FROM `{$prefix}comments` WHERE FROM_UNIXTIME(created, '%Y/%m/%d') = '{$date}' limit 100";
    $count = count($db->fetchAll($sql));
    $categories[] = $date;
    $series[] = $count;
  }
  $self->response->throwJson([
    "categories" => $categories,
    "series" => $series,
  ]);
}
function _getArticleFiling($self)
{
  $self->response->setStatus(200);

  $page = $self->request->page;
  $pageSize = 8;
  if (!preg_match('/^\d+$/', $page)) return $self->response->throwJson(array("data" => "非法请求！已屏蔽！"));
  if ($page == 0) $page = 1;
  $offset = $pageSize * ($page - 1);
  $time = time();
  $db = Typecho_Db::get();
  $prefix = $db->getPrefix();
  $result = [];
  $sql = "SELECT FROM_UNIXTIME(created, '%Y 年 %m 月') as date FROM `{$prefix}contents` WHERE created < {$time} AND (password is NULL or password = '') AND status = 'publish' AND type = 'post' GROUP BY FROM_UNIXTIME(created, '%Y 年 %m 月') DESC LIMIT {$pageSize} OFFSET {$offset}";
  $temp = $db->fetchAll($sql);
  $options = Typecho_Widget::widget('Widget_Options');
  foreach ($temp as $item) {
    $date = $item['date'];
    $list = [];
    $sql = "SELECT * FROM `{$prefix}contents` WHERE created < {$time} AND (password is NULL or password = '') AND status = 'publish' AND type = 'post' AND FROM_UNIXTIME(created, '%Y 年 %m 月') = '{$date}' ORDER BY created DESC LIMIT 100";
    $_list = $db->fetchAll($sql);
    foreach ($_list as $_item) {
      $type = $_item['type'];
      $_item['categories'] = $db->fetchAll($db->select()->from('table.metas')
        ->join('table.relationships', 'table.relationships.mid = table.metas.mid')
        ->where('table.relationships.cid = ?', $_item['cid'])
        ->where('table.metas.type = ?', 'category')
        ->order('table.metas.order', Typecho_Db::SORT_ASC));
      $_item['category'] = urlencode(current(Typecho_Common::arrayFlatten($_item['categories'], 'slug')));
      $_item['slug'] = urlencode($_item['slug']);
      $_item['date'] = new Typecho_Date($_item['created']);
      $_item['year'] = $_item['date']->year;
      $_item['month'] = $_item['date']->month;
      $_item['day'] = $_item['date']->day;
      $routeExists = (NULL != Typecho_Router::get($type));
      $_item['pathinfo'] = $routeExists ? Typecho_Router::url($type, $_item) : '#';
      $_item['permalink'] = Typecho_Common::url($_item['pathinfo'], $options->index);
      $list[] = array(
        "title" => date('m/d', $_item['created']) . '：' . $_item['title'],
        "permalink" => $_item['permalink'],
      );
    }
    $result[] = array("date" => $date, "list" => $list);
  }
  $self->response->throwJson($result);
}
function compressHtml($html_source)
{
  $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
  $compress = '';
  foreach ($chunks as $c) {
    if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
      $c = substr($c, 19, strlen($c) - 19 - 20);
      $compress .= $c;
      continue;
    } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
      $c = substr($c, 12, strlen($c) - 12 - 13);
      $compress .= $c;
      continue;
    } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
      $compress .= $c;
      continue;
    } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
      $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
      $c = '';
      foreach ($tmps as $tmp) {
        if (strpos($tmp, '//') !== false) {
          if (substr(trim($tmp), 0, 2) == '//') {
            continue;
          }
          $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
          $is_quot = $is_apos = false;
          foreach ($chars as $key => $char) {
            if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
              $is_quot = !$is_quot;
            } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
              $is_apos = !$is_apos;
            } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
              $tmp = substr($tmp, 0, $key);
              break;
            }
          }
        }
        $c .= $tmp;
      }
    }
    $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
    $c = preg_replace('/\\s{2,}/', ' ', $c);
    $c = preg_replace('/>\\s</', '> <', $c);
    $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
    $c = preg_replace('/<!--[^!]*-->/', '', $c);
    $compress .= $c;
  }
  return $compress;
}require_once('expand.php');
Typecho_Plugin::factory('admin/write-post.php')->richEditor  = array('Editor', 'Edit');
Typecho_Plugin::factory('admin/write-page.php')->richEditor  = array('Editor', 'Edit');
class Editor
{
  public static function Edit()
  {
?>
    <link rel="stylesheet" href="<?php _getAssets('assets/typecho/write/css/Xc.write.css') ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:400" />

    <script>
      window.XcConfig = {
        uploadAPI: '<?php Helper::security()->index('/action/upload'); ?>',
        expressionAPI: '<?php _getAssets('assets/typecho/write/json/expression.json') ?>',
        playerAPI: '<?php Helper::options()->JCustomPlayer ? Helper::options()->JCustomPlayer() : Helper::options()->themeUrl('library/player.php?url=') ?>',
        autoSave: <?php Helper::options()->autoSave(); ?>,
        themeURL: '<?php Helper::options()->themeUrl(); ?>',
        canPreview: false
      }
    </script>
    <script src="<?php _getAssets('assets/typecho/write/parse/parse.min.js') ?>"></script>
    <script src="<?php _getAssets('assets/typecho/write/dist/index.bundle.js') ?>"></script>
<?php
  }
}
function themeInit($self)
{
  Helper::options()->commentsAntiSpam = false;
  Helper::options()->commentsRequireMail = true;
  Helper::options()->commentsRequireURL = false;
  Helper::options()->commentsThreaded = true;
  Helper::options()->commentsMaxNestingLevels = 999;
if ($self->request->getPathInfo() == "/Xc/api") {
  switch ($self->request->routeType) {
  case 'publish_list':_getPost($self);
  break;case 'handle_views':_handleViews($self);
  break;case 'handle_agree':_handleAgree($self);
  break;case 'article_filing':_getArticleFiling($self);
  break;
  };
}
  if (Helper::options()->JSiteMap && Helper::options()->JSiteMap !== 'off') {
    if (strpos($self->request->getRequestUri(), 'sitemap.xml') !== false) {
      $self->response->setStatus(200);
      $self->setThemeFile("library/sitemap.php");
    }
  }
}
function themeFields($layout)
{
  $mode = new Typecho_Widget_Helper_Form_Element_Select('mode', array(
    'default' => '默认模式', 'single' => '大图模式', 'multiple' => '三图模式', 'none' => '无图模式'
  ), 'default', '文章显示方式', '介绍：用于设置当前文章在首页和搜索页的显示方式 <br /> 注意：独立页面该功能不会生效');
  $layout->addItem($mode);

  $keywords = new Typecho_Widget_Helper_Form_Element_Text('keywords', NULL, NULL, 'SEO关键词（非常重要！）', '介绍：用于设置当前页SEO关键词 <br />注意：多个关键词使用英文逗号进行隔开 <br />例如：Typecho,Typecho主题,Typecho模板 <br />其他：如果不填写此项，则默认取文章标签');
  $layout->addItem($keywords);

  $description = new Typecho_Widget_Helper_Form_Element_Textarea('description', NULL, NULL, 'SEO描述语（非常重要！）', '介绍：用于设置当前页SEO描述语 <br />注意：SEO描述语不应当过长也不应当过少 <br />其他：如果不填写此项，则默认截取文章片段');
  $layout->addItem($description);

  $abstract = new Typecho_Widget_Helper_Form_Element_Textarea('abstract', NULL, NULL, '自定义摘要（非必填）', '填写时：将会显示填写的摘要 <br>不填写时：默认取文章里的内容');
  $layout->addItem($abstract);

  $thumb = new Typecho_Widget_Helper_Form_Element_Textarea('thumb', NULL, NULL, '自定义缩略图（非必填）', '填写时：将会显示填写的文章缩略图 <br>不填写时：<br>1、若文章有图片则取文章内图片 <br>2、若文章无图片，并且外观设置里未填写·自定义缩略图·选项，则取模板自带图片 <br>3、若文章无图片，并且外观设置里填写了·自定义缩略图·选项，则取自定义缩略图图片 <br>注意：多个缩略图时换行填写，一行一个（仅在三图模式下生效）');
  $layout->addItem($thumb);
}
