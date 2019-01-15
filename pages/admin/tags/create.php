<div style="padding:20px;">
   <form class="" action="" method="post">
      <input type="hidden" name="api" value="tag_create">
      <div class="form-group">
         <label for="">name</label>
         <input type="text" name="name" class="form-control">
      </div>
      <div class="form-group pull-right">
         <button class="btn btn-primary" type="submit">Create</button>
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

      $.post('', data, function( result ) {
         window.location = "<?=BASE_URI?>admin/tags/list?admin=jina";
         // console.log(result)
      });
   });

})

</script>
