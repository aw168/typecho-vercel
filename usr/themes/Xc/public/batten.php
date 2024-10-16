<?php if ($this->is('post')): ?>
<div class="Xc_bread">
<ul class="Xc_bread_bread">
<li class="item">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A131"></use></svg>
<a href="<?php $this->options->siteUrl(); ?>" class="link" title="首页">首页</a>
</li>
<li class="line">/</li>
<?php if (sizeof($this->categories) > 0) : ?>
<li class="item">
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>" title="<?php echo $this->categories[0]['name']; ?>"><?php echo $this->categories[0]['name']; ?></a>
</li>
<li class="line">/</li>
<?php endif; ?>
<li class="item">正文</li>
</ul>
</div>
<?php endif; ?>

<?php if (sizeof($this->categories) > 0 || $this->user->uid == $this->authorId) : ?>
<div class="Xc_reads_category">
<?php if (sizeof($this->categories) > 0) : ?>
<?php foreach (array_slice($this->categories, 0, 5) as $key => $item) : ?>

<?php endforeach; ?>
<?php endif; ?>
<?php if ($this->user->uid == $this->authorId) : ?>
<?php if ($this->is('post')) : ?>
<a class="edit" target="_blank" rel="noopener noreferrer" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>">编辑文章</a>
<?php else : ?>
<a class="edit" target="_blank" rel="noopener noreferrer" href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid; ?>">编辑页面</a>
<?php endif; ?>
<?php endif; ?>
</div>
<?php endif; ?>

