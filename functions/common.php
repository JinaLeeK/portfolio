<?php

function connect_db() {
   global $pdo;

   try {
      if( !isset($pdo)) {
         $pdo = new PDO(
            'mysql:host='.DBHOST.';port=3307;dbname='.DBNAME,
            DBUSER,
            DBPASS,
            [
               PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
               PDO::ATTR_PERSISTENT           => false,
               PDO::ATTR_TIMEOUT              => 10,
               PDO::ATTR_EMULATE_PREPARES     => false,
            ]
         );

      }
   } catch(PDOException $e) {
      echo "<h1>Connection error.</h1><br><h3>I'll be right back.</h3>";
      exit;
   }
}

// Routing traffic
function route( $cUrl ) {
   $aPage = array();

   // $cUrl  = str_replace('/JinaBlog/','',trim($_SERVER['REQUEST_URI']));
   if( empty($cUrl) ) {
   }

   if( str_replace('admin','',$cUrl) != $cUrl) {
      if( isset($_GET['admin']) && $_GET['admin'] == 'jina' ) {

         $aPage['file']       = $cUrl;
         $aPage['title']      = 'admin';
         $aPage['canonical']  = BASE_URI.$cUrl;
      } else {
         header("Location: ".BASE_URI);
      }

   } else if( str_replace('post','',$cUrl) != $cUrl) {
      $aPage['file'] = 'post';
      $aPage['title'] = create_slug(str_replace('post/','',$cUrl),1);
      $aPage['canonical'] = BASE_URI.$cUrl;
   } else if( is_file( PAGE.$cUrl.'.php')) {
      $aPage['file']       = $cUrl;
      $aPage['title']      = hfwords($cUrl);
      $aPage['canonical']  = BASE_URI.$cUrl;
   } else if( empty($cUrl) ) {
      $aPage['file']       = 'about';
      $aPage['title']      = 'Jina\'s Dev Blog';
      $aPage['canonical']  = BASE_URI;
   }

   return $aPage;
}

function hfwords($cStr) {
   // human-friendly words
   return ucwords(
      str_replace( ['-','_'],' ', trim($cStr))
   );
}

function truncateHTML($str, $len, $end = '&hellip;'){
   //find all tags
   $tagPattern = '/(<\/?)([\w]*)(\s*[^>]*)>?|&[\w#]+;/i';  //match html tags and entities
   preg_match_all($tagPattern, $str, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER );
   //WSDDebug::dump($matches); exit;
   $i =0;
   //loop through each found tag that is within the $len, add those characters to the len,
   //also track open and closed tags
   // $matches[$i][0] = the whole tag string  --the only applicable field for html enitities
   // IF its not matching an &htmlentity; the following apply
   // $matches[$i][1] = the start of the tag either '<' or '</'
   // $matches[$i][2] = the tag name
   // $matches[$i][3] = the end of the tag
   //$matces[$i][$j][0] = the string
   //$matces[$i][$j][1] = the str offest

   while($matches[$i][0][1] < $len && !empty($matches[$i])){

      $len = $len + strlen($matches[$i][0][0]);
      if(substr($matches[$i][0][0],0,1) == '&' )
      $len = $len-1;


      //if $matches[$i][2] is undefined then its an html entity, want to ignore those for tag counting
      //ignore empty/singleton tags for tag counting
      if(!empty($matches[$i][2][0]) && !in_array($matches[$i][2][0],array('br','img','hr', 'input', 'param', 'link'))){
         //double check
         if(substr($matches[$i][3][0],-1) !='/' && substr($matches[$i][1][0],-1) !='/')
         $openTags[] = $matches[$i][2][0];
         elseif(end($openTags) == $matches[$i][2][0]){
            array_pop($openTags);
         }else{
            $warnings[] = "html has some tags mismatched in it:  $str";
         }
      }


      $i++;

   }

   $closeTagString = '';

   if (!empty($openTags)){
      $openTags = array_reverse($openTags);
      foreach ($openTags as $t){
         $closeTagString .="</".$t . ">";
      }
   }

   if(strlen($str)>$len){
      // Finds the last space from the string new length
      $lastWord = strpos($str, ' ', $len);
      if ($lastWord) {
         //truncate with new len last word
         $str = substr($str, 0, $lastWord);
         //finds last character
         $last_character = (substr($str, -1, 1));
         //add the end text
         $truncated_html = ($last_character == '.' ? $str : ($last_character == ',' ? substr($str, 0, -1) : $str) . $end);
      }
      //restore any open tags
      $truncated_html .= $closeTagString;


   }else
   $truncated_html = $str;


   return $truncated_html;
}

function create_slug($string, $bSlug = 0){
   if($bSlug) {
      $slug=preg_replace('/-/',' ', $string);
   } else {
      $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   }
   return $slug;
}
