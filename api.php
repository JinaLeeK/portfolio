<?php
if(isset($_POST['api'])) {

   switch ($_POST['api']) {
      case 'post_del':
         $query = "DELETE FROM posts WHERE pid={$_POST['id']}";
         $redirect = "admin/blog/list?admin=jina";

         break;

      case 'post_create':
         $query   = "INSERT INTO posts (title, tag_id, content, slug) VALUES (?, ?, ?, ?)";
         $aVar    = [$_POST['title'], $_POST['tag_id'], $_POST['content'], create_slug($_POST['slug'])];
         $redirect = "admin/blog/list?admin=jina";

         break;

      case 'post_edit':
         $query = "UPDATE posts SET title=?, tag_id=?, content=?, slug=?  WHERE pid={$_GET['id']}";
         $aVar  = [$_POST['title'], $_POST['tag_id'], $_POST['content'], create_slug($_POST['slug'])];
         $redirect = "admin/blog/list?admin=jina";

         break;

      case 'tag_del':
         $query = "DELETE FROM tags WHERE id={$_POST['id']}";
         $redirect = "admin/tags/list?admin=jina";

         break;

      case 'tag_create':
         $query   = "INSERT INTO tags (name, color) VALUES (?,?)";
         $color   = $pdo->query("SELECT color FROM tags ORDER BY color DESC LIMIT 1")->fetch(PDO::FETCH_COLUMN);
         $aVar    = [$_POST['name'], $color+1];
         $redirect = "admin/tags/list?admin=jina";

         break;

      case 'tag_edit':
         $query = "UPDATE tags SET name=? WHERE id={$_GET['id']}";
         $aVar    = [$_POST['name']];
         $redirect = "admin/tags/list?admin=jina";

         break;


   }

   if(!empty($query)) {
      if(empty($aVar)) {
         $pdo->query($query);
      } else {
         $result = $pdo->prepare($query);
         $result->execute($aVar);
      }
      header("Location: ".BASE_URI.$redirect);
   }

   exit;
}
