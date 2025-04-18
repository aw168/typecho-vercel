<?php

/**
 * 轮播图模块
 */

if (!defined('__TYPECHO_ROOT_DIR__')) {
	http_response_code(404);
	exit;
}

$carousel = [];
$carousel_text = $this->options->JIndex_Carousel;
if ($carousel_text) {
	$carousel_arr = explode("\r\n", $carousel_text);
	if (count($carousel_arr) > 0) {
		for ($i = 0; $i < count($carousel_arr); $i++) {
			if (is_numeric($carousel_arr[$i])) {
				$this->widget('Widget_Contents_Post@' . $carousel_arr[$i], 'cid=' . $carousel_arr[$i])->to($item);
				$img = joe\getThumbnails($item)[0];
				$url = $item->permalink;
				$title = $item->title;
			} else {
				$img = explode("||", $carousel_arr[$i])[0] ?? '';
				$url = explode("||", $carousel_arr[$i])[1] ?? '';
				$title = explode("||", $carousel_arr[$i])[2] ?? '';
			}
			$carousel[] = array("img" => trim($img), "url" => trim($url), "title" => trim($title));
		};
	}
}
?>
<?php if (count($carousel) > 0) : ?>
	<div class="joe_index__banner mb25">
		<?php if (count($carousel) > 0) : ?>
			<div class="swiper swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ($carousel as $item) : ?>
						<div class="swiper-slide">
							<a class="item" href="<?= $item['url'] ?>" target="<?php $this->options->JIndex_Carousel_Target() ?>" rel="noopener noreferrer nofollow">
								<img referrerpolicy="no-referrer" rel="noreferrer" width="100%" height="100%" class="thumbnail lazyload error-thumbnail" src="<?php joe\getLazyload() ?>" data-src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" />
								<div class="title"><?= $item['title'] ?></div>
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
<?php endif; ?>