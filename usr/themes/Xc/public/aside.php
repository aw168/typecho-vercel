<div class="Xc_aside">
<div class="Xc_aside_item author">
<img width="100%" height="120" class="image" src="<?php $this->options->JAside_Author_Image() ?>" alt="博主栏壁纸" />
<div class="user">
<img width="75" height="75" class="avatar" src="<?php $this->options->JAside_Author_Avatar ? $this->options->JAside_Author_Avatar() : _getAvatarByMail($this->authorId ? $this->author->mail : $this->user->mail) ?>" alt="博主头像" />
<a class="link" href="<?php $this->options->JAside_Author_Link() ?>" target="_blank" rel="noopener noreferrer nofollow"><?php $this->options->JAside_Author_Nick ? $this->options->JAside_Author_Nick() : ($this->authorId ? $this->author->screenName() : $this->user->screenName()); ?></a>
<p class="motto Xc_motto"></p>
</div>
<?php Typecho_Widget::widget('Widget_Stat')->to($item); ?>
<div class="count">
<div class="item" title="累计文章数">
<span class="num"><?php echo number_format($item->publishedPostsNum); ?></span>
<span>文章数</span>
</div>
<div class="item" title="累计标签数">
<span class="num"><?= _Tagtotal() ?></span>
<span>标签数</span>
</div>
<div class="item" title="累计评论数">
<span class="num"><?php echo number_format($item->publishedCommentsNum); ?></span>
<span>评论量</span>
</div>
</div>

<?php if ($this->options->JAside_Author_Nav !== "off") : ?>
<ul class="list"><?php _getAsideAuthorNav() ?></ul>
<?php endif; ?>
</div>

<?php if ($this->options->JCustomAside) : ?>
<div class="Xc_aside_item"><?php $this->options->JCustomAside() ?></div>
<?php endif; ?>

<?php if ($this->options->JAside_Timelife_Status === 'on') : ?>
<div class="Xc_aside_item timelife">
<div class="Xc_aside_item-title">
<svg class="icon2" aria-hidden="true" style="margin-right:5px;width:17px;height:17px"><use xlink:href="#icon-A123"></use></svg>
<span class="text">人生倒计时</span>
<span class="xccx_mac"></span>
</div>
<div class="Xc_aside_item-contain"></div>
</div>
<?php endif; ?>
<?php if ($this->options->JAside_History_Today === 'on') : ?>
<?php
$time = time();
$todayDate = date('m/d', $time);
$db = Typecho_Db::get();
$prefix = $db->getPrefix();
$sql = "SELECT * FROM `{$prefix}contents` WHERE created < {$time} and FROM_UNIXTIME(created, '%m/%d') = '{$todayDate}' and type = 'post' and status = 'publish' and (password is NULL or password = '') LIMIT 10";
$result = $db->query($sql);
$historyTodaylist = [];
if ($result instanceof Traversable) {
foreach ($result as $item) {
$item = Typecho_Widget::widget('Widget_Abstract_Contents')->push($item);
$historyTodaylist[] = array(
"title" => htmlspecialchars($item['title']),
"permalink" => $item['permalink'],
"date" => $item['year'] . ' ' . $item['month'] . '/' . $item['day']
);
}}
?>
<?php endif; ?>

<?php if ($this->options->JAside_Newreply_Status === 'on' && $this->options->JCommentStatus !== 'off') : ?>
<div class="Xc_aside_item newreply">
<div class="Xc_aside_item-title">
<svg class="icon2" aria-hidden="true" style="margin-right:5px;width:17px;height:17px"><use xlink:href="#icon-A65"></use></svg>
<span class="text">最新评论</span>
<span class="xccx_mac"></span>
</div>
<?php $this->widget('Widget_Comments_Recent', 'ignoreAuthor=true&pageSize=5')->to($item); ?>
<ul class="Xc_aside_item-contain">
<?php if ($item->have()) : ?>
<?php while ($item->next()) : ?>
<li class="item">
<div class="user">
<img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php _getAvatarByMail($item->mail) ?>" alt="<?php $item->author(false) ?>" />
<div class="info">
<div class="author"><?php $item->author(false) ?></div>
<span class="date"><?php echo formatTime($item->created); ?></span>
</div>
</div>
<div class="reply">
<a class="link" href="<?php _parseAsideLink($item->permalink); ?>">
<?php _parseAsideReply($item->content); ?>
</a>
</div>
</li>
<?php endwhile; ?>
<?php else : ?>
<li class="empty">人气很差！一条评论也没有！</li>
<?php endif; ?>
</ul>
</div>
<?php endif; ?>

