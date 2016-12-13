<?php

ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';

ob_end_clean();

include("../phpPlugin/mpdf/mpdf.php");

$current_date = date('d-m-Y');
$cart_id = $_REQUEST['cart_id'];

//$measurement_id = $_REQUEST['measurement_id'];
$query = "SELECT pc.customization_id,pc.customization_data,pc.measurement_id,pc.measurement_data,pc.posture_data,pc.user_images,au.registration_id,au.email	
               FROM `nfw_product_cart` as pc join auth_user as au on pc.user_id = au.id
               where pc.id = $cart_id";

$final_data = resultAssociate($query);
$file_name = $final_data[0]['customization_id'];
$data = $final_data[0]['customization_data'];
$shirtSummary = phpjsonstyle($data, 'php');
//$measurmentProfile1 = resultAssociate("SELECT * FROM `nfw_measurement_data` where id = $measurement_id ");

$mesdata = $final_data[0]['measurement_id'];
$clientcode = $final_data[0]['registration_id'];

$mes1 = $final_data[0]['measurement_data'];
$measurmentProfile = phpjsonstyle($mes1, 'php');

$pos1 = $final_data[0]['posture_data'];
$posture = phpjsonstyle($pos1, 'php');

$image_data = $final_data[0]['user_images'];
$image_data = trim($image_data, "[");
$image_data = trim($image_data, "]");
$image_data = explode(",", $image_data);

$tagName = $_REQUEST['tag_name'];
$mpdf = new mPDF('win-1252', 'A3', '', '', 20, 10, 20, 10, 0, 0);
$mpdf = new mPDF('c');
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */
$mpdf->SetFooter('|{PAGENO}/{nb}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
$html = $pdf_template_header;

$html .='<div style="width:100%;border:1px solid; margin-bottom:10px;background:;font-size: 17px;color:black;text-align: center; padding:4px;background:"><table style="width:100%"><tr><td style="text-align: right;">Style Profile Id</td><td style="    width: 5px;"> : </td><td style="text-align: left;">' . $file_name . '</td></tr><tr><td style="text-align: right;"> Client Code </td><td style="    width: 5px;"> : </td><td  style="text-align: left;"> ' . $clientcode. '</td></tr></table></div>
     <div style="width:100%; height:15px;margin-bottom:10px;background: #d0d0d2;font-size: 17px;color: white;text-align: center; padding:4px; background:black;">' . $tagName . ' Style Summary</div>  
    
  
    <div class="" style="width:100%;border:1px solid;border-radius: 5px;">
    
          
             <table style="width:100%;border: 1px solid #e4e4e4; border-collapse: collapse;">';

foreach ($shirtSummary as $key => $value) {
    $html.= '<tr style="border: 1px solid #e4e4e4; border-collapse: collapse;"><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;">' . $key . '</td><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;">' . $value . '</td></tr>';
}
$html.= '</table>
        <PageBreak>
        </div>
        <div class="page-break"></div>
       <div style=" page-break-after:always width:100%; height:15px;margin-bottom:10px;background: #d0d0d2;font-size: 17px;color: white;text-align: center; padding:4px; background:black;">' . $tagName . ' Measurement Summary</div>  
    
       <div  style="width:100%;border:1px solid;border-radius: 5px;">
   
    <table style="width:100%;border: 1px solid #e4e4e4; border-collapse: collapse;">';


foreach ($measurmentProfile as $key => $value) {
    $key1 = ucwords(str_replace("_", " ", $key));
    $html.= '<tr style="border: 1px solid #e4e4e4; border-collapse: collapse;"><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;">' . $key1 . '</td><td style="width:45%; border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;">' . $value . '</td></tr>';
}
$html .= "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;background:black;color:white;text-align:center;' colspan=2>Your Posture</td></tr>";
foreach ($posture as $key => $value) {
    $key1 = $key;
    $query = "SELECT set_image as image FROM nfw_custom_element_field as ncef
               join nfw_custom_element as nce on nce.id = ncef.nfw_custom_element_id 
               where nce.title = '$key' and ncef.child_label = '$value'";
    $imgobj = end(resultAssociate($query));
    echo $img = $imgobj['image'];


    $html.= '<tr style="border: 1px solid #e4e4e4; border-collapse: collapse;"><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;">' . $key1 . '</td><td style="width:45%; border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;"><span style="margin-left: 13px">' . $value . "</span><br><img src='" . $img . "' style='height: 100px;width:80px'></td></tr>";
}

$html .= "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;background:black;color:white;text-align:center;' colspan=2>Your Images</td></tr>";
$timg = '';
foreach ($image_data as $key1 => $value1) {
  
    $timg .= "<img style='height:300px;width:300px;float:left;margin:10px' src='".$imageserver."/medium/".trim($value1, '"'). "' >"; 
}
 $html.= "<tr class='tds' style='font-size:14px;height:28px;line-height: 15px;'><td style='line-height: 15px;' colspan=2>".$timg."</td></tr>";


$html.= '</table>


           </div>
         
 </div>';

$html .='</body>
</html>';
//echo $html;
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
ob_clean();
$mpdf->Output($file_name.".pdf", 'D');
?>

