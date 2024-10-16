<?php if ($this->options->Messagewall_card === 'on') : ?>
<div class="Xc_reads_leaving">
<?php $this->comments()->to($comments); ?>
<?php if ($comments->have()) : ?>
<ul class="Xc_reads_leaving-list">
<?php while ($comments->next()) : ?>
<li class="item">
<div class="user">
<img class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php _getAvatarByMail($comments->mail) ?>" alt="用户头像" />
<div class="nickname"><?php $comments->author(); ?></div>
<div class="date"><?php $comments->date('Y/m/d'); ?></div>
</div>
<div class="wrapper">
<div class="content"><?php _parseLeavingReply($comments->content); ?></div>
</div>
</li>
<?php endwhile; ?>
</ul>
<?php else : ?>
<div class="Xc_reads_leaving-none">暂无留言，期待第一个脚印。</div>
<?php endif; ?>
</div>
<?php endif; ?>