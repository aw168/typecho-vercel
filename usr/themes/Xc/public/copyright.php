<div class="Xc_reads_copyright">
<div class="content">
<div class="item">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A119"></use></svg>
<span>发布作者：</span>
<span class="text"><?php $this->author(); ?></span>
</div>
<?php if ($this->options->JOverdue && $this->options->JOverdue !== 'off' && floor((time() - ($this->modified)) / 86400) > $this->options->JOverdue) : ?>
<div class="item">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A89"></use></svg>
<span>最后更新：</span>
<span class="text"><?php echo date('Y年 m月 d日 H:i', $this->modified); ?></span>
</div>
<?php endif; ?>
<div class="item">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A72"></use></svg>
<span>本文链接：</span>
<span class="text">
<a class="link" href="<?php $this->permalink() ?>" target="_blank" rel="noopener noreferrer nofollow"><?php $this->permalink() ?></a>
</span>
</div>
<div class="item">
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A56"></use></svg>
<span>作品采用：</span>
<span class="text">
《
<a class="link" href="//creativecommons.org/licenses/by-nc-sa/4.0/deed.zh" target="_blank" rel="noopener noreferrer nofollow">署名-非商业性使用-相同方式共享 4.0 国际 (CC BY-NC-SA 4.0)</a>
》许可协议授权
</span>
</div></div></div>
