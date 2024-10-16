<?php if ($this->options->JAside_dhltm === 'on') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/css/Xc.dhltm.css'); ?>" />
<?php endif; ?>
<div class="header_internal">
<div class="Xc_total">
<svg class="header_internal-slideicon" viewBox="0 0 1152 1024" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
<path d="M76.032 872a59.968 59.968 0 1 0 0 120h999.936a59.968 59.968 0 1 0 0-120H76.032zm16-420.032a59.968 59.968 0 1 0 0 120h599.936a59.968 59.968 0 1 0 0-119.936H92.032zM76.032 32a59.968 59.968 0 1 0 0 120h999.936a60.032 60.032 0 0 0 0-120H76.032z" />
</svg>
<a class="header_internal-logo" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>" >
<img class="Xc_logo" alt="<?php $this->options->title(); ?>" src="<?php $this->options->JLogo() ?>" />
<img class="Xc_logo night" alt="<?php $this->options->title(); ?>" src="<?php $this->options->JLogo2() ?>" />
</a>
<nav class="header_internal_nav">
<div class="header_below">
<div class="Xc_total">
<?php
$custom_menu = $this->options->topzdydhl;
if ($custom_menu) {
$custom_arr = explode("
", $custom_menu);
if (count($custom_arr) > 0) {
foreach ($custom_arr as $custom_item) {
$data = explode("||", $custom_item);
if (count($data) >= 3) {
$main_category = trim($data[0]);
$main_category_urls = explode(",", trim($data[1]));
$sub_categories = explode(",", trim($data[2]));
$sub_category_urls = isset($data[3]) ? explode(",", trim($data[3])) : array();
echo '<div class="Xc_assort" trigger="hover">';
echo '<div class="Xc_assort_link">';
echo '<a href="' . $main_category_urls[0] . '" rel="nofollow">' . $main_category . '</a>';
echo '<svg class="Xc_assort_link-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="14" height="14"> <path d="M561.873 725.165c-11.262 11.262-26.545 21.72-41.025 18.502-14.479 2.413-28.154-8.849-39.415-18.502L133.129 375.252c-17.697-17.696-17.697-46.655 0-64.352s46.655-17.696 64.351 0l324.173 333.021 324.977-333.02c17.696-17.697 46.655-17.697 64.351 0s17.697 46.655 0 64.351L561.873 725.165z" fill="var(--main)"></path> </svg>';
echo '</div>';
echo '<div class="Xc_assort_si">';
foreach ($sub_categories as $index => $sub_category) {
$activeClass = ($currentUrl == $sub_category_urls[$index]) ? 'active' : '';
echo '<a class="' . $activeClass . '" href="' . $sub_category_urls[$index] . '">' . $sub_category . '</a>';
}
echo '</div>';
echo '</div>';
    } else {
$main_category = trim($data[0]);
$main_category_urls = explode(",", trim($data[1]));
$currentUrl = $this->request->getRequestUrl();
foreach ($main_category_urls as $index => $url) {
$activeClass = ($currentUrl == $url) ? 'active' : '';
echo '<a class="item ' . $activeClass . '" href="' . $url . '">' . $main_category . '</a>';
}}}}}
?>
</div>
</div>
</nav>
<svg class="header_internal-searchicon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="display: block;">
<path d="M1008.19 932.031L771.72 695.56a431.153 431.153 0 1 0-76.158 76.158l236.408 236.472a53.758 53.758 0 0 0 76.158 0 53.758 53.758 0 0 0 0-76.158zM107.807 431.185a323.637 323.637 0 0 1 323.316-323.381 323.7 323.7 0 0 1 323.381 323.38 323.637 323.637 0 0 1-323.38 323.317 323.637 323.637 0 0 1-323.317-323.316z" />
</svg>
<?php $this->need('Xccx/login.php'); ?>
<div class="Xc_action_item mode">
<svg class="icon-1" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25">
<path d="M587.264 104.96c33.28 57.856 52.224 124.928 52.224 196.608 0 218.112-176.128 394.752-393.728 394.752-29.696 0-58.368-3.584-86.528-9.728C223.744 832.512 369.152 934.4 538.624 934.4c229.376 0 414.72-186.368 414.72-416.256 1.024-212.992-159.744-389.12-366.08-413.184z" />
<path d="M340.48 567.808l-23.552-70.144-70.144-23.552 70.144-23.552 23.552-70.144 23.552 70.144 70.144 23.552-70.144 23.552-23.552 70.144zM168.96 361.472l-30.208-91.136-91.648-30.208 91.136-30.208 30.72-91.648 30.208 91.136 91.136 30.208-91.136 30.208-30.208 91.648z" />
</svg>
<svg class="icon-2" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25">
<path d="M234.24 512a277.76 277.76 0 1 0 555.52 0 277.76 277.76 0 1 0-555.52 0zM512 187.733a42.667 42.667 0 0 1-42.667-42.666v-102.4a42.667 42.667 0 0 1 85.334 0v102.826A42.667 42.667 0 0 1 512 187.733zm-258.987 107.52a42.667 42.667 0 0 1-29.866-12.373l-72.96-73.387a42.667 42.667 0 0 1 59.306-59.306l73.387 72.96a42.667 42.667 0 0 1 0 59.733 42.667 42.667 0 0 1-29.867 12.373zm-107.52 259.414H42.667a42.667 42.667 0 0 1 0-85.334h102.826a42.667 42.667 0 0 1 0 85.334zm34.134 331.946a42.667 42.667 0 0 1-29.44-72.106l72.96-73.387a42.667 42.667 0 0 1 59.733 59.733l-73.387 73.387a42.667 42.667 0 0 1-29.866 12.373zM512 1024a42.667 42.667 0 0 1-42.667-42.667V878.507a42.667 42.667 0 0 1 85.334 0v102.826A42.667 42.667 0 0 1 512 1024zm332.373-137.387a42.667 42.667 0 0 1-29.866-12.373l-73.387-73.387a42.667 42.667 0 0 1 0-59.733 42.667 42.667 0 0 1 59.733 0l72.96 73.387a42.667 42.667 0 0 1-29.44 72.106zm136.96-331.946H878.507a42.667 42.667 0 1 1 0-85.334h102.826a42.667 42.667 0 0 1 0 85.334zM770.987 295.253a42.667 42.667 0 0 1-29.867-12.373 42.667 42.667 0 0 1 0-59.733l73.387-72.96a42.667 42.667 0 1 1 59.306 59.306l-72.96 73.387a42.667 42.667 0 0 1-29.866 12.373z" />
</svg>
</div>
</div></div>

<div class="header_search">
<div class="Xc_total">
<div class="header_search_all">
<div class="Xc_search_inner">
<div class="Xc_label">
<div class="title">
<svg class="icon2" aria-hidden="true" style="width:17px;height:17px;margin-right:5px"><use xlink:href="#icon-A70"></use></svg>关键词搜索</div>
<form class="search" method="post" action="<?php $this->options->siteUrl(); ?>">
<input maxlength="20" autocomplete="off" placeholder="请输入关键字..." name="s" value="<?php echo $this->is('search') ? $this->archiveTitle(' &raquo; ', '', '') : '' ?>" class="input" type="text" />
<button type="submit" class="submit">搜索</button>
</form>
<?php $this->need('Xccx/label.php'); ?>
<?php if ($this->options->JAside_dhlliulan === 'on') : ?>
<div class="title" style="padding: 15px 0 0 0">
<svg class="icon2" aria-hidden="true" style="width:17px;height:17px;margin-right:5px"><use xlink:href="#icon-A89"></use></svg>近期浏览</div>
<div id="jl_viewHistory" style="display: block"></div>
<?php endif; ?>
</div>
<div class="Xc_ranking">
<div class="title">
<svg class="icon2" aria-hidden="true" style="width:17px;height:17px;margin-right:5px"><use xlink:href="#icon-A37"></use></svg>热门文章</div>
<div class="header_fiery" style="position: relative;">
<nav class="result">
<?php $this->widget('Widget_Contents_Hot@Search', 'pageSize=9')->to($item); ?>
<?php $index = 1; ?>
<?php while ($item->next()) : ?>
<a class="item" href="<?php $item->permalink(); ?>" title="<?php $item->title(); ?>">
<span class="sort"><?php echo $index; ?></span>
<span class="text"><?php $item->title(); ?></span>
<span class="views"></i><?php Postviews($item); ?> 阅读</span>
</a>
<?php $index++; ?>
<?php endwhile; ?>
</nav>
</div></div></div>
</div></div></div>

<div class="header_roll">
<img width="100%" height="150" class="header_roll-image" src="<?php $this->options->JAside_Wap_Image() ?>" alt="侧边栏壁纸" />
<div class="header_roll-author">
<img width="50" height="50" class="avatar" src="<?php $this->options->JAside_Author_Avatar ? $this->options->JAside_Author_Avatar() : _getAvatarByMail($this->authorId ? $this->author->mail : $this->user->mail) ?>" alt="博主昵称" />
<div class="info">
<a class="link" href="<?php $this->options->JAside_Author_Link() ?>" target="_blank" rel="noopener noreferrer nofollow"><?php $this->options->JAside_Author_Nick ? $this->options->JAside_Author_Nick() : ($this->authorId ? $this->author->screenName() : $this->user->screenName()); ?></a>
<p class="motto Xc_motto"></p>
</div>
</div>

<!--- wap端自定义模块 --->
<?php
$custom = [];
$custom_text = $this->options->JCustomNavs;
if ($custom_text) {
$custom_arr = explode("\r\n", $custom_text);
if (count($custom_arr) > 0) {
for ($i = 0; $i < count($custom_arr); $i++) {
$title = explode("||", $custom_arr[$i])[0];
$url = explode("||", $custom_arr[$i])[1];
$custom[] = array("title" => trim($title), "url" => trim($url));
};
}
}
?>
<?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
<?php if ($this->options->JCustomAside2) : ?>
<ul class="header_roll-count"><?php $this->options->JCustomAside2() ?></ul>
<?php endif; ?>
<ul class="header_roll-count">
<?php Typecho_Widget::widget('Widget_Stat')->to($count); ?>
<?php if ($this->options->JAside_waptj === 'on') : ?>
<li class="item">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A70"></use></svg>
<span>累计撰写 <strong><?php echo number_format($count->publishedPostsNum); ?></strong> 篇文章</span>
</li>
<li class="item">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A67"></use></svg>
<span>累计添加 <strong><?= _Tagtotal() ?></strong> 个标签</span>
</li>
<li class="item">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A65"></use></svg>
<span>累计收到 <strong><?php echo number_format($count->publishedCommentsNum); ?></strong> 条评论</span>
</li>
<?php endif; ?>
</ul>
<ul class="header_roll-menu panel-box">
<li class="Xc_balance">
<a class="link" href="<?php $this->options->siteUrl(); ?>" title="首页"><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A131"></use></svg>首页</a>
</li>
<!-- 分类 -->
<li>
<a class="link panel" href="#" rel="nofollow">
<span class="Xc_balance"><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A129"></use></svg>分类</span>
<svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="13" height="13">
<path d="M624.865 512.247L332.71 220.088c-12.28-12.27-12.28-32.186 0-44.457 12.27-12.28 32.186-12.28 44.457 0l314.388 314.388c12.28 12.27 12.28 32.186 0 44.457L377.167 848.863c-6.136 6.14-14.183 9.211-22.228 9.211s-16.092-3.071-22.228-9.211c-12.28-12.27-12.28-32.186 0-44.457l292.155-292.16z" />
</svg>
</a>
<ul class="slides panel-body panel-box">
<?php while ($category->next()) : ?>
<?php if ($category->levels === 0) : ?>
<?php $children = $category->getAllChildren($category->mid); ?>
<?php if (empty($children)) : ?>
<li><a class="link <?php echo $this->is('category', $category->slug) ? 'current' : '' ?>" href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a></li>
<?php else : ?>
<li>
<div class="link panel <?php echo $this->is('category', $category->slug) ? 'current' : '' ?>">
<a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
<svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="13" height="13">
<path d="M624.865 512.247L332.71 220.088c-12.28-12.27-12.28-32.186 0-44.457 12.27-12.28 32.186-12.28 44.457 0l314.388 314.388c12.28 12.27 12.28 32.186 0 44.457L377.167 848.863c-6.136 6.14-14.183 9.211-22.228 9.211s-16.092-3.071-22.228-9.211c-12.28-12.27-12.28-32.186 0-44.457l292.155-292.16z" />
</svg>
</div>
<ul class="slides panel-body">
<?php foreach ($children as $mid) : ?>
<?php $child = $category->getCategory($mid); ?>
<li><a class="link <?php echo $this->is('category', $child['slug']) ? 'current' : '' ?>" href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a></li>
<?php endforeach; ?>
</ul></li>
<?php endif; ?>
<?php endif; ?>
<?php endwhile; ?>
</ul></li>
<!-- 页面 -->
<li>
<a class="link panel" href="#" rel="nofollow">
<span class="Xc_balance"><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A3"></use></svg>页面</span>
<svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="13" height="13">
<path d="M624.865 512.247L332.71 220.088c-12.28-12.27-12.28-32.186 0-44.457 12.27-12.28 32.186-12.28 44.457 0l314.388 314.388c12.28 12.27 12.28 32.186 0 44.457L377.167 848.863c-6.136 6.14-14.183 9.211-22.228 9.211s-16.092-3.071-22.228-9.211c-12.28-12.27-12.28-32.186 0-44.457l292.155-292.16z" />
</svg>
</a>
<ul class="slides panel-body">
<?php foreach ($pages->stack as $item) : ?>
<li><a class="link <?php echo $this->is('page', $item['slug']) ? 'current' : '' ?>" href="<?php echo $item['permalink'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['title'] ?></a></li>
<?php endforeach; ?>
</ul>
</li>
<!-- 推荐 -->
<?php if (sizeof($custom) > 0) : ?>
<li>
<a class="link panel" href="#" rel="nofollow">
<span class="Xc_balance"><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A71"></use></svg>推荐</span>
<svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="13" height="13">
<path d="M624.865 512.247L332.71 220.088c-12.28-12.27-12.28-32.186 0-44.457 12.27-12.28 32.186-12.28 44.457 0l314.388 314.388c12.28 12.27 12.28 32.186 0 44.457L377.167 848.863c-6.136 6.14-14.183 9.211-22.228 9.211s-16.092-3.071-22.228-9.211c-12.28-12.27-12.28-32.186 0-44.457l292.155-292.16z" />
</svg>
</a>
<ul class="slides panel-body">
<?php foreach ($custom as $item) : ?>
<li><a class="link" href="<?php echo $item['url'] ?>" target="_blank" rel="noopener noreferrer nofollow"><?php echo $item['title'] ?></a></li>
<?php endforeach; ?>
</ul>
</li>
<?php endif; ?>
</ul>
<!-- 登入 -->
<ul class="header_roll-menu panel-box" style="margin-top: 15px;margin-bottom: 100px;">
<li>
<?php if ($this->user->hasLogin()) : ?>
<a class="link panel" href="#" rel="nofollow">
<span class="Xc_balance"><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A119"></use></svg><?php $this->user->screenName(); ?></span>
<svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
<path d="M231.594 610.125C135.087 687.619 71.378 804.28 64.59 935.994c-.373 7.25 3.89 23.307 30.113 23.307s33.512-16.06 33.948-23.301c6.861-114.025 63.513-214.622 148.5-280.346 3.626-2.804 16.543-17.618 3.24-39.449-13.702-22.483-40.863-12.453-48.798-6.08zm280.112-98.44v63.96c204.109 0 370.994 159.345 383.06 360.421.432 7.219 8.649 23.347 32.44 23.347s31.991-16.117 31.62-23.342c-12.14-236.422-207.676-424.386-447.12-424.386z" />
<path d="M319.824 319.804c0-105.974 85.909-191.883 191.882-191.883s191.883 85.91 191.883 191.883c0 26.57-5.405 51.88-15.171 74.887-5.526 14.809-2.082 31.921 20.398 38.345 23.876 6.822 36.732-8.472 41.44-20.583 11.167-28.729 17.294-59.973 17.294-92.65 0-141.297-114.545-255.842-255.843-255.842S255.863 178.506 255.863 319.804s114.545 255.843 255.843 255.843v-63.961c-105.973-.001-191.882-85.909-191.882-191.882z" />
<path d="M512 255.843s21.49-5.723 21.49-31.306S512 191.882 512 191.882c-70.65 0-127.921 57.273-127.921 127.922 0 3.322.126 6.615.375 9.875.264 3.454 14.94 18.116 37.044 14.425 22.025-3.679 26.6-21.93 26.6-21.93-.028-.788-.06-1.575-.06-2.37.001-35.325 28.637-63.961 63.962-63.961z" />
</svg>
</a>
<ul class="slides panel-body">
<li>
<?php if ($this->user->group == 'administrator' || $this->user->group == 'editor' || $this->user->group == 'contributor') : ?>
<a class="link" rel="noopener noreferrer nofollow" target="_blank" href="<?php $this->options->adminUrl("manage-posts.php"); ?>">管理文章</a>
<?php endif; ?>
</li>
<li>
<?php if ($this->user->group == 'administrator' || $this->user->group == 'editor') : ?>
<a class="link" rel="noopener noreferrer nofollow" target="_blank" href="<?php $this->options->adminUrl("manage-comments.php"); ?>">管理评论</a>
<?php endif; ?>
</li>
<li>
<?php if ($this->user->group == 'administrator') : ?>
<a class="link" rel="noopener noreferrer nofollow" target="_blank" href="<?php $this->options->adminUrl("options-theme.php"); ?>">修改外观</a>
<?php endif; ?>
</li>
<li>
<a class="link" rel="noopener noreferrer nofollow" target="_blank" href="<?php $this->options->adminUrl(); ?>">进入后台</a>
</li>
</ul>
<?php else : ?>
<a class="link panel" href="#" rel="nofollow">
<span class="Xc_balance"><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A17"></use></svg>用户登录</span>
<svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="13" height="13">
<path d="M624.865 512.247L332.71 220.088c-12.28-12.27-12.28-32.186 0-44.457 12.27-12.28 32.186-12.28 44.457 0l314.388 314.388c12.28 12.27 12.28 32.186 0 44.457L377.167 848.863c-6.136 6.14-14.183 9.211-22.228 9.211s-16.092-3.071-22.228-9.211c-12.28-12.27-12.28-32.186 0-44.457l292.155-292.16z"></path>
</svg>
</a>
<ul class="slides panel-body">
<li>
<a class="link" href="<?php $this->options->adminUrl('login.php'); ?>" target="_blank" rel="noopener noreferrer nofollow">登录</a>
<?php if ($this->options->allowRegister) : ?>
<a class="link" href="<?php $this->options->adminUrl('register.php'); ?>" target="_blank" rel="noopener noreferrer nofollow">注册</a>
<?php endif; ?>
</li>
</ul>
<?php endif; ?>
</li>
</ul>
</div>
