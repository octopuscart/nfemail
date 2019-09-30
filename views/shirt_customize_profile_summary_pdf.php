 <?php
ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
function select_table($table_name, $condition) {
    $sql_data = mysql_query("select * from  $table_name $condition");
    //echo "select * from  $table_name $condition";
    $get_data = mysql_fetch_array($sql_data);
    return $get_data;
}
ob_end_clean();
include("../phpPlugin/mpdf/mpdf.php");
$current_date = date('d-m-Y');
$product_cart_id = $_REQUEST['cart_product_id'];
//$product_cart_id = 49;
$mpdf = new mPDF('win-1252', 'A4', '', '', 20, 10, 20, 10, 0, 0);
//$stylesheet = file_get_contents('../admin/css/tnt_shirt.css');
$mpdf=new mPDF('c'); 

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

$mpdf->defaultheaderfontsize = 10;	/* in pts */
$mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
$mpdf->SetHeader('|'.$current_date.'');
$mpdf->SetFooter('|{PAGENO}/{nb}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
$html = '<html>
          <body>
                <div>
                  <div style="text-align:center;margin-bottom:0px"> <span style="font-family: sans-serif;font-size:30px;">Nita Fashions</span></div>
                   <div style="margin-top:0px;text-align:center;font-family: sans-serif;font-size:12px">  <span style="">16 Mody Road, GF, T. S. T, Kowloon, Hong Kong<br>
                         T: + (852) 27219990, 27219991,  F: +852 27234886, E: info@nitafashions.com, W: www.nitafashions.com             
                      </span>
                  </div>
                </div>   
                <hr></hr>';

    $query = "select scp.* from nfw_shirt_custom as scp join nfw_product_cart as npc on npc.customization_id  = scp.id where npc.customization_id = $product_cart_id ";
    $shirtSummary = resultAssociate($query);
//print_r($shirtSummary);echo "<br>";
    if ($shirtSummary) {
        $firstBlock = array_slice($shirtSummary[0], 0, 14);
        $secondBlock = array_slice($shirtSummary[0], 14, 25);
//print_r($secondBlock);
        $summary_id = $shirtSummary[0]['id'];
    }
   $measurmentProfile = resultAssociate("SELECT nm.* FROM `nfw_measurement` as nm 
                   join nfw_product_cart as nc
                   on nm.id = nc.measurement_id
                   where nc.customization_id  = $product_cart_id ");
//print_r($measurmentProfile);
  $shirt = select_table('shirt_body_fit', "where shirt_body_fit_id='" . $firstBlock['shirt_body_fit'] . "'");
  $collar = select_table('collar', "where id='" . $firstBlock['collar_styles'] . "'");
  $cuff = select_table('cuff', "where id='" . $firstBlock['cuff_styles'] . "'");
  $front = select_table('front', "where id='" . $firstBlock['front_styles'] . "'");
  $backf = select_table('back', "where id='" . $firstBlock['back_styles'] . "'");
  $pocket = select_table('pocket', "where id='" . $secondBlock['pocket_styles'] . "'");
  $bottom = select_table('shirt', "where id='" . $secondBlock['bottom_styles'] . "'");
  $button = select_table('button', "where id='" . $secondBlock['buttons'] . "'");
  $back = select_table('monogram', "where id='" . $secondBlock['monogram_styles'] . "'");
                                                               
                                 
 $html .='<div style="width:100%; height:15px; margin-bottom:10px;background: #d0d0d2;font-size: 17px;color: white;text-align: center; padding:4px;background: #41bedd;">Style Id # '.$product_cart_id.'</div>
     <div style="width:100%; height:15px; margin-bottom:10px;background: #d0d0d2;font-size: 17px;color: white;text-align: left; padding:4px; background:#007A89;">Style Summary</div>  
   <div style="width:100%;">
    <div class="" style="width: 49%;float: left;margin-right:20px;background-color: #E7F9FA;">
        <div style="border: 1px solid; height:340px;border-radius: 5px;">
          <div style="margin:5px;"> 
             <table style="width:100%">
                <tr style="width:100%;">
                   <td style="font-size:14px">Fabric No.</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$firstBlock['fabric_no'].'</td>
                </tr>
                <tr>
                    <td style="font-size:14px">Shirt Body Fit</td>
                    <td>:</td>
                    <td style="font-size:12px">'.$shirt['file_name'].'</td>
                </tr>
                <tr>
                    <td style="font-size:14px">Collar Styles</td>
                    <td>:</td>
                    <td style="font-size:12px">'.$collar['file_name'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Button Down Collar</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$firstBlock['button_down_collar'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:13px; width:185px;">Add 2 Buttons on the Collar Band</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$firstBlock['add_2_buttons_on_the_collar_band'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:13px">Collar & Cuff Stiffness</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$firstBlock['collar_and_cuff_stiffness'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Collar Stays</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$firstBlock['collar_stays'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Sleeve Styles</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$firstBlock['sleeve_styles'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Cuff Styles</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$cuff['file_name'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Watch</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$firstBlock['watch'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Watch Wrist</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$firstBlock['watch_wrist'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Front Styles</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$front['file_name'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Back Styles</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$backf['file_name'].'</td>
                </tr>
            </table>
          </div>
        </div> 
        </div>
        <div class="" style="width: 49%;float: right;margin-left:20px; background-color: #E7F9FA;">
        <div style="border: 1px solid; height:340px; border-radius: 5px;">
           <div style="margin:5px;"> 
             <table style="width:100%">
                <tr>
                   <td style="font-size:14px">Dart</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['dart'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Pocket Styles</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$pocket['file_name'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Bottom Styles</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$bottom['file_name'].'</td>
                </tr>
               <tr>
                   <td style="font-size:14px">Collar & Cuff Features</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['collar_and_cuff_features'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Inner Collar Contrasts</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['inner_collar_contrasts'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Inner Cuff Contrasts</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['inner_cuff_contrasts'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px;width:180px;">Inner Front Placket Contrasts</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['innerfront_placket_contrasts'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Labels</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['labels'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Buttons</td>
                   <td>:</td>
                   <td style="font-size:11px">'.$button['file_name'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Monogram Placements</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['monogram_placements'] .'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Monogram Styles</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$back['file_name'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Monogram Colors</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['monogram_colors'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Additional Feature</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$secondBlock['additional_feature'].'</td>
                </tr>
            </table>
          </div>
        </div> 
    </div>
    </div>';
     $html .='<div style="width:100%; height:15px; margin-bottom:10px; margin-top:10px; background: #d0d0d2;font-size: 17px;color: white;text-align: left; padding:4px; background:#007A89;">Measurement</div>   
         <div style="width:100%;">
    <div class="" style="width: 49%;float: left;">
        <div style="border: 1px solid; height:190px; background-color: #E7F9FA;border-radius: 5px;">
           <div style="margin:5px;"> 
             <table style="width:100%">
                <tr>
                   <td style="font-size:14px">Profile Name</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['profile_name'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Gender</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['gender'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Height</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['height'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Weight</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['weight'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Neck Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['neck_measurement'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px;width:150px;">Full Chest Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['full_chest_measurement'].'</td>
                </tr>
                <tr>
                   <td style="font-size:14px">Full Shoulder Width</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['full_shoulder_width_measurement'].'</td>
                </tr>
            </table>
          </div>
        </div> 
        </div>
        <div class="" style="width: 49%;float: right;">
        <div style="border: 1px solid; height:190px; background-color: #E7F9FA;border-radius: 5px;">
          <div style="margin:5px;"> 
             <table style="width:100%">
                <tr>
                   <td style="font-size:14px">Right Sleeve Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['right_sleeve_measurement'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Left Sleeve Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['left_sleeve_measurement'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Bicep Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['bicep_measurement'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Wrist Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['wrist_measurement'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Waist/Stomach Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['waist_or_stomach_measurement'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px">Hips/Seat Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['hips_or_seat_measurement'].'</td>
                </tr>
                 <tr>
                   <td style="font-size:14px;width:230px;">Front Shirt/Jacket Length Measurement</td>
                   <td>:</td>
                   <td style="font-size:12px">'.$measurmentProfile[0]['front_shirt_or_jacket_length_measurement'].'</td>
                </tr>
            </table>
          </div>
        </div> 
    </div>
    </div>';
                        
  $html .='</body>
</html>';

//echo $html;
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
ob_clean();

$mpdf->Output('../assets/order.pdf','I');
?>

