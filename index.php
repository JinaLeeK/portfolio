<?php
require 'includes/config.php';
require FUNC.'common.php';

connect_db();

require 'api.php';
/*
** Call to route here, we need it for autoloading
*/

$cUrl = ( empty($cUrl) )?preg_replace(
                        [ '/\?(.*)+/' , '/\/JinaBlog\//'],
                        ['',''],
                        trim($_SERVER['REQUEST_URI'])
                     ):$cUrl;
$aPage = route($cUrl);

?>

<!DOCTYPE html>
<html>
   <head><?php include MODULE.'head.php';?></head>
   <body>
      <!-- Preloader Start -->
      <div class="preloader">
         <div class="rounder"></div>
      </div>
      <!-- Preloader End -->

      <div id="main">
         <div class="container">
            <div class="row">

            <!-- About Me (Left Sidebar) Start -->
            <div class="col-md-3"><?php include MODULE.'about_me.php'; ?></div>
            <!-- About Me (Left Sidebar) End -->


            <!-- Content (Blog Post/Portfolio/ (Right Sidebar) Start -->
            <div class="col-md-9">
               <div class="col-md-12 page-body">
                  <div class="row"><?php include PAGE.$aPage['file'].'.php'; ?></div>
               </div>


               <!-- Footer Start -->
               <div class="col-md-12 page-body margin-top-50 footer">
                  <?php include MODULE.'footer.php'; ?>
               </div>
               <!-- Footer End -->
            </div>
            <!-- Content (Right Sidebar) End -->

         </div>
      </div>
   </div>



   <!-- Back to Top Start -->
   <a href="#" class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></a>
   <!-- Back to Top End -->


   <!-- All Javascript Plugins  -->
   <script type="text/javascript" src="<?=BASE_URI?>js/plugin.js"></script>
   <!-- Main Javascript File  -->
   <script type="text/javascript" src="<?=BASE_URI?>js/scripts.js"></script>
   <!-- <script type="text/javascript" src="</?=BASE_URI?>js/summernote.min.js"></script> -->
   <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>



</body>
</html>
