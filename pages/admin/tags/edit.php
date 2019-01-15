<?php
$aTag = $pdo->query("SELECT * FROM tags WHERE id={$_GET['id']} LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>

<div style="padding:20px;">
   <form class="" action="" method="post">
      <input type="hidden" name="api" value="tag_edit">
      <div class="form-group">
         <label for="">Name</label>
         <input type="text" name="name" class="form-control" value="<?=$aTag['name']?>">
      </div>
      <div class="form-group pull-right">
         <button class="btn btn-primary" type="submit">Update</button>
      </div>

   </form>
</div>

<script type="text/javascript">

$(document).ready(function() {

   $('form').submit(function(e) {
      e.preventDefault();

      data = {}

      $.each($(this).serializeArray(),function(e,v) {
         data[v['name']] = v['value'];
      })

      console.log(data);

      $.post('', data, function( result ) {
         console.log(result);
         window.location = "<?=BASE_URI?>admin/tags/list?admin=jina";
      });
   });

})
</script>
