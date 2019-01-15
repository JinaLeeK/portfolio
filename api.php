<?php
if(isset($_POST['api'])) {

   switch ($_POST['api']) {
      case 'post_del':
         $query = "DELETE FROM posts WHERE pid={$_POST['id']}";

         break;

      case 'post_create':
         $query   = "INSERT INTO posts (title, tag_id, content) VALUES (?, ?, ?)";
         $aVar    = [$_POST['title'], $_POST['tag_id'], $_POST['content']];

         break;

      case 'post_edit':
         $query = "UPDATE posts SET title=?, tag_id=?, content=? WHERE pid={$_GET['id']}";
         $aVar  = [$_POST['title'], $_POST['tag_id'], $_POST['content']];


         break;

      case 'tag_del':
         $query = "DELETE FROM tags WHERE id={$_POST['id']}";

         break;

      case 'tag_create':
         $query   = "INSERT INTO tags (name, color) VALUES (?,?)";
         $color   = $pdo->query("SELECT color FROM tags ORDER BY color DESC LIMIT 1")->fetch(PDO::FETCH_COLUMN);
         $aVar    = [$_POST['name'], $color+1];

         break;

      case 'tag_edit':
         $query = "UPDATE tags SET name=? WHERE id={$_GET['id']}";
         $aVar    = [$_POST['name']];

         break;


   }

   if(!empty($query)) {
      if(empty($aVar)) {
         $pdo->query($query);
      } else {
         $result = $pdo->prepare($query);
         $result->execute($aVar);
      }
   }

   exit;
}
