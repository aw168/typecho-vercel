<?php $this->need('public/head.php'); ?>
<?php $this->need('public/include.php'); ?>

<body>
<style>@media (max-width: 768px){body .Xc_top_img{height: calc(100vh) !important;margin-top: -60px;}}</style>
<?php $this->need('public/header.php'); ?>
<div class="Xc_top_img" style="background: url(<?php $item = ''; echo _Xc_img($item)[0]; ?>) center;background-size:cover;height:calc(100vh);">
<div class="infomation">
<h1 class="title">您访问的页面不存在！</h1>
<div class="desctitle">
<span id="yiyan" class="motto Xc_motto"</span></div>
</div>
</div>

<?php if ($this->options->wap_picture_index): ?>
<style>
@media(max-width:768px){
body .Xc_top_img {
    background: url(<?php $this->options->wap_picture_index() ?>) center !important;
    background-size: cover !important;
}
}
</style>
<?php endif; ?>

<style>.Xc_footer {margin-top: 0}</style>
<?php $this->need('public/footer.php'); ?>
</body>