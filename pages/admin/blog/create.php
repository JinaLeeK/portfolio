<?php
$aTags = $pdo->query("SELECT * FROM tags ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>

<div style="padding:20px;">
   <form class="" action="" method="post">
      <input type="hidden" name="api" value="post_create">
      <div class="form-group">
         <label for="">Title</label>
         <input type="text" name="title" class="form-control">
      </div>
      <div class="form-group">
         <label for="">Slug</label>
         <input type="text" name="slug" class="form-control">
      </div>
      <div class="form-group">
         <label for="">Tag</label>
         <select name="tag_id" id="" class="form-control">
         <?php foreach($aTags as $aTag) {?>
            <option value="<?=$aTag['id']?>"><?=$aTag['name']?></option>
         <?php }?>
         </select>
      </div>
      <div class="form-group">
         <label for="">Content</label>
         <textarea name="content" id="content" rows="20" class="form-control"></textarea>
      </div>
      <div class="form-group pull-right">
         <button class="btn btn-primary" type="submit">Create</button>
      </div>

   </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
   tinymce.init({
   selector: '#content',
   theme: 'modern',
   plugins: [
     'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
     'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
     'save table contextmenu directionality emoticons template paste textcolor'
   ],
   toolbar: 'fontselect, fontsizeselect | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
 });

   // $('form').submit(function(e) {
   //
   //    data = {}
   //
   //    $.each($(this).serializeArray(),function(e,v) {
   //       data[v['name']] = v['value'];
   //    })
   //
   //    console.log(data);
   //    e.preventDefault();
   //
   //    // $.post('', data, function( result ) {
   //       // console.log(result);
   //       // window.location = "</?=BASE_URI?>admin/blog/list?admin=jina";
   //    // });
   // });

})

</script>
