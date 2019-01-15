<?php
// fetch posts
$query = "SELECT *
FROM        posts p
LEFT JOIN   tags t
ON          (t.id=p.tag_id)".(!empty($_GET['tid'])?"
WHERE       tag_id={$_GET['tid']}":"")."
ORDER BY    createdon DESC";

$aPosts = $pdo ->query($query) ->fetchAll(PDO::FETCH_ASSOC);
$aTags  = $pdo ->query("SELECT * FROM tags ORDER BY `name` ");?>

<div class="sub-title" id="blog-header">
   <h2>My Blog</h2>
   <ul class="blog-tags">
      <li>
         <a href="<?=BASE_URI?>" class="blog-tag">About me</a>
      </li>
      <li>
         <a href="<?=BASE_URI?>work" class="blog-tag">My work</a>
      </li>
   </ul>
   <a href="contact"><i class="icon-envelope"></i></a>
</div>

<div class="col-md-12 content-page">
   <div class="sub-title tags" >
      <ul class="blog-tags">
         <?php if(isset($_GET['tid'])) {?>
            <li>
               <a href="<?=BASE_URI?>blog" class="blog-tag bg-color-0" style="color:#000">&nbsp;&nbsp;all&nbsp;&nbsp;</a>
            </li>
         <?php }
         foreach($aTags as $n => $aTag) {
            $style = (isset($_GET['tid']) && $_GET['tid']==$aTag['id'])?'style="font-weight:bold"':"";?>
            <li>
               <a href="<?=BASE_URI?>blog?tid=<?=$aTag['id']?>"
                  <?=$style?>
                  class="blog-tag bg-color-<?=$aTag['color']?>">
                  <?=$aTag['name']?>
               </a>
            </li>
            <?php } ?>
      </ul>
   </div>

   <!-- Blog Post Start -->
   <?php foreach($aPosts as $aPost) { ?>
   <div class="col-md-12 blog-post">
      <div class="post-title">
         <a href="<?=BASE_URI?>post?pid=<?=$aPost['pid']?>"><h1><?=$aPost['title']?></h1></a>
      </div>
      <div class="post-info">
         <span><?=date('F j, Y',strtotime($aPost['createdon']))?> by Jina Lee</span>
      </div>
      <p><?=truncateHTML($aPost['content'],250,'...')?></p>
      <a href="post?pid=<?=$aPost['pid']?>" class="button button-style button-anim fa fa-long-arrow-right" style="margin-left:0;"><span>Read More</span></a>

   </div>
   <!-- Blog Post End -->
   <?php } ?>



   <div class="col-md-12 text-center">
      <a href="javascript:void(0)" id="load-more-post" class="load-more-button">Load</a>
      <div id="post-end-message"></div>
   </div>

</div>
