<?php

/**
 * 闪念
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
<?php $this->need('public/article.php'); ?>
</div>
<?php $this->comments()->to($comments); ?>
<div class="Xc_dynamic">
<input type="hidden" class="Xc_comment-url" value="<?php $this->commentUrl() ?>">
<?php if ($this->user->hasLogin()) : ?>
<?php if ($this->user->uid == $this->authorId) : ?>
<div class="respond" id="comments">
<div class="title">写点什么？</div>
<form method="post" id="Xc_dynamic-form" action="<?php $this->commentUrl() ?>">
<textarea name="text" id="Xc_dynamic-form-text" class="OwO-textarea" autocomplete="off" rows="3" placeholder="把秘密告诉风..."></textarea>
<input type="hidden" value="<?php $this->user->screenName(); ?>" name="author" />
<input type="hidden" value="<?php $this->user->mail(); ?>" name="mail" />
<input type="hidden" value="<?php $this->options->siteUrl(); ?>" name="url" />
<input type="hidden" name="_" value="<?php Typecho_Widget::widget('Widget_Security')->to($security);
echo $security->getToken($this->request->getRequestUrl()); ?>">
<div class="form-foot">
<div class="owo Xc_owo_contain"></div>
<button type="submit">立即发表</button>
</div>
</form>
</div>
<?php endif; ?>
<?php endif; ?>
<?php $comments->listComments(['commentUrl' => $this->commentUrl, 'class' => $this]); ?>
<?php
$comments->pageNav(
'<svg class="icon icon-prev" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
'<svg class="icon icon-next" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
1,
'...',
array(
'wrapTag' => 'ul',
'wrapClass' => 'Xc_pagination',
'itemTag' => 'li',
'textTag' => 'a',
'currentClass' => 'active',
'prevClass' => 'prev',
'nextClass' => 'next'
)
);
?>

<?php
if ($this->user->hasLogin()) {
$GLOBALS['isLogin'] = true;
} else {
$GLOBALS['isLogin'] = false;
}
function threadedComments($comments, $options)
{
if ($comments->authorId) {
if ($comments->authorId == $comments->ownerId) {
$commentClass = 'comment-by-author';
}
}
$db = Typecho_Db::get();

$enable_comment = $options->class->fields->enable_comment ? true : false;
if (empty($options->class->fields->enable_comment)) $enable_comment = true;
if ($options->class->fields->enable_comment == '0') {
$enable_comment = false;
}
?>
<li id="li-<?php $comments->theId(); ?>">
<div class="comment-parent">
<div class="title">
<img class="avatar" src="<?php _getAvatarByMail($comments->mail); ?>" alt="">
<div class="desc">
<div class="author"><?php $comments->author(); ?></div>
<div class="time"><?php $comments->date('Y年m月d日 H:i'); ?></div>
</div>
</div>
<div class="content">
<?php echo $comments->content; ?>
</div>
</div>

<?php if ($comments->children) { ?>
<div class="list">
<?php
$arr = $comments->children;
foreach ($arr as &$val) { ?>
<div class="item" id="comment-<?php echo $val['coid']; ?>">
<span class="name"><?php echo $val['author'] ?>：</span>
<span><?php echo $val['text'] ?></span>
</div>
<?php } ?>
</div>
<?php } ?>

<?php if ($enable_comment) : ?>

<?php endif; ?>
</li>
<?php } ?>
</div>
</div>
<?php if ($this->options->JAside_cblpage === 'on') : ?>
<?php $this->need('public/aside.php'); ?>
<?php endif; ?>
</div>
<?php $this->need('public/footer.php'); ?>

<script>
function changeURLArg(url, arg, arg_val) {
let pattern = arg + '=([^&]*)';
let replaceText = arg + '=' + arg_val;
if (url.match(pattern)) {
let tmp = '/(' + arg + '=)([^&]*)/gi';
tmp = url.replace(eval(tmp), replaceText);
return tmp;
} else {
if (url.match('[\?]')) {
return url + '&' + replaceText;
} else {
return url + '?' + replaceText;
}
}
}
let dynamic = {
init_dynamic_verify() {
let isSubmit = false;
$('#Xc_dynamic-form').off('submit').on('submit', function(e) {
e.preventDefault();
let btn = $("#Xc_dynamic-form .form-foot button");
if ($('#Xc_dynamic-form-text').val().trim() === '') {
return Qmsg.info('请输入发表内容！');
}
if ($(this).attr('data-disabled')) return;
$(this).attr('data-disabled', true);
if (isSubmit) return;
isSubmit = true;
btn.html('发送中...');
$.ajax({
url: $(this).attr('action'),
type: 'POST',
data: $(this).serializeArray(),
dataType: 'text',
success(res) {
let arr = [],
str = '';
arr = $(res).contents();
Array.from(arr).forEach(_ => {
if (_.parentNode.className === 'container') str = _;
});
if (!/Xc/.test(res)) {
Qmsg.warning(str.textContent.trim() || '');
isSubmit = false;
btn.html('发表评论');
} else {
window.location.href = changeURLArg(location.href, 'scroll', 'dynamic');
window.location.reload();
Qmsg.success('发送成功，即将刷新本页！');
}
}
});
});
}
}
$(document).ready(function() {

$('.Xc_dynamic-reply').on('click', e => e.stopPropagation())
$('.Xc_dynamic-reply').on('submit', function(e) {
e.preventDefault()
if ($(this).attr('data-disabled')) return
$(this).attr('data-disabled', true)
$.ajax({
url: $('.Xc_comment-url').val(),
type: 'POST',
data: $(this).serializeArray(),
dataType: 'text',
success(res) {
let arr = [],
str = '';
arr = $(res).contents();
Array.from(arr).forEach(_ => {
if (_.parentNode.className === 'container') str = _;
});
if (!/Xc/.test(res)) {
Qmsg.warning(str.textContent.trim() || '');
$(this).removeAttr('data-disabled')
}
}
});
});

dynamic.init_dynamic_verify();
});
</script>
</body>
</html>