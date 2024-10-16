<?php if($this->user->hasLogin()): ?>
<a href="/admin" type="button" id="ClickMe" style="margin: 0px 3px 2px 13px"><svg t="1675873194952" id="ClickMe" class="loingico" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3929" width="22" height="22"><path d="M554.666667 349.44a48.213333 48.213333 0 1 1-47.786667 47.786667A48.213333 48.213333 0 0 1 554.666667 349.44m0-85.333333a133.546667 133.546667 0 1 0 133.546666 133.12A133.12 133.12 0 0 0 554.666667 264.106667z" fill="var(--routine)" p-id="3930"></path><path d="M768 759.893333a42.666667 42.666667 0 0 1-42.666667-42.666666 170.666667 170.666667 0 0 0-341.333333 0 42.666667 42.666667 0 0 1-85.333333 0 256 256 0 0 1 512 0 42.666667 42.666667 0 0 1-42.666667 42.666666z" fill="var(--routine)" p-id="3931"></path><path d="M554.666667 213.333333a341.333333 341.333333 0 1 1-341.333334 341.333334 341.333333 341.333333 0 0 1 341.333334-341.333334m0-85.333333a426.666667 426.666667 0 1 0 426.666666 426.666667A426.666667 426.666667 0 0 0 554.666667 128z" fill="var(--routine)" p-id="3932"></path></svg> </a>
<?php else: ?>

<a href="javascript:void(0)" type="button" id="ClickMe" style="margin: 0px 3px 2px 13px"><svg t="1675873194952" class="loingico" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3929" width="22" height="22"><path d="M554.666667 349.44a48.213333 48.213333 0 1 1-47.786667 47.786667A48.213333 48.213333 0 0 1 554.666667 349.44m0-85.333333a133.546667 133.546667 0 1 0 133.546666 133.12A133.12 133.12 0 0 0 554.666667 264.106667z" fill="var(--routine)" p-id="3930"></path><path d="M768 759.893333a42.666667 42.666667 0 0 1-42.666667-42.666666 170.666667 170.666667 0 0 0-341.333333 0 42.666667 42.666667 0 0 1-85.333333 0 256 256 0 0 1 512 0 42.666667 42.666667 0 0 1-42.666667 42.666666z" fill="var(--routine)" p-id="3931"></path><path d="M554.666667 213.333333a341.333333 341.333333 0 1 1-341.333334 341.333334 341.333333 341.333333 0 0 1 341.333334-341.333334m0-85.333333a426.666667 426.666667 0 1 0 426.666666 426.666667A426.666667 426.666667 0 0 0 554.666667 128z" fill="var(--routine)" p-id="3932"></path></svg> </a>


<div id="code" style="margin:40vh 0 -40vh auto">

<div class="typecho-login">
<div class="close1" style="margin:-28px -318px 10px auto"><a href="javascript:void(0)" id="closebt"><svg t="1675874818302" class="iconkkkg" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="8105" width="25" height="25"><path d="M512.3 63.9c-247.2 0-447.6 200.4-447.6 447.6S265.1 959 512.3 959s447.6-200.4 447.6-447.6S759.5 63.9 512.3 63.9z m201.4 591.4c15.9 15.9 15.9 41.7 0 57.5-15.9 15.9-41.7 15.9-57.5 0L512.3 569 368.4 712.8c-15.9 15.9-41.7 15.9-57.5 0-15.9-15.9-15.9-41.7 0-57.5l143.9-143.9-143.9-143.8c-15.9-15.9-15.9-41.7 0-57.5 15.9-15.9 41.7-15.9 57.5 0L512.3 454l143.8-144c15.9-15.9 41.7-15.9 57.5 0 15.9 15.9 15.9 41.7 0 57.5L569.8 511.4l143.9 143.9z" fill="var(--routine)" p-id="8106"></path></svg></a></div>
<form action="<?php $this->options->loginAction()?>" method="post" name="login" rold="form">
<h2>用户登录</h2>

<input type="hidden" name="referer" value="/admin">
<p>
<label for="name" class="sr-only">用户名</label>
<input type="text" name="name" autocomplete="username" placeholder="用户名" required/>
</p>
<p>
<label for="password" class="sr-only">密码</label>
<input type="password" name="password" autocomplete="current-password" placeholder="密码" required/>
</p>
<p class="submit">
<button type="submit" class="btn btn-l w-100 primary">登录</button>
</p>
<?php if ($this->options->allowRegister) : ?>
<p class="register">
<button type="register" class="btn btn-l w-100 primary">
<a href="/admin/register.php" target="_blank" rel="noopener noreferrer nofollow" style="color: #fff">注册</a>
</button>
</p>
<?php endif; ?>
</form></div></div>

<script>
$(function(){$('#ClickMe').click(function(){$('#code').center();$('#goodcover').show();$('#code').fadeIn()});$('#closebt').click(function(){$('#code').hide();$('#goodcover').hide()});$('#goodcover').click(function(){$('#code').hide();$('#goodcover').hide()});jQuery.fn.center=function(loaded){var obj=this;body_width=parseInt($(window).width());body_height=parseInt($(window).height());block_width=parseInt(obj.width());block_height=parseInt(obj.height());left_position=parseInt((body_width/2)-(block_width/2)+$(window).scrollLeft());if(body_width<block_width){left_position=0+$(window).scrollLeft()};top_position=parseInt((body_height/2)-(block_height/2)+$(window).scrollTop());if(body_height<block_height){top_position=0+$(window).scrollTop()};if(!loaded){obj.css({'position':'fixed'});$(window).bind('resize',function(){obj.center(!loaded)});$(window).bind('scroll',function(){obj.center(!loaded)})}else{obj.stop();obj.css({'position':'absolute'})}}})

</script>

<?php endif; ?>



