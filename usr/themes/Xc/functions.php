<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function _getVersion(){return "免费版";};
require_once("core/core.php");
function themeConfig($form){
$_db = Typecho_Db::get();
$_prefix = $_db->getPrefix();
try {
if (!array_key_exists('views', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {$_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `views` INT DEFAULT 0;');}
if (!array_key_exists('agree', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {$_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `agree` INT DEFAULT 0;');}}
catch (Exception $e) {}
?>
<link rel="stylesheet" href="<?php Helper::options()->themeUrl('assets/typecho/config/css/Xc.admin.css') ?>">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:400" />
<script src="<?php Helper::options()->themeUrl('assets/typecho/config/js/Xc.admin.js') ?>"></script>
<div class="Xc_config"><div>
<div class="Xc_config__aside">
<div class="logo">Xc <?php echo _getVersion() ?></div>
<ul class="tabs">
<li class="item" data-current="Xc_notice"><span>最新公告</span></li>
<li class="item" data-current="Xc_pattern"><span>主题样式</span></li>
<li class="item" data-current="Xc_global"><span>全局设置</span></li>
<li class="item" data-current="Xc_image"><span>图片设置</span></li>
<li class="item" data-current="Xc_post"><span>文章设置</span></li>
<li class="item" data-current="Xc_aside"><span>侧栏设置</span></li>
<li class="item" data-current="Xc_home"><span>首页设置</span></li>
<li class="item" data-current="Xc_other"><span>其他设置</span></li>
<li class="item" data-current="Xc_top"><span>顶部设置</span></li>
<li class="item" data-current="Xc_beautify"><span>增强设置</span></li>
</ul>
<?php require_once('core/storage.php'); ?>
</div></div>
<div class="Xc_config__notice">请求数据中...</div>
<?php
require_once("Xccx/xccx_admin.php");
} ?>