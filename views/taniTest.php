<?php

//mkdir('/var/www/ramm1');
//chmod('/var/www/ramm1', 0777);
$filepath = '/home/atharva/Pictures/AM/AM53-87/AM53-87/AM85.jpg';
  // print_r($filepath);
   if (file_exists($filepath)) {
             echo "The file $filepath exists";
      } 
      else{
          echo "dfd";
      }


//for($i=85;$i<88;$i++){
//   $filename = 'AM'.$i.'.jpg';
//   //echo $filename;
//  // $filepath = '/home/atharva/Pictures/AM/AM53-87/AM53-87/AM85.jpg';
//
//   $filepath = '/var/www/rani/AM/AM53-87/AM53-87/'.$filename; 
//  // print_r($filepath);
//   if (file_exists($filepath)) {
//             echo "The file $filepath exists";
//      } 
//      else{
//          echo "dfd";
//      }
//}
//

?>