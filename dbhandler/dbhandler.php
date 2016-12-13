<?php 
date_default_timezone_set('Asia/Hong_Kong');
error_reporting(0);
$connect = mysql_connect("localhost", "n1c7v2s5_nf", "costcoin_nf");
mysql_select_db("n1c7v2s5_nf", $connect);


$conf = resultAssociate("select * from server_conf");
$conf = end($conf);
$imageserver = $conf['image_server'];
$baselinkserver = $conf['base_link']; 

$templateq = resultAssociate("select * from nfw_mail_template_setting");
$templateqr = end($templateq);
$template_header = $templateqr['header'];
$template_footer = $templateqr['footer'];


$pdf_template = resultAssociate("select * from nfw_pdf_template");
$pdf_templater = end($pdf_template);
$pdf_template_header = $pdf_templater['header'];

function mail_template($mailtype, $element) {
    $data = resultAssociate("select * from nfw_mail_template where mail_type = '$mailtype'");
    if ($data) {
        return end($data)[$element]; //format the array into json data
    }
}

function resultAssociate($query) {
    $resultSet = array();
    $result = mysql_query($query);
    if ($result === FALSE) {
        die(mysql_error()); // TODO: better error handling
    }
    while ($row = mysql_fetch_assoc($result)) {
        array_push($resultSet, $row);
    }
    return $resultSet;
}

$arrayChild = [];

function parents($parentId) {
    $query = "select id from nfw_category where parent = $parentId";
    $res = resultAssociate($query);
    for ($i = 0; $i < count($res); $i++) {
        $id = $res[$i]['id'];
        global $arrayChild;
        array_push($arrayChild, $id);
        parents($res[$i]['id']);
    }
    return $arrayChild;
}

$arrayParent = []; 

function parentsChild($childid) {
    $query = "select parent from nfw_category where id = $childid";
    $res = resultAssociate($query);
    if ($res) {
        $lastid = end($res);
        $id = $lastid['parent'];
        global $arrayParent;
        array_push($arrayParent, $id);
        parentsChild($id);
    }
    return $arrayParent;
}

?>