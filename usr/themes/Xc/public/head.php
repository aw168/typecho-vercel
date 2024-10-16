<!DOCTYPE html>
<!-- 

　　写字楼里写字间，写字间里程序员;
　　程序人员写程序，又拿程序换酒钱。
　　酒醒只在网上坐，酒醉还来网下眠;
　　酒醉酒醒日复日，网上网下年复年。
　　宁愿老死电脑间，不愿鞠躬老板前;
　　不见满街漂亮妹，哪个归得程序员。

-->
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
<link rel="shortcut icon" href="<?php $this->options->JFavicon() ?>" />
<title><?php $this->archiveTitle(array('category' => '分类 %s 下的文章', 'search' => '包含关键字 %s 的文章', 'tag' => '标签 %s 下的文章', 'author' => '%s 发布的文章'), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php if ($this->is('single')) : ?>
<meta name="keywords" content="<?php echo $this->fields->keywords ? $this->fields->keywords : htmlspecialchars($this->_keywords); ?>" />
<meta name="description" content="<?php echo $this->fields->description ? $this->fields->description : htmlspecialchars($this->_description); ?>" />
<?php $this->header('keywords=&description='); ?>
<?php else : ?>
<?php $this->header(); ?>
<?php endif; ?>
</head>

