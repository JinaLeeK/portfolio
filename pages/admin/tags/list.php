<?php
$query = "SELECT id, name, COUNT(p.pid) as cnt FROM tags t LEFT JOIN posts p ON (t.id=p.tag_id) GROUP BY t.id";

$aTags = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>
<div style="padding:20px">
   <table class="table table-hover">
      <thead>
         <tr>
            <th style="text-align:left;width:50%;">Name</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
         </tr>
      </thead>
      <tbody>
      <?php foreach($aTags as $aTag) { ?>
         <tr>
            <td class="text-center"><?=$aTag['name']?>(<?=$aTag['cnt']?>)</td>
            <td class="text-center"><a href="<?=BASE_URI?>admin/tags/edit?admin=jina&id=<?=$aTag['id']?>">edit</a></td>
            <td class="text-center"><a data-id=<?=$aTag['id']?> href="javascript:void(0);" class="tag_del">delete</a></td>
         </tr>
      <?php } ?>

      </tbody>
   </table>
   <br>
   <div class="text-center">
      <a href="<?=BASE_URI?>admin/tags/create?admin=jina" class="btn btn-primary">Create New Tag</a>
   </div>
</div>
<script>
   $('.tag_del').on('click', function() {

      $.post('', {
         'api' : 'tag_del',
         'id':$(this).data('id')
      }, function(data) {
         location.reload();
      });
   })
</script>
