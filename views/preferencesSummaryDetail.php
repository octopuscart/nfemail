<?php

ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';

ob_end_clean();
include("../phpPlugin/mpdf/mpdf.php");
$current_date = date('d-m-Y');
$customized_id = $_REQUEST['customized_id'];
$query = "select * from nfw_custom_form_data where id =  $customized_id";
$final_data = resultAssociate($query);
//print_r($final_data);
$file_name = $final_data[0]['style_profile'];
$data = $final_data[0]['custom_form_data'];
$client_id = $final_data[0]['user_id'];
$clientcode = resultAssociate("select * from auth_user where id=$client_id");

$clientcode = end($clientcode);
$clientcode = $clientcode['registration_id'];


$shirtSummary = phpjsonstyle($data, 'php');
//$tagName = $_REQUEST['tag_name'];
//$product_cart_id = 49;
$mpdf = new mPDF('win-1252', 'A3', '', '', 20, 10, 20, 10, 0, 0);
//$stylesheet = file_get_contents('../admin/css/tnt_shirt.css');
$mpdf = new mPDF('c');

$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */
//$mpdf->SetHeader('|' . $current_date . '');
$mpdf->SetFooter('|{PAGENO}/{nb}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
$html =    $pdf_template_header;

$html .='<div style="width:100%;border:1px solid; height:15px; margin-bottom:10px;background:;font-size: 17px;color:black;text-align: center; padding:4px;background:"> <table style="width:100%"><tr><td style="text-align: right;">Style Profile Id</td><td style="    width: 5px;"> : </td><td style="text-align: left;">' . $file_name . '</td></tr><tr><td style="text-align: right;"> Client Code </td><td style="    width: 5px;"> : </td><td  style="text-align: left;"> ' . $clientcode. '</td></tr></table> </div>
     <div style="width:100%; height:15px;margin-bottom:10px;background: #d0d0d2;font-size: 17px;color: white;text-align: center; padding:4px; background:black;"> Style Summary</div>  
    
  
    <div class="" style="width:100%;border:1px solid;border-radius: 5px;">
    
          
             <table  style="width:100%;border: 1px solid #e4e4e4; border-collapse: collapse;">';

foreach ($shirtSummary as $key => $value) {
    $html.= '<tr><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;width:49%">' . $key . '</td><td style="border: 1px solid #e4e4e4; border-collapse: collapse;padding-left:20px;width:49%">' . $value . '</td></tr>';
}




          $html.='</table></div>
         
 </div>';
$html .='</body>
</html>';
//echo $html;
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
ob_clean();

$mpdf->Output($file_name.".pdf", 'D');
?>

