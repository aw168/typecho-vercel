<?php

/**
 * “ 心中无女人，代码自然神 ” <br /> “ 环境推荐：PHP 7.4 ”
 * @package Xc-Theme
 * @author 狱长
 * @link https://www.tmetu.cn
 */

?>
<?php $this->need('public/head.php'); ?>
<?php $this->need('public/include.php'); ?>
<script src="<?php _getAssets('assets/js/Xc.index.min.js'); ?>"></script>
<body>
<?php $this->need('public/header.php'); ?>
<?php $this->need('Xccx/picture_index.php'); ?>
<div class="Xc_total Xc_Pjax showInUp">
<div class="Xc_main index">
<div class="Xc_home">
<?php
$carousel = [];
$carousel_text = $this->options->JIndex_Carousel;
if ($carousel_text) {
$carousel_arr = explode("\r\n", $carousel_text);
if (count($carousel_arr) > 0) {
for ($i = 0; $i < count($carousel_arr); $i++) {
$img = explode("||", $carousel_arr[$i])[0];
$url = explode("||", $carousel_arr[$i])[1];
$title = explode("||", $carousel_arr[$i])[2];
$carousel[] = array("img" => trim($img), "url" => trim($url), "title" => trim($title));
};
}
}
?>

<div class="Xc_home_roll">
<?php if (sizeof($carousel) > 0) : ?>
<div class="swiper-container">
<div class="swiper-wrapper">
<?php foreach ($carousel as $item) : ?>
<div class="swiper-slide">
<a class="item" href="<?php echo $item['url'] ?>" target="_blank" rel="noopener noreferrer nofollow">
<img width="100%" height="100%" class="thumbnail lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo $item['img'] ?>" alt="<?php echo $item['title'] ?>" />
<div class="title"><?php echo $item['title'] ?></div>
<svg class="icon" viewBox="0 0 1026 1024" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
<path d="M784.3 1007.961a33.2 33.2 0 0 1-27.106-9.062L540.669 854.55 431.766 962.813c-9.062 9.062-36.168 18.044-45.23 9.062a49.72 49.72 0 0 1-27.106-45.23V727.763a33.2 33.2 0 0 1 9.463-27.106l343.071-370.578a44.748 44.748 0 0 1 63.274 63.274l-334.17 361.515v72.175l63.273-54.211a42.583 42.583 0 0 1 54.212-9.062l198.64 126.386L910.847 140.34 151.647 510.837 323.343 619.34c18.044 9.062 27.106 45.23 9.062 63.273-9.062 18.044-45.23 27.106-63.273 18.044L34.082 547.005c-8.981-8.982-18.043-17.723-18.043-36.168s9.062-27.105 27.105-36.167l903.79-451.815c18.043-9.062 36.167-9.062 45.229 0 18.284 9.223 18.284 27.106 18.284 45.15L829.69 971.794c0 18.043-9.062 27.105-27.105 36.167z" />
</svg>
</a>
</div>
<?php endforeach; ?>
</div>
<div class="swiper-pagination"></div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
</div>
<?php endif; ?>
</div>
<?php $this->need('Xccx/index_article_top.php'); ?>
<ul class="Xc_home_article-list">
<?php while ($this->next()) : ?>
<?php if ($this->fields->mode === "default" || !$this->fields->mode) : ?>
<li class="Xc_home_article-si default Xct">
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
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
<div class="last" style="display:flex">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg>
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"><?php echo $this->categories[0]['name']; ?></a>
</div>
</div>
</div>
</li>
<?php elseif ($this->fields->mode === "single") : ?>
<li class="Xc_home_article-si single Xct">
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
<div class="last" style="display:flex">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg>
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"><?php echo $this->categories[0]['name']; ?></a>
</div>
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
<div class="last" style="display:flex">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg>
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"><?php echo $this->categories[0]['name']; ?></a>
</div>
</div>
</li>
<?php else : ?>
<li class="Xc_home_article-si none Xct">
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
<div class="last" style="display:flex">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg>
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"><?php echo $this->categories[0]['name']; ?></a>
</div>
</div>
</div>
</li>
<?php endif; ?>
<?php endwhile; ?>
</ul>
</div>
<?php if ($this->options->JPageStatus === 'default') : ?>
<?php $this->pageNav(
'<svg class="icon icon-prev" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
'<svg class="icon icon-next" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',1,'...',
array(
'wrapTag' => 'ul',
'wrapClass' => 'Xc_pagination',
'itemTag' => 'li',
'textTag' => 'a',
'currentClass' => 'active',
'prevClass' => 'prev',
'nextClass' => 'next'
)
);?>
<?php else : ?>

<div class="Xc_load" data-type="article">
<?php $this->pageLink('查看更多', 'next'); ?>
</div>
<script>
jQuery(document).ready(function ($) {
  var $next = $(".next");
  var $archiveList = $(".Xc_home_article-list");
  $next.click(function () {
    var $this = $(this).addClass("Xc").text("加载中...");
    var href = $this.attr("href");
    if (href != null) {
      $.ajax({
        url: href,
        type: "get",
        success: function (data) {
          $this.removeClass("loadingbibi-arrow-repeat").text("加载更多");
          var $list = $(data).find(".Xc_home_article-si.Xct:not(.sticky)");
          $archiveList.append($list);
          var newHref = $(data).find(".next").attr("href");
          $next.attr("href", newHref);
          if (!newHref) {
            $next.remove().hide();
            Qmsg.warning("没有更多内容了");
          }
        }
      });
    }
    return false;
  });
});
</script>
<?php endif ?>
</div>
<?php if ($this->options->JAside_cebianlan === 'on') : ?>
<?php $this->need('public/aside.php'); ?>
<?php endif; ?>
</div>
<?php $this->need('public/footer.php'); ?>
</div>
</body>
</html>