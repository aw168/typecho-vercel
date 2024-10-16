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
<?php $this->need('public/handle.php'); ?>
</div>
<?php $this->need('public/copyright.php'); ?>
<?php $this->need('public/comment.php'); ?>
</div>
<?php if ($this->options->JAside_cblpage === 'on') : ?>
<?php $this->need('public/aside.php'); ?>
<?php endif; ?>
</div>
<?php $this->need('public/footer.php'); ?>
</body>
</html>