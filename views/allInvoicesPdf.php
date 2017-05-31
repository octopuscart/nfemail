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
$mpdf->setFooter('Page {PAGENO} of {nb}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
$invoiceData = $this->authobj->invoiceDetail($this->user_id);
$html = '
<html>
    <body>
        '.$pdf_template_header.'
       
    
          <!-----=================== Order Description ============================------->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align:center">
                All Invoice Report<br/><span style="font-size:12px">Client Code: ';
$html.= $this->client_code;


$html.= '</span></div>
            </div>
        </div> ';
$html.= '<table class="invoiceTable table"  style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif;border-collapse:collapse" >
            <input type="hidden" name="trLength" value="1" id="trlength"/>
            <tbody >
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
                   <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>S.No.</b></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Date/Time</b></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Invoice No.<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Order No.<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Item Code<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Item Name<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Price<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Extra Price<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Coupon/Discount<b/></th>
         <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Wallet<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Total Price<b/></th>
                </tr>';

for ($i = 0; $i < count($invoiceData); $i++) {



    $invoice = $invoiceData[$i];
    $totalExtra = $this->authobj->totalExtraPrice($invoice['order_id']);
    $html.= '<tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;font-size: 11px">
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= $i + 1;
    $html.='</td>             
                         <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $html.= $invoice['op_date'];
    $html.='<br/>';
    $html.= $invoice['op_time'];
    $html.='</td>
                               <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';

    $html.= $invoice['invoice_no'];
    $html.='</td>
           <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= $invoice['order_no'];
    $html.='</td>
           <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $cart_obj = new CartHandler();
    $catObj = new CategoryHandler();

    //$data = $cart_obj->cartId($this->user_id, $invoice['order_id']);
    $orderDatas = $this->authobj->order_product_detail($invoice['order_id'], $this->user_id);
    $temp1 = array();
    for ($j = 0; $j < count($orderDatas); $j++) {
        $all_data = $orderDatas[$j];
         array_push($temp1, $all_data['item_code']);
    
    }
    $html.=  implode(', ', $temp1);
    $html.='</td>
            <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
    $datas = $this->authobj->countProducts($invoice['order_id']);
    $temp2 = array();
    for ($s = 0; $s < count($datas); $s++) {
        $tag_id = $datas[$s];
        //  print_r($tag_id['tag_id']);
        $res = $catObj->productTag($tag_id['tag_id']);
        $string = $res[0]['tag_title'] . '-' . $tag_id['total'];
        array_push($temp2, $string);
    }
    $html.= implode(',', $temp2);
    $html.='</td>
                     <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';

    $html.= '$' . number_format($totalExtra[0]['total'], 2, '.', '');
    $html.='</td>
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';

    if ($totalExtra[0]['extra'] > 0) {
        $html.='$' . number_format($totalExtra[0]['extra'], 2, '.', '');
    } else {
        $html.= '$00.00';
    }
    $amt =  number_format($totalExtra[0]['total'],2,'.','')+ number_format($totalExtra[0]['extra'],2,'.',''); 
    $out_data = $this->authobj->coupanDetail($invoice['coupon_id'], $amt); 
    $html.='</td>
    
    <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    if($out_data){
            $html.='$' . number_format($out_data, 2, '.', '');
    }else{
      $html.= '$00.00';
    }
     $html.='</td>
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    if($invoice['wallet_amount']){
                      $html.= '$' . number_format($invoice['wallet_amount'], 2, '.', '');
                       }
    else{ 
         $html.= "$00.00";
        
    }
    $html.='</td>
                <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
    $html.= '$' . number_format(explode('$', $invoice['total_amount'])[1], 2, '.', '');
    $html.='</td>
                
         </tr>';
}
$html.='</table>  
    </div>
</div>

      
</body>';
?>