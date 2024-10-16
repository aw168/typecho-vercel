<div id="<?php $this->respondId(); ?>" class="Xc_comment_respond">

<form method="post" class="Xc_comment_respond-form" action="<?php $this->commentUrl() ?>" data-type="text">
<div class="head" style="margin-bottom: 15px;">

<div class="qqget_hasLogin ajax-user-avatar">
<img src="<?php $this->options->themeUrl('assets/img/qqtx.png'); ?>" width="35px" height="35px" class="avatar hasLogin-author  " style="width: 40px;height: 40px;border-radius: 50%;border: 1px solid var(--classA);padding: 2px;"></div>

<div class="list">
 <div class="title">昵称</div>
<input  class="Xc_input" type="text" name="author" id="author" placeholder="*昵称（必填）"  value="<?php $this->user->hasLogin() ? $this->user->screenName() : $this->remember('author') ?>" unselectable="off" onblur="fn_qqinfo()">
<span class="Xc_pointout" style="margin-left: -140px; display: none;"> 输入你的昵称 </span>
</div>

<div class="list">
<div class="title">邮箱</div>
<input  class="Xc_input" type="text" name="mail" id="mail" placeholder="*邮箱（必填）"  unselectable="off" value="<?php $this->user->hasLogin() ? $this->user->mail() : $this->remember('mail') ?>">
<span class="Xc_pointout" style="margin-left: -140px; display: none;"> 您将收到邮箱回复通知 </span>
</div>

<div class="list">
<div class="title">网址</div>
<input  class="Xc_input" type="text" value="<?php $this->user->hasLogin() ? $this->user->url() : $this->remember('url') ?>" autocomplete="off" name="url" placeholder="*网址（选填）" />
<span class="Xc_pointout" style="margin-left: -145px; display: none;"> 可通过昵称访问您的网站 </span>
</div>
</div>

<div class="body">
<textarea class="text Xc_owo_target" name="text" value="" autocomplete="new-password" placeholder="来都来了，说一句吧~"></textarea>
<div class="foot">
<div class="owo Xc_owo_contain"></div>
<div class="submit">
<span class="cancle Xc_comment_cancle">取消</span>
<button type="submit">发送评论</button>
</div>
</div>
</div>
</form>
</div>