<?php if ($this->options->JAside_Hot_Num && $this->options->JAside_Hot_Num !== 'off') : ?>
<div class="Xc_aside_item hot">
<div class="Xc_aside_item-title">
<svg class="icon2" aria-hidden="true" style="margin-right:5px;width:17px;height:17px"><use xlink:href="#icon-A37"></use></svg>
<span class="text">热门文章</span>
<span class="xccx_mac"></span>
</div>
<?php $this->widget('Widget_Contents_Hot@Aside', 'pageSize=' . $this->options->JAside_Hot_Num)->to($item); ?>
<ol class="Xc_aside_item-contain">
<?php if ($item->have()) : ?>
<?php $index = 1; ?>
<?php while ($item->next()) : ?>
<li class="item">
<a class="link" href="<?php $item->permalink(); ?>" title="<?php $item->title(); ?>">
<i class="sort"><?php echo $index; ?></i>
<img width="100%" height="130" class="image lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($item)[0]; ?>" alt="<?php $item->title() ?>" />
<div class="describe">
<h6><?php $item->title(); ?></h6>
<span><?php $item->views(); ?> 阅读 - <?php $item->date('m/d'); ?></span>
</div>
</a>
</li>
<?php $index++; ?>
<?php endwhile; ?>
<?php else : ?>
<li class="empty">这个博主很懒！</li>
<?php endif; ?>
</ol>
</div>
<?php endif; ?>

<?php if ($this->options->JAside_3DTag === 'on') : ?>
<div class="Xc_aside_item tags">
<div class="Xc_aside_item-title">
<svg class="icon2" aria-hidden="true" style="margin-right:5px;width:17px;height:17px"><use xlink:href="#icon-A67"></use></svg>
<span class="text">标签云</span>
<span class="xccx_mac"></span>
</div>
<?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 50))->to($tags); ?>
<div class="Xc_aside_item-contain" style="padding:10px">
<?php if ($tags->have()) : ?>
<div class="tag"></div>

<ul class="cloud">
<?php $colors  = [
'#F8D800','#0396FF','#EA5455','#7367F0','#32CCBC','#F6416C','#28C76F','#9F44D3','#F55555','#736EFE','#E96D71','#DE4313','#D939CD','#4C83FF','#F072B6','#C346C2','#5961F9','#FD6585','#465EFB','#FFC600','#FA742B','#5151E5','#BB4E75','#FF52E5','#49C628','#00EAFF','#F067B4','#F067B4','#ff9a9e','#00f2fe','#4facfe','#f093fb','#6fa3ef','#bc99c4','#46c47c','#f9bb3c','#e8583d','#f68e5f',
]; ?>
<?php while ($tags->next()) : ?>
<li class="item"><a style="background:<?php echo $colors[mt_rand(0, count($colors) - 1)] ?>" href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a></li>
<?php endwhile; ?>
</ul>
<?php else : ?>
<div class="empty">暂无标签</div>
<?php endif; ?>
</div>
</div>
<?php endif; ?>

<?php if ($this->options->JADContent) : ?>
<a class="Xc_aside_item advert" target="_blank" rel="noopener noreferrer nofollow" href="<?php echo explode("||", $this->options->JADContent)[1]; ?>" title="广告">
<img class="lazyload" width="100%" src="<?php _getLazyload() ?>" data-src="<?php echo explode("||", $this->options->JADContent)[0]; ?>" alt="广告" />
<span class="icon">广告</span>
</a>
<?php endif; ?>

<?php if ($this->options->JAside_Flatterer === 'on') : ?>
<div class="Xc_aside_item flatterer">
<div class="Xc_aside_item-title">
<svg class="icon2" aria-hidden="true" style="margin-right:5px;width:17px;height:17px"><use xlink:href="#icon-Agou"></use></svg>
<span class="text">舔狗日记</span>
<span class="xccx_mac"></span>
</div>
<div class="Xc_aside_item-contain">
<div class="content"></div>
<div class="change">
<svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="23" height="23"><path d="M55.935033 264.48948c0 0 85.897017-132.548409 221.81443-203.673173 135.916406-71.121743 303.368504-50.646859 413.187968 18.319527 109.819465 68.970415 146.791894 127.160016 146.791894 127.160016l94.59499-53.879895c0 0 19.576483-9.697092 19.576483 12.932142l0 338.379961c0 0 0 30.17399-22.837719 19.395191-19.210878-9.062571-226.959086-127.198289-292.424528-164.466828-35.950145-16.035251-4.365101-29.062068-4.365101-29.062068l91.284402-52.173738c0 0-52.068992-65.209619-128.278989-99.744682-81.576231-42.501826-157.948384-47.541735-251.497925-12.224097-61.002644 23.025054-132.823368 81.988166-184.553949 169.082716L55.935033 264.48948 55.935033 264.48948 55.935033 264.48948zM904.056909 711.697844c0 0-85.897017 132.550423-221.816444 203.671159-135.917413 71.12275-303.366489 50.651895-413.186961-18.315498-109.825508-68.972429-146.790886-127.165052-146.790886-127.165052L27.662591 823.768348c0 0-19.572454 9.703135-19.572454-12.932142L8.090137 472.459267c0 0 0-30.170968 22.831676-19.397205 19.211885 9.067607 226.965129 127.198289 292.430571 164.470856 35.950145 16.035251 4.366109 29.058039 4.366109 29.058039l-91.285409 52.175753c0 0 52.071006 65.206598 128.279996 99.744682 81.57321 42.498804 157.942341 47.540728 251.496918 12.222082 60.998616-23.026061 132.820346-81.983131 184.546898-169.082716L904.056909 711.697844 904.056909 711.697844 904.056909 711.697844zM904.056909 711.697844" fill="var(--classA)" p-id="2335"></path></svg>
</div>
</div>
</div>
<?php endif; ?>
</div>
