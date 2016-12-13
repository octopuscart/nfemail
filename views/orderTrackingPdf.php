<?php

include("../phpPlugin/mpdf/mpdf.php");
$mpdf = new mPDF('win-1252', 'A4', '', '', 10, 10, 20, 10, 0, 0);
//        $mpdf = new mPDF('c');
$stylesheet = file_get_contents('../assets/font-awesome/4.3/css/font-awesome.min.css');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */
//$mpdf->SetHeader('|' . $current_date . '');
$mpdf->SetFooter('|{PAGENO}/{nb}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
$data = $this->authobj->orderShippingDetail($this->user_id);
$html = '

<html>
    <body>
        '.$pdf_template_header.'
       
    
          <!-----=================== Order Description ============================------->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align:center">
                Order Tracking Report<br/><span style="font-size:12px">Client Code: '; 
               $html.= $this->client_code ;
               
                
            $html.= '</span></div>
            </div>
        </div> ';
$html.= '<table class="invoiceTable table"  style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif;border-collapse:collapse" >
            <input type="hidden" name="trLength" value="1" id="trlength"/>
            <tbody >
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
                    <th style="width:1px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>S.No.</b></th>
                    <th style="width:1px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Order No.</b></th>
                    <th style="width:7px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Invoice No.<b/></th>
                    <th style="width:25px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Shipping Date<b/></th>
                    <th style="width:1px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Weight<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Destination Country<b/></th>
                    <th style="width:17px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Tracking No.<b/></th>
                    <th style="width:17px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Shipping Company<b/></th>
                    <th style="width:1px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Date/Time<b/></th>
                    <th style="width:7px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Status<b/></th>
                </tr>';

for ($i = 0; $i < count($data); $i++) {



    $html.= '<tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;font-size: 11px">
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= $i + 1;
    $html.='</td>             
                         <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $html.= $data[$i]['order_no'];
    $html.='</td>
                               <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $html.= $data[$i]['invoice_no'];
    $html.='</td>
                                        <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $html.= $data[$i]['shipping_date'];
    $html.='</td>
                    <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= $data[$i]['total_weight'].' '. $data[$i]['weight_unit'];
    $html.='</td>
                        
                     <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $html.= $data[$i]['destination_country'];
    $html.='</td>
                      <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= $data[$i]['tracking_no'];

    $html.='</td>
                   <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $html.= $data[$i]['shipping_company'];
    $html.='</td>
    
                   <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $html.= $data[$i]['op_date_time'];
    $html.='</td>   
                   <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';

    $ids = $data[$i]['status'];
    $stat = $this->authobj->statusTag($ids);
    $html.= $stat[0]['title'];
    ;

    $html.='</td></tr>';
}
$html.='</table>  
    </div>
</div>

      
</body>';
?>