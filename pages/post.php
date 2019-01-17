<?php
// if(!isset($_GET['pid'])) {
//    header('Location:  '.BASE_URI."blog");
// }
$query = "SELECT *   FROM posts p
LEFT JOIN            tags t ON (t.id=p.tag_id)
WHERE                p.slug='".create_slug($aPage['title'])."'
LIMIT                1";
// echo $query;
$aPost = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);
?>
<div class="sub-title">
   <a href="<?=BASE_URI?>blog" title="Go to Home Page"><h2>Back List</h2></a>
   <a href="#comment" class="smoth-scroll"><i class="icon-bubbles"></i></a>
</div>


<div class="col-md-12 content-page">
   <div class="sub-title tags" style="border:none;" >
      <ul class="blog-tags">
         <li>
            <a href="<?=BASE_URI?>blog?tid=<?=$aPost['tag_id']?>" class="blog-tag bg-color-<?=$aPost['color']?>"><?=$aPost['name']?></a>
         </li>
      </ul>
   </div>
   <div style="clear:both;"></div>
   <div class="col-md-12 blog-post" style="line-height:30px; font-size:16px;">


      <!-- Post Headline Start -->
      <div class="post-title">
         <h1><?=$aPost['title']?></h1>
      </div>
      <!-- Post Headline End -->


      <!-- Post Detail Start -->
      <div class="post-info">
         <span><?=date('F j, Y',strtotime($aPost['createdon']))?> by Jina Lee</span>
      </div>
      <!-- Post Detail End -->

      <?=$aPost['content']?>
      <!-- Post Comment (Disqus) Start -->
      <br><br>
      <div id="comment" class="comment">
         <h3>Discuss about post</h3>


         <!-- Disqus Code Start  (Please Note: Disqus will not be load on local, You have to upload it on server.)-->
         <div id="disqus_thread"></div>
         <script>

         /***  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS. LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables.

         var disqus_config = function () {
         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
      };
      */

      (function() { // DON'T EDIT BELOW THIS LINE
      var d = document, s = d.createElement('script');
      s.src = '//uipasta.disqus.com/embed.js';   // Please change the url from your own disqus id
      s.setAttribute('data-timestamp', +new Date());
      (d.head || d.body).appendChild(s);
   })();
   </script>
   <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
   <!-- Disqus Code End -->

   </div>
   <!-- Post Comment (Disqus) End -->



   </div>
</div>
