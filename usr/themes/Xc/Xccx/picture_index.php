<div class="Xc_top_img top_img_index<?php if ($this->options->index_picture_wave === '03') : ?> Xc_top_yy<?php endif; ?>" style="background: url(<?php echo _Xc_img($this)[0]; ?>) center;background-size:cover;height:<?php $this->options->JWallpaper_picturezhi() ?>">
<div class="infomation">
<h1 class="title">
<?php if ($this->is('index')): ?>
<?php $this->options->JWallpaper_top_title() ?>
<?php else: ?>
<?php $this->title() ?>
<?php endif; ?>
</h1>
<div class="desctitle" style="font-size: 18px">
<span id="yiyan"><?php $this->options->JWallpaper_top_introduce() ?></span>
</div>
</div>

<?php if ($this->options->index_picture_roll === 'on') : ?>
<div id="scroll-down">
<svg class="icon scroll-down-effects" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4245" width="30" height="30">
<path d="M940.936189 483.222583l-16.813944-16.404622c-23.277146-22.642696-60.989049-22.642696-84.258009 0L511.412622 786.512121 182.958962 466.817961c-23.26896-22.642696-60.980863-22.642696-84.214007 0L81.889055 483.222583c-23.236214 22.64065-23.236214 59.349713 0 81.954547l370.436844 360.591615c0.032746 0.040932 0.067538 0.110517 0.110517 0.152473l16.84669 16.371876c23.234167 22.64065 60.946071 22.64065 84.223217 0l16.84669-16.371876c0.044002-0.040932 0.078795-0.110517 0.110517-0.152473l370.395912-360.591615C964.205149 542.572296 964.205149 505.863233 940.936189 483.222583L940.936189 483.222583z" fill="#FFF"></path>
</svg>
</div>
<?php endif; ?>

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

<?php if ($this->options->wap_picture_index): ?>
<style>
@media(max-width:768px){
.Xc_top_img.top_img_index {
    background: url(<?php $this->options->wap_picture_index() ?>) center !important;
    background-size: cover !important;
}
}
</style>
<?php endif; ?>

