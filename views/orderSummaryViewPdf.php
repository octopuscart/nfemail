<?php

ob_start();
include("../dbhandler/dbhandler.php");
include '../producthandler/productHandler.php';
include '../producthandler/authHandler.php';

class MailAndMessageHandler {

    public function __construct($user_id, $authobj, $tab, $client_code) {

        //$this->productId = $product_id;
        $this->user_id = $user_id;
        $this->authobj = $authobj;
        $this->tab = $tab;
        $this->option = $option;
        $this->client_code = $client_code;
    }

    function orderPdf() {
        ob_end_clean();

        $pdf_template = resultAssociate("select * from nfw_pdf_template");
        $pdf_templater = end($pdf_template);
        $pdf_template_header = $pdf_templater['header'];
        include("../phpPlugin/mpdf/mpdf.php");
        $mpdf = new mPDF('win-1252', 'A4', '', '', 10, 10, 20, 10, 0, 0);

        $stylesheet = file_get_contents('../assets/font-awesome/4.3/css/font-awesome.min.css');
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
        $mpdf->defaultheaderfontsize = 10; /* in pts */
        $mpdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
        $mpdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */

        $mpdf->setFooter('Page {PAGENO} of {nb}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
        $data = $this->authobj->allOrderDetails($this->user_id);
        $html = '<html>
    <body>
        ' . $pdf_template_header . '
       
    
          <!-----=================== Order Description ============================------->
        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);0">
            <div style="padding:10px;text-align:center">
                Order Summary Report<br/><span style="font-size:12px">Client Code: ';
        $html.= $this->client_code;


        $html.= '</span></div>
            </div>
        </div> ';
        $html.= '<table class="invoiceTable table"  style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif;border-collapse:collapse" >
            <input type="hidden" name="trLength" value="1" id="trlength"/>
            <tbody >
                <tr style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>S.No.</b></th>
                    <th style="width:20px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Order No.</b></th>
                    <th style="width:50px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Description<b/></th>
                    <th style="width:20px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Date/Time<b/></th>
                    <th style="width:1px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Total Price<b/></th>
                    <th style="width:10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 7px;font-size: 11px;text-align:left"><b>Order Status<b/></th>

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

            $datas = $this->authobj->countProducts($data[$i]['id']);
            //print_r($datas);
            $temp = array();
            for ($s = 0; $s < count($datas); $s++) {
                $tag_id = $datas[$s];
                $catObj = new CategoryHandler();
                $res = $catObj->productTag($tag_id['tag_id']);
                $html.='<span>';
                $string = $res[0]['tag_title'] . '-' . $tag_id['total'];
                array_push($temp, $string);
                $html.='</span>';
            }
            $html.= implode(', ', $temp);
            $html.='</td>
 <td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $html.= $data[$i]['op_date'] . $data[$i]['op_time'];
            $html.='</td>
<td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:right">';
            $d1 = explode('$', $data[$i]['total_price'])[1];
            $html.='$' . number_format($d1, 2, '.', '');
            $html.='</td>

<td style="font-size: 11px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse; padding: 7px;text-align:left">';
            $html.= $data[$i]['title'];
            $html.='</td>
</tr>';
        }
        $html.='</table>  
</div>
</div>


</body>';

// end
        $mpdf->WriteHTML($html, 2);
        ob_clean();
        $fname = 'OrderSummary.pdf' . $this->client_code . '.pdf';


        if ($this->tab == 'I') {
            $mpdf->Output($fname, 'I');
// echo $html;
        }
        if ($this->tab == 'D') {
            $mpdf->Output($fname, 'D');
        }
        return $fname;
    }

###################
}

if (isset($_REQUEST['user_id'])) {
    $authobj = new AuthHandler();
// $product_cart_id = $_REQUEST['order_id'];
    $obj = new MailAndMessageHandler($_REQUEST['user_id'], $authobj, $_REQUEST['tab'], $_REQUEST['client_code']);
    $obj->orderPdf();
    $url = $_SERVER['HTTP_REFERER'] . '&msg=1';
    header('location:' . $url);
}
?>

