<?php

/**
 * 友链
 * 
 * @package custom 
 * 
 **/

?>
<?php $this->need('public/head.php'); ?>
<?php $this->need('public/include.php'); ?>

<body>
<?php $this->need('public/header.php'); ?>
<?php $this->need('Xccx/picture_post.php'); ?>
<div class="Xc_total Xc_Pjax showInUp">
<div class="Xc_main Xc_page">
<div class="Xc_reads" data-cid="<?php echo $this->cid ?>">
<?php $this->need('public/batten.php'); ?>

<?php
$friends = [];
$friends_color = [
'#ccb200',
'#0396FF',
'#EA5455',
'#7367F0',
'#32CCBC',
'#F6416C',
'#28C76F',
'#9F44D3',
'#F55555',
'#736EFE',
'#E96D71',
'#DE4313',
'#D939CD',
'#4C83FF',
'#F072B6',
'#C346C2',
'#5961F9',
'#FD6585',
'#465EFB',
'#FFC600',
'#FA742B',
'#5151E5',
'#BB4E75',
'#FF52E5',
'#49C628',
'#00EAFF',
'#F067B4',
'#F067B4',
'#ff9a9e',
'#00f2fe',
'#4facfe',
'#f093fb',
'#6fa3ef',
'#bc99c4',
'#46c47c',
'#f9bb3c',
'#e8583d',
'#f68e5f',
];
$friends_text = $this->options->JFriends;
if ($friends_text) {
$friends_arr = explode("\r\n", $friends_text);
if (count($friends_arr) > 0) {
for ($i = 0; $i < count($friends_arr); $i++) {
$name = explode("||", $friends_arr[$i])[0];
$url = explode("||", $friends_arr[$i])[1];
$avatar = explode("||", $friends_arr[$i])[2];
$desc = explode("||", $friends_arr[$i])[3];
$friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
};
}
}
?>
<?php if (sizeof($friends) > 0) : ?>
<ul class="Xc_reads_friends">
<?php foreach ($friends as $item) : ?>
<li class="Xc_reads_friends-item">
<a class="contain" href="<?php echo $item['url']; ?>" target="_blank" style="background: <?php echo $friends_color[mt_rand(0, count($friends_color) - 1)] ?>">
<span class="title"><?php echo $item['name']; ?></span>
<div class="content">
<div class="desc" title="<?php echo $item['desc']; ?>"><?php echo $item['desc']; ?></div>
<img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>">
</div>
</a>
</li>
<?php endforeach; ?>
</ul>


<?php endif; ?>
<?php $this->need('public/article.php'); ?>
</div>
<?php $this->need('public/comment.php'); ?>
</div>
<?php if ($this->options->JAside_cblpage === 'on') : ?>
<?php $this->need('public/aside.php'); ?>
<?php endif; ?>
</div>
<?php $this->need('public/footer.php'); ?>
</body>
</html>