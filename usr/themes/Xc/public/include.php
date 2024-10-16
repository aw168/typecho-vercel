<Xc_Pjax_top><script>localStorage.getItem("data-night") && document.querySelector("html").setAttribute("data-night", "night");window.Xc={THEME_URL:`<?php Helper::options()->themeUrl()?>`,PAGE_INDEX:`<?php echo $this->_currentPage;?>`||1,BASE_API:`<?php echo $this->options->rewrite==0?Helper::options()->rootUrl.'/index.php/Xc/api':Helper::options()->rootUrl.'/Xc/api'?>`,BAIDU_PUSH:<?php echo $this->options->JBaiduToken?'true':'false'?>,DOCUMENT_TITLE:`<?php $this->options->JDocumentTitle()?>`,LAZY_LOAD:`<?php _getLazyload()?>`,BIRTHDAY:`<?php $this->options->JBirthDay()?>`,MOTTO:`<?php _getAsideAuthorMotto()?>`,PAGE_SIZE:`<?php $this->parameter->pageSize()?>`}</script></Xc_Pjax_top>
<?php
$fontUrl = $this->options->JCustomFont;
if (strpos($fontUrl, 'woff2') !== false) {
    $fontFormat = 'woff2';
} elseif (strpos($fontUrl, 'woff') !== false) {
    $fontFormat = 'woff';
} elseif (strpos($fontUrl, 'ttf') !== false) {
    $fontFormat = 'truetype';
} elseif (strpos($fontUrl, 'eot') !== false) {
    $fontFormat = 'embedded-opentype';
} elseif (strpos($fontUrl, 'svg') !== false) {
    $fontFormat = 'svg';
} else {
    $fontFormat = ''; 
}
?>
<style>
<?php if ($this->options->JCustomFont) : ?>@font-face {font-family: 'Xc Font'; font-weight: 400; font-style: normal; font-display: swap; src: url('<?php echo $fontUrl ?>'); <?php if ($fontFormat) : ?>src: url('<?php echo $fontUrl ?>') format('<?php echo $fontFormat ?>');<?php endif; ?>}
*{font-family:'Xc Font',sans-serif !important}<?php endif; ?>

html .header_internal .Xc_total{max-width:<?php $this->options->template_header() ?>} 
html .header_below .Xc_total{max-width:<?php $this->options->template_header() ?>} 
html .header_search .Xc_total{max-width:<?php $this->options->template_header() ?>} 
html .Xc_main{max-width:<?php $this->options->template_main() ?>} 
html .Xc_aside{width:<?php $this->options->template_aside() ?>}
<?php if ($this->options->aside_weizi === '02') : ?>html .Xc_aside{order:-1 !important;margin-right:20px;margin-left:0}<?php endif; ?>

body::before {
background: #f0f0f0;
background-position: center 0;
background-repeat: no-repeat;
background-size: cover;
}

<?php $this->options->JCustomCSS() ?>
</style>

<link rel="stylesheet" href="<?php _getAssets('assets/css/Xc.global.css'); ?>" />
<link rel="stylesheet" href="<?php _getAssets('assets/css/Xc.style.css'); ?>" />
<link rel="stylesheet" href="<?php _getAssets('assets/css/Xc.theme.css'); ?>" />
<link rel="stylesheet" href="<?php _getAssets('assets/css/swiper.css'); ?>" />
<script src="<?php _getAssets('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/Xc.style.min.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/swiper.min.js'); ?>"></script>
<script src="//at.alicdn.com/t/c/font_3863156_af9gg1ogdhn.js"></script>

<?php if ($this->options->JAside_Loadanimation === '01') : ?>
<!-- 加载动画 -->
<div id="Loadanimation" style="z-index:999999;">
<div id="Loadanimation-center">
<div class="xccx_object" id="xccx_four"></div>
<div class="xccx_object" id="xccx_three"></div>
<div class="xccx_object" id="xccx_two"></div>
<div class="xccx_object" id="xccx_one"></div>
</div></div>
<script>$(function(){ $("#Loadanimation").fadeOut(530); });</script>
<?php endif; ?>


<?php $this->options->JCustomHeadEnd() ?>
