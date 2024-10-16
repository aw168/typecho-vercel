<?php
$recommend = [];
$recommend_text = $this->options->JIndexSticky;
if ($recommend_text) {
    $recommend_arr = explode("
", $recommend_text);
    foreach ($recommend_arr as $recommend_item) {
        $item_data = explode("||", $recommend_item);
        $cid = trim($item_data[0]);
        $style = trim($item_data[1]);
        $this->widget('Widget_Contents_Post@'.$cid, 'cid='.$cid)->to($item);
        ob_start(); // 开启缓冲区
        switch ($style) {
            case '默认':
?>

<li class="Xc_home_article-si top default">
<div class="line"></div>
<a href="<?php $item->permalink() ?>" class="thumbnail" title="<?php $item->title() ?>">
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo _getThumbnails($item)[0] ?>" alt="<?php $item->title() ?>" />
</a>
<div class="information">
<a href="<?php $item->permalink() ?>" class="title" title="<?php $item->title() ?>">
<span class="badge">置顶</span><?php $item->title() ?>
</a>
<a class="abstract" href="<?php $item->permalink() ?>" title="文章摘要"><?php _getAbstract($item) ?></a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($item->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($item) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $item->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($item) ?></li>
</ul>
<div class="last" style="display:flex">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg>
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"><?php echo $item->categories[0]['name']; ?></a>
</div>
</div>
</div>
</li>

<?php break; case '大图': ?>
<li class="Xc_home_article-si top single">
<div class="line"></div>
<div class="information">
<a href="<?php $item->permalink() ?>" class="title" title="<?php $item->title() ?>">
<span class="badge">置顶</span><?php $item->title() ?>
</a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($item->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($item) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $item->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($item) ?></li>
</ul>
<div class="last" style="display:flex">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg>
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"><?php echo $item->categories[0]['name']; ?></a>
</div>
</div>
</div>
<a href="<?php $item->permalink() ?>" class="thumbnail" title="<?php $item->title() ?>">
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo _getThumbnails($item)[0] ?>" alt="<?php $item->title() ?>" />
</a>
<div class="information" style="margin-bottom: 0;">
<a class="abstract" href="<?php $item->permalink() ?>" title="文章摘要"><?php _getAbstract($item) ?></a>
</div>
</li>

<?php break; case '三图': ?>
<li class="Xc_home_article-si top multiple">
<div class="line"></div>
<div class="information">
<a href="<?php $item->permalink() ?>" class="title" title="<?php $item->title() ?>">
<span class="badge">置顶</span><?php $item->title() ?>
</a>
<a class="abstract" href="<?php $item->permalink() ?>" title="文章摘要"><?php _getAbstract($item) ?></a>
</div>
<a href="<?php $item->permalink() ?>" class="thumbnail" title="<?php $item->title() ?>">
<?php $image = _getThumbnails($item) ?>
<?php for ($x = 0; $x < 3; $x++) : ?>
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo $image[$x]; ?>" alt="<?php $item->title() ?>" />
<?php endfor; ?>
</a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($item->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($item) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $item->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($item) ?></li>
</ul>
<div class="last" style="display:flex">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg>
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"><?php echo $item->categories[0]['name']; ?></a>
</div>
</div>
</li>

<?php break; case '无图': ?>
<li class="Xc_home_article-si top none">
<div class="line"></div>
<div class="information">
<a href="<?php $item->permalink() ?>" class="title" title="<?php $item->title() ?>">
<span class="badge">置顶</span><?php $item->title() ?>
</a>
<a class="abstract" href="<?php $item->permalink() ?>" title="文章摘要"><?php _getAbstract($item) ?></a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($item->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($item) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $item->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($item) ?></li>
</ul>
<div class="last" style="display:flex">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg>
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"><?php echo $item->categories[0]['name']; ?></a>
</div>
</div>
</div>
</li>

<?php
    break;
}
        $output = ob_get_clean(); // 获取并清空缓冲区的内容
        echo $output; // 输出缓冲区的内容
    }
}
?>