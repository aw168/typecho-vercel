<?php

function _parseContent($post, $login)
{
$content = $post->content;
$content = _parseReply($content);

if (strpos($content, '{lamp/}') !== false) {
$content = strtr($content, array(
"{lamp/}" => '<span class="Xc_lamp"></span>',
));
}
if (strpos($content, '{x}') !== false || strpos($content, '{ }') !== false) {
$content = strtr($content, array(
"{x}" => '<input type="checkbox" class="Xc_checkbox" checked disabled></input>',
"{ }" => '<input type="checkbox" class="Xc_checkbox" disabled></input>'
));
}
if (strpos($content, '{music') !== false) {
$content = preg_replace('/{music-list([^}]*)\/}/SU', '<xc-mlist $1></xc-mlist>', $content);
$content = preg_replace('/{music([^}]*)\/}/SU', '<xc-music $1></xc-music>', $content);
}
if (strpos($content, '{mp3') !== false) {
$content = preg_replace('/{mp3([^}]*)\/}/SU', '<xc-mp3 $1></xc-mp3>', $content);
}
if (strpos($content, '{bilibili') !== false) {
$content = preg_replace('/{bilibili([^}]*)\/}/SU', '<xc-bilibili $1></xc-bilibili>', $content);
}
if (strpos($content, '{dplayer') !== false) {
$player = Helper::options()->JCustomPlayer ? Helper::options()->JCustomPlayer : Helper::options()->themeUrl . '/library/player.php?url=';
$content = preg_replace('/{dplayer([^}]*)\/}/SU', '<xc-dplayer player="' . $player . '" $1></xc-dplayer>', $content);
}
if (strpos($content, '{mtitle') !== false) {
$content = preg_replace('/{mtitle([^}]*)\/}/SU', '<xc-mtitle $1></xc-mtitle>', $content);
}
if (strpos($content, '{abtn') !== false) {
$content = preg_replace('/{abtn([^}]*)\/}/SU', '<xc-abtn $1></xc-abtn>', $content);
}
if (strpos($content, '{cloud') !== false) {
$content = preg_replace('/{cloud([^}]*)\/}/SU', '<xc-cloud $1></xc-cloud>', $content);
}
if (strpos($content, '{anote') !== false) {
$content = preg_replace('/{anote([^}]*)\/}/SU', '<xc-anote $1></xc-anote>', $content);
}
if (strpos($content, '{dotted') !== false) {
$content = preg_replace('/{dotted([^}]*)\/}/SU', '<xc-dotted $1></xc-dotted>', $content);
}
if (strpos($content, '{message') !== false) {
$content = preg_replace('/{message([^}]*)\/}/SU', '<xc-message $1></xc-message>', $content);
}
if (strpos($content, '{progress') !== false) {
$content = preg_replace('/{progress([^}]*)\/}/SU', '<xc-progress $1></xc-progress>', $content);
}
if (strpos($content, '{hide') !== false) {
$db = Typecho_Db::get();
$hasComment = $db->fetchAll($db->select()->from('table.comments')->where('cid = ?', $post->cid)->where('mail = ?', $post->remember('mail', true))->limit(1));
if ($hasComment || $login) {
$content = strtr($content, array("{hide}" => "", "{/hide}" => ""));
} else {
$content = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '<xc-hide></xc-hide>', $content);
}
}
if (strpos($content, '{card-default') !== false) {
$content = preg_replace('/{card-default([^}]*)}([\s\S]*?){\/card-default}/', '<section style="margin-bottom: 15px"><xc-card-default $1><span class="_temp" style="display: none">$2</span></xc-card-default></section>', $content);
}
if (strpos($content, '{callout') !== false) {
$content = preg_replace('/{callout([^}]*)}([\s\S]*?){\/callout}/', '<section style="margin-bottom: 15px"><xc-callout $1><span class="_temp" style="display: none">$2</span></xc-callout></section>', $content);
}
if (strpos($content, '{alert') !== false) {
$content = preg_replace('/{alert([^}]*)}([\s\S]*?){\/alert}/', '<section style="margin-bottom: 15px"><xc-alert $1><span class="_temp" style="display: none">$2</span></xc-alert></section>', $content);
}
if (strpos($content, '{card-describe') !== false) {
$content = preg_replace('/{card-describe([^}]*)}([\s\S]*?){\/card-describe}/', '<section style="margin-bottom: 15px"><xc-card-describe $1><span class="_temp" style="display: none">$2</span></xc-card-describe></section>', $content);
}
if (strpos($content, '{tabs') !== false) {
$content = preg_replace('/{tabs}([\s\S]*?){\/tabs}/', '<section style="margin-bottom: 15px"><xc-tabs><span class="_temp" style="display: none">$1</span></xc-tabs></section>', $content);
}
if (strpos($content, '{card-list') !== false) {
$content = preg_replace('/{card-list}([\s\S]*?){\/card-list}/', '<section style="margin-bottom: 15px"><xc-card-list><span class="_temp" style="display: none">$1</span></xc-card-list></section>', $content);
}
if (strpos($content, '{timeline') !== false) {
$content = preg_replace('/{timeline}([\s\S]*?){\/timeline}/', '<section style="margin-bottom: 15px"><xc-timeline><span class="_temp" style="display: none">$1</span></xc-timeline></section>', $content);
}
if (strpos($content, '{collapse') !== false) {
$content = preg_replace('/{collapse}([\s\S]*?){\/collapse}/', '<section style="margin-bottom: 15px"><xc-collapse><span class="_temp" style="display: none">$1</span></xc-collapse></section>', $content);
}
if (strpos($content, '{gird') !== false) {
$content = preg_replace('/{gird([^}]*)}([\s\S]*?){\/gird}/', '<section style="margin-bottom: 15px"><xc-gird $1><span class="_temp" style="display: none">$2</span></xc-gird></section>', $content);
}
if (strpos($content, '{copy') !== false) {
$content = preg_replace('/{copy([^}]*)\/}/SU', '<xc-copy $1></xc-copy>', $content);
}

echo $content;
}
