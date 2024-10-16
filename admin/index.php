<?php
include 'common.php';
include 'header.php';
include 'menu.php';
include 'FreshUi.php';
$stat = Typecho_Widget::widget('Widget_Stat');
?>


<div class="page-header">
  <h3 class="page-title">
	<span class="page-title-icon  mr-2">
	  <i class="mdi mdi-account"></i>
	</span>博客数据</h3>
</div>
<div class="row index_tj">
  <div class="col-xl-3 col-md-6">
	<div class="card bg-gradient-danger card-img-holder text-white">
	  <div class="card-body">
		<img src="<?php $options->siteUrl(); ?>Fresh/img/circle.svg" class="card-img-absolute" alt="circle-image">
		<h4 class="font-weight-normal mb-3">文章总计<i class="mdi mdi-library-books mdi-24px float-right"></i></h4>
		<h2><?php _e('%s 篇文章',$stat->myPublishedPostsNum); ?></h2>

                                   
                              
	  </div>
	</div>
  </div>
  <div class="col-xl-3 col-md-6">
	<div class="card bg-gradient-info card-img-holder text-white">
	  <div class="card-body">
		<img src="<?php $options->siteUrl(); ?>Fresh/img/circle.svg" class="card-img-absolute" alt="circle-image">
		<h4 class="font-weight-normal mb-3">评论总计<i class="mdi mdi-comment-processing-outline mdi-24px float-right"></i></h4>
		<h2><?php _e('%s 条评论',$stat->myPublishedCommentsNum); ?></h2>
	  </div>
	</div>
  </div>
  <div class="col-xl-3 col-md-6">
	<div class="card bg-gradient-success card-img-holder text-white">
	  <div class="card-body">
		<img src="<?php $options->siteUrl(); ?>Fresh/img/circle.svg" class="card-img-absolute" alt="circle-image">
		<h4 class="font-weight-normal mb-3">分类总计<i class="mdi mdi-buffer mdi-24px float-right"></i></h4>
		<h2><?php _e('%s 个分类',$stat->categoriesNum); ?></h2>

	  </div>
	</div>
  </div>
  <div class="col-xl-3 col-md-6">
	<div class="card bg-gradient-warning card-img-holder text-white">
	  <div class="card-body">
		<img src="<?php $options->siteUrl(); ?>Fresh/img/circle.svg" class="card-img-absolute" alt="circle-image">
		<h4 class="font-weight-normal mb-3">用户等级<i class="mdi mdi-buffer mdi-24px float-right"></i></h4>
		<h2>
		
		<?php switch ($user->group) {
                                    case 'administrator':
                                        _e('管理员');
                                        break;
                                    case 'editor':
                                        _e('编辑');
                                        break;
                                    case 'contributor':
                                        _e('贡献者');
                                        break;
                                    case 'subscriber':
                                        _e('关注者');
                                        break;
                                    case 'visitor':
                                        _e('访问者');
                                        break;
                                    default:
                                        break;
                                } ?>
		
		
		</h2>

	  </div>
	</div>
  </div>
   <div class="col-md-4">
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">更新内容</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
          <div class="modal-body">
          <?php Typecho_Widget::widget('Widget_Options_Reading')->form()->render(); ?>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">关闭</button>
            </div>
            
        </div>
    </div>
</div>
  
   </div>
</div>

<div class="row">
  
 
 
  
  <div class="col-md-6 stretch-card index_list">
	<div class="card">
	  <div class="card-body t_top">
		<h4 class="card-title"><i class="mdi mdi-information-outline"></i> <?php _e('最新文章'); ?></h4>
		<div class="table-responsive">
		  <table class="table">
			<thead>
			  <tr>
				<th> 日期 </th>
				<th> 文章标题 </th>
			  </tr>
			</thead>
			<tbody>
			<?php Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=10')->to($posts); ?>
			<?php if($posts->have()): ?>
			<?php while($posts->next()): ?>
			  <tr>
				<td><span class="text-warning"><?php $posts->date('m.d'); ?></span></td>
				<td><a href="<?php $posts->permalink(); ?>" class="title"><?php $posts->title(); ?></a></td>
			  </tr>
			  <?php endwhile; ?>
			  <?php else: ?>
				<td><em><?php _e('暂时没有文章'); ?></em></td>
			  <?php endif; ?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
  
  <div class="col-md-6 stretch-card index_list">
	<div class="card">
	  <div class="card-body t_top">
		<h4 class="card-title"><i class="mdi mdi-information-outline"></i> <?php _e('最新回复'); ?></h4>
		<div class="table-responsive">
		  <table class="table">
			<thead>
			  <tr>
				<th> 日期 </th>
				<th> 评论内容 </th>
			  </tr>
			</thead>
			<tbody>
			<?php Typecho_Widget::widget('Widget_Comments_Recent', 'pageSize=10')->to($comments); ?>
			<?php if($comments->have()): ?>
			<?php while($comments->next()): ?>
			  <tr>
				<td><span class="text-warning"><?php $comments->date('m.d'); ?></span></td>
				<td><a href="<?php $comments->permalink(); ?>" class="title"><?php $comments->excerpt(35, '...'); ?></a></td>
			  </tr>
			  <?php endwhile; ?>
			  <?php else: ?>
				<td><em><?php _e('暂时没有回复'); ?></em></td>
			  <?php endif; ?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
</div>
<?php
include 'copyright.php';
include 'common-js.php';
include 'footer.php';
?>