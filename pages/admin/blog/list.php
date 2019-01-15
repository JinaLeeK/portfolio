<?php
$aPosts = $pdo ->query("SELECT * FROM posts p
   LEFT JOIN tags t ON (p.tag_id=t.id)
   ORDER BY p.`pid` DESC") ->fetchAll(PDO::FETCH_ASSOC);
?>
<div style="padding:20px">
   <table class="table table-hover">
      <thead>
         <tr>
            <th style="width:50%;">Title</th>
            <th class="text-center">Tag</th>
            <th class="text-center">Created at</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
         </tr>
      </thead>
      <tbody>
      <?php foreach($aPosts as $aPost) { ?>
         <tr>
            <td><a href="<?=BASE_URI?>post?pid=<?=$aPost['pid']?>"><?=substr($aPost['title'],0,50)?>...</a></td>
            <td class="text-center"><?=$aPost['name']?></td>
            <td class="text-center"><?=$aPost['createdon']?></td>
            <td class="text-center"><a href="<?=BASE_URI?>admin/blog/edit?admin=jina&id=<?=$aPost['pid']?>">edit</a></td>
            <td class="text-center"><a data-id=<?=$aPost['pid']?> href="javascript:void(0);" class="post_del">delete</a></td>
         </tr>
      <?php } ?>

      </tbody>
   </table>
   <br>
   <div class="text-center">
      <a href="<?=BASE_URI?>admin/blog/create?admin=jina" class="btn btn-primary">Create New Post</a>
   </div>
</div>
<script>
   $('.post_del').on('click', function() {
      $.post('', {
         'api' : 'post_del',
         'id':$(this).data('id')
      }, function(data) {
         location.reload();
      });
   })
</script>
