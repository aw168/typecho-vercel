<div class="Xc_top_img top_img_post<?php if ($this->options->index_picture_wave === '03') : ?> Xc_top_yy<?php endif; ?>" style="background: url(<?php echo _getThumbnails($this)[0] ?>) center;background-size:cover;height:<?php $this->options->JWallpaper_picturepost() ?>">
<div class="infomation">
<h1 class="title Xc_psot_title"><?php $this->title() ?></h1>

<?php if ($this->is('post')): ?>
<div class="desctitle">
<svg class="icon2 sj" style="margin-right:2px;" aria-hidden="true"><use xlink:href="#icon-rili"></use></svg><span class="text sj"><?php $this->date('Y年m月d日'); ?></span>
<svg class="icon2 yd" style="margin:0 2px 0 10px" aria-hidden="true"><use xlink:href="#icon-huore"></use></svg><span class="text yd"><?php Postviews($this); ?>阅读</span>
<svg class="icon2 pl" style="margin:0 2px 0 10px" aria-hidden="true"><use xlink:href="#icon-xiaoxi"></use></svg><span class="text pl"><?php $this->commentsNum('%d'); ?>评论</span>
<svg class="icon2 dz" style="margin:0 2px 0 10px" aria-hidden="true"><use xlink:href="#icon-xihuan1"></use></svg><span class="text dz"><?php _getAgree($this) ?>点赞</span>
</div>
<?php else: ?>
<?php endif; ?>


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

