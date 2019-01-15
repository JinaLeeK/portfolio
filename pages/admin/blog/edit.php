<?php
$aPost = $pdo->query("SELECT * FROM posts WHERE pid={$_GET['id']} LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$aTags = $pdo->query("SELECT * FROM tags ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>

<div style="padding:20px;">
   <form class="" action="" method="post">
      <input type="hidden" name="api" value="post_edit">
      <div class="form-group">
         <label for="">Title</label>
         <input type="text" name="title" class="form-control" value="<?=$aPost['title']?>">
      </div>
      <div class="form-group">
         <label for="">Tag</label>
         <select name="tag_id" id="" class="form-control">
         <?php foreach($aTags as $aTag) {
            $sel = $aTag['id']==$aPost['tag_id']?'selected':''; ?>
            <option value="<?=$aTag['id']?>" <?=$sel?>><?=$aTag['name']?></option>
         <?php }?>
         </select>
      </div>
      <div class="form-group">
         <label for="">Content</label>
         <textarea name="content" id="content" rows="20" class="form-control">
            <?=$aPost['content']?>
         </textarea>
      </div>
      <div class="form-group pull-right">
         <button class="btn btn-primary" type="submit">Update</button>
      </div>

   </form>
</div>

<script type="text/javascript">

$(document).ready(function() {
   $("#content").summernote();

   $('form').submit(function(e) {
      e.preventDefault();

      data = {}

      $.each($(this).serializeArray(),function(e,v) {
         data[v['name']] = v['value'];
      })

      console.log(data);

      $.post('', data, function( result ) {
         console.log(result);
         window.location = "<?=BASE_URI?>admin/blog/list?admin=jina";
      });
   });

})
</script>
