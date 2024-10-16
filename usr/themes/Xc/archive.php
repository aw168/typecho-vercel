<?php $this->need('public/head.php'); ?>
<?php $this->need('public/include.php'); ?>

<body>
<?php $this->need('public/header.php'); ?>

<div class="Xc_top_img top_img_post<?php if ($this->options->index_picture_wave === '03') : ?> Xc_top_yy<?php endif; ?>" style="background: url(<?php echo _Xc_img($this)[0]; ?>) center;background-size:cover;height:<?php $this->options->JWallpaper_picturepost() ?>">
<div class="infomation">
<div class="title" style="font-size:2.2rem;letter-spacing:.25rem">“<?php echo $this->keywords; ?>” 共(<?php echo $this->getTotal(); ?>)篇</div>
</div>
<?php if ($this->options->index_picture_wave === '02') : ?>
<section class="Xc_top_img_bottom">
<svg class="waves-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
<defs>
<path id="gentle-wave" d="M -160 44 c 30 0 58 -18 88 -18 s 58 18 88 18 s 58 -18 88 -18 s 58 18 88 18 v 44 h -352 Z"></path>
</defs>
<g class="parallax">
<use xlink:href="#gentle-wave" x="48" y="0"></use>
<use xlink:href="#gentle-wave" x="48" y="3"></use>
<use xlink:href="#gentle-wave" x="48" y="5"></use>
<use xlink:href="#gentle-wave" x="48" y="7"></use>
</g>
</svg>
</section>
<?php endif; ?>
</div>

<div class="Xc_total Xc_Pjax showInUp">
<div class="Xc_main index">
<div class="Xc_archive">
<?php if ($this->have()) : ?>
<div class="Xc_archive_list Xc_home_article-list">
<?php while ($this->next()) : ?>
<?php if ($this->fields->mode === "default" || !$this->fields->mode) : ?>
<li class="Xc_home_article-si default Xct">
<div class="line"></div>
<a href="<?php $this->permalink() ?>" class="thumbnail" title="<?php $this->title() ?>">
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" alt="<?php $this->title() ?>" />
</a>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>">
<?php $this->title() ?>
</a>
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
</div>
</div>
</li>
<?php elseif ($this->fields->mode === "single") : ?>
<li class="Xc_home_article-si single Xct">
<div class="line"></div>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>">
<?php $this->title() ?>
</a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
</div>
</div>
<a href="<?php $this->permalink() ?>" class="thumbnail" title="<?php $this->title() ?>">
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" alt="<?php $this->title() ?>" />
</a>
<div class="information" style="margin-bottom: 0;">
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
</div>
</li>
<?php elseif ($this->fields->mode === "multiple") : ?>
<li class="Xc_home_article-si multiple Xct">
<div class="line"></div>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>">
<?php $this->title() ?>
</a>
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
</div>
<a href="<?php $this->permalink() ?>" class="thumbnail" title="<?php $this->title() ?>">
<?php $image = _getThumbnails($this) ?>
<?php for ($x = 0; $x < 3; $x++) : ?>
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo $image[$x]; ?>" alt="<?php $this->title() ?>" />
<?php endfor; ?>
</a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
</div>
</li>
<?php else : ?>
<li class="Xc_home_article-si none Xct">
<div class="line"></div>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>">
<?php $this->title() ?>
</a>
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
</div>
</div>
</li>
<?php endif; ?>
<?php endwhile; ?>
</div>
<?php else : ?>
<div class="Xc_archive__empty">
<svg class="Xc_archive__empty-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="120" height="120">
<path d="M483.322 136.98l-2.08-116.502A19.278 19.278 0 0 1 499.266 0h2.512c12.439.104 22.574 10.063 22.574 22.43l4.048 114.446a22.702 22.702 0 0 1-22.606 22.43c-10.136-1.952-22.479-10.079-22.479-22.326h.016zm165.034 16.943c-8.751 8.695-23.27 5.847-32.045 0a22.638 22.638 0 0 1 0-31.702L700.8 44.156a23.006 23.006 0 0 1 31.933 0c8.76 8.703 8.76 23.118 0 28.958l-84.377 80.793zm-287.215 0l-84.369-80.921c-8.767-5.824-8.767-20.135 0-28.95a23.006 23.006 0 0 1 31.917 0l84.497 78.058a22.606 22.606 0 0 1 0 31.7c-8.775 5.944-23.278 8.8-32.045.113zm488.686 679.445v9.84l-8.871 3.663-306.238 125.43-5.76 2.64V645l9.904 17.15 60.283 105.063a15.206 15.206 0 0 0 13.03 7.327 14.879 14.879 0 0 0 7.952-2.055L850.17 658.047V833.36h-.328l-.016.008zm-671.486 13.503l-9.44-3.655V654.824l.448.456 236.396 117.086a23.86 23.86 0 0 0 7.96 2.047 17.15 17.15 0 0 0 14.158-7.759l59.715-104.615 9.92-17.158V977.46l-13.152-5.28-306.005-125.317zm-21.998-415.308l4.72-8.8 323.411 162.85 4.84 2.616-2.76 4.696-77.57 138.932-2.655 4.24-4.72-2.056L77.15 572.663l5.888-10.4 73.298-130.708h.008zM484.93 304.646l12.56-4.12V552.41h-6.336l-1.608-1.024-295.063-147.868 9.92-3.663 280.527-95.208zm328.716 95.784l14.175 4.695-291.487 146.708-7.375 3.663V303.054l5.303 1.6 279.392 95.792v-.016zM935.82 562.256l7.367 13.503-320.293 159.306-4.847 2.056-2.52-4.12-77.113-139.508-2.528-4.688 4.704-2.64L858.722 426.98l2.192 3.664 74.922 131.62h-.016zm49.1 12.463L884.863 397.334v-1.016a16.047 16.047 0 0 0-6.775-7.327l-359.05-133.797-1.04-.56-1.031-.464a14.967 14.967 0 0 0-7.968-2.176 13.71 13.71 0 0 0-7.84 2.176l-1.023.464-1.144.56-357.881 134.253a25.649 25.649 0 0 0-9.455 8.815l-100.04 178.52a19.414 19.414 0 0 0 8.88 24.958l81.249 40.053 8.43 4.231v207.15a18.91 18.91 0 0 0 10.48 17.151l358.45 151.42c2.99 1.487 6.223 2.159 9.438 2.159 3.248 0 6.48-.672 9.455-2.16l356.498-151.987h1.04a18.022 18.022 0 0 0 11.99-17.158V644.417l7.84-4.128 78.593-40.157 3.232-1.503 3.008-2.048a15.807 15.807 0 0 0 4.72-21.87v.008z" />
</svg>
<span>没有找到相关结果...</span>
</div>
<?php endif; ?>
</div>
<?php $this->pageNav(
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
</div>
<?php if ($this->options->JAside_cebianlan === 'on') : ?>
<?php $this->need('public/aside.php'); ?>
<?php endif; ?>
</div>
<?php $this->need('public/footer.php'); ?>
</body>
</html>