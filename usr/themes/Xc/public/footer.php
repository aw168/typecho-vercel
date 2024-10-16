<div class="Xc_footer">
<div class="Xc_total">
<span class="item">
<?php $this->options->JFooter_Left() ?>
</span>
<div>
<?php if ($this->options->JBirthDay) : ?>
<span class="item">
已运行 <strong class="Xc_run__day">00</strong> 天 <strong class="Xc_run__hour">00</strong> 时 <strong class="Xc_run__minute">00</strong> 分 <strong class="Xc_run__second">00</strong> 秒
</span>
<?php endif; ?>

<!-- 此处自带版权，可删除，建议保留 -->
<!--div class="item">
<p>本站由<a href="https://typecho.org/"  title="Typecho官网" alt="Typecho官网" target="_blank"> Typecho </a>强力驱动丨搭配<a href="https://www.tmetu.cn/archives/1/"  title="Xc主题官网" alt="Xc主题官网" target="_blank"> Xc </a>主题使用</p>
</div-->

<?php if ($this->options->footer_online === 'on') : ?>
<?php
    //首先你要有读写文件的权限，首次访问肯不显示，正常情况刷新即可
    $online_log = "usr/themes/Xc/Xccx/online.txt"; //保存人数的文件到根目录,
    $timeout = 120;//120秒内没动作者,认为掉线
    $entries = file($online_log);
    $temp = array();
    for ($i=0;$i<count($entries);$i++){
        $entry = explode(",",trim($entries[$i]));
        if(($entry[0] != getenv('REMOTE_ADDR')) && ($entry[1] > time())) {
            array_push($temp,$entry[0].",".$entry[1]."\n"); //取出其他浏览者的信息,并去掉超时者,保存进$temp
        }
    }
    array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout))."\n"); //更新浏览者的时间
    $online = count($temp); //计算在线人数
    $entries = implode("",$temp);
    //写入文件
    $fp = fopen($online_log,"w");
    flock($fp,LOCK_EX); //flock() 不能在NFS以及其他的一些网络文件系统中正常工作
    fputs($fp,$entries);
    flock($fp,LOCK_UN);
    fclose($fp);
    $tj= "$online";
?>
<span class="item"> 
总访问：<a href="javascript:location.reload();" title="点击刷新页面"><?php echo theAllViews();?></a> 次丨<span>当前在线：<a href="javascript:location.reload();" title="点击刷新页面"><?php echo $tj?></a> 人</span>
</span>
<?php endif; ?>
</div>
</div></div>

<?php if ($this->options->Xc_Theme_font === '02') : ?><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:400" /><?php endif; ?>
<?php if ($this->options->Xc_Theme_font === '03') : ?><link rel="stylesheet" href="https://font.sec.miui.com/font/css?family=Source_Han_Serif:400:Source_Han_Serif" /><?php endif; ?>
<?php if ($this->options->Xc_Theme_font === '04') : ?><link rel="stylesheet" href="https://font.sec.miui.com/font/css?family=MiSans:400:MiSans" /><?php endif; ?>
<?php if ($this->options->Xc_Theme_font === '05') : ?><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i" /><?php endif; ?>

<script src="<?php _getAssets('assets/js/lazysizes.min.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/Xc.page.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/prism.min.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/clipboard.min.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/qmsg.js'); ?>"></script>
<!-- 灯箱支持 -->
<link rel="stylesheet" href="<?php _getAssets('assets/css/fancybox.min.css'); ?>" />
<script src="<?php _getAssets('assets/js/fancybox.min.js'); ?>"></script>
<!-- 网郁云支持 -->
<link rel="stylesheet" href="<?php _getAssets('assets/css/APlayer.css'); ?>" />
<script src="<?php _getAssets('assets/js/APlayer.min.js'); ?>"></script>
<!-- 平滑滚动 -->
<script src="<?php _getAssets('assets/js/Xc.smooth.js'); ?>"></script>
<?php if ($this->options->Xc_html_Pjax === 'on') : ?>
<script src="<?php _getAssets('assets/js/Progress-bar.min.js'); ?>"></script>
<!-- Pjax支持 -->
<script src="<?php _getAssets('assets/js/Xc_pjax_jquery.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/Xc_pjax.js'); ?>"></script>
<script>
$(document).on("pjax:complete", function () {
if (typeof Prism !== "undefined") {
var pres = document.getElementsByTagName("pre");
for (var i = 0; i < pres.length; i++) {
if (pres[i].getElementsByTagName("code").length > 0)
pres[i].className = "line-numbers";
}
Prism.highlightAll(true, null);
}
<?php $this->options->Xc_html_Pjax_zdy() ?>
 
});
</script>
<?php endif; ?>

<?php if ($this->options->JAside_dhlliulan === 'on') : ?>
<script src="<?php _getAssets('assets/js/viewhistory.js'); ?>"></script>
<script>jl_viewHistory({limit: 4,storageKey: 'jl_viewHistory',primaryKey: 'url',addHistory: <?php if ($this->is('post')) { ?> true <?php }else{ ?>false<?php } ?>,titleSplit: '|'});</script>
<?php endif; ?>

<?php $this->options->JCustomBodyEnd() ?>

<?php $this->footer(); ?>
<?php if ($this->options->Xc_htmlys === 'on') : ?>
<?php $html_source = ob_get_contents(); ob_clean(); print compressHtml($html_source); ob_end_flush(); ?>
<?php endif; ?>
