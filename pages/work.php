<div class="sub-title">
   <h2>My Work</h2>
   <ul class="blog-tags">
      <li>
         <a href="<?=BASE_URI?>" class="blog-tag">About me</a>
      </li>
      <li>
         <a href="<?=BASE_URI?>blog" class="blog-tag">Blog</a>
      </li>
   </ul>
   <a class="contact" href="<?=BASE_URI?>contact"><i class="icon-envelope"></i></a>
</div>

<div class="col-md-12 content-page">
   <div class="col-md-12 blog-post">
      <div class="post-title margin-bottom-30">
         <h1>Let's take a look on <span class="main-color">My Work</span></h1>
      </div>

      <!-- Portfolio Start -->
      <div id="portfolio">
         <?php include MODULE.'work_ant.php'; ?><br>
         <?php include MODULE.'work_adv.php'; ?><br>
         <?php include MODULE.'work_intra.php'; ?><br>
         <?php include MODULE.'work_apple.php'; ?><br>
         <?php include MODULE.'work_dap.php'; ?><br>
         <?php include MODULE.'work_personal.php'; ?><br>
         <?php include MODULE.'work_samsung.php'; ?><br>
         <!-- </?php include MODULE.'work_master.php'; ?> -->
      <!-- Portfolio Detail End -->
      </div>
   <!-- Portfolio End -->
   </div>

   <div class="col-md-12 text-center">
      <a href="javascript:void(0)" id="load-more-portfolio" class="load-more-button">Load</a>
      <div id="portfolio-end-message"></div>
   </div>
</div>

<?php include MODULE.'modals/work_ant.php';        ?>
<?php include MODULE.'modals/work_adv.php';        ?>
<?php include MODULE.'modals/work_intra.php';      ?>
<?php include MODULE.'modals/work_apple.php';      ?>
<?php include MODULE.'modals/work_dap.php';        ?>
<?php include MODULE.'modals/work_samsung.php';    ?>
