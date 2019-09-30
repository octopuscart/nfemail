<?php

function single_row($heading, $row_array, $img_size, $col_size, $caption_line, $image_class, $div_type, $caption_hight, $prefix) {
    $htmls = '<div class="" >';
    $data = json_encode($row_array);
    $prefixr= '';
    if($prefix){
        $prefixr = '"'.$prefix.'"+'; 
    } 


    $htmls .= "<div class='col-sm-$col_size' ng-repeat='element in $data'>";
    $htmls .= "<div class='thumbnail  style_selection ' parent_style='{{" .$prefixr."element.heading }}' child_style='{{element.child_label}}'  ng-click='selectStyle(".$prefixr."element.heading, element.child_label)' ".' ng-class="element.standard==1?\'selected\':\'deselect\'"  >';
    $htmls .= '<img class="pant_controlZoom ' . $image_class . '" src="{{element.set_image}}" alt="" >';
    $htmls .= '<div class="caption ' . $caption_line . '">';
    $htmls .= '<h3 style="height:' . $caption_hight . '"  ng-bind-html="element.title"></h3></div></div></div>';


    $htmls .= '</div>';
    return $htmls;
}

function panel_creator($heading, $innerhtml, $prefix) {
    $pre_html = '<div class="navigate">
    <div class="panel panel-default" navigate_to="'.$prefix . $heading . '"> <div class="panel-heading">
    <h3 class="panel-title"><span class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x"></i>
    <i class="fa fa-flag fa-stack-1x fa-inverse"></i></span>  ' . $heading . ' </h3> </div>
    <div class="panel-body" style="  padding: 15px 15px 0px 15px; ">';
    $pre_html .= $innerhtml;
    $pre_html .='</div></div></div>';
    return $pre_html;
}

function multi_tab_element($dev_title, $title, $prefix) {
    $query = "SELECT * FROM nfw_custom_element where dev_title = '$dev_title'";
    $tab_titles = resultAssociate($query);
    $tab_html = '<ul class="nav nav-tabs innerSelectionTab" role="tablist" style="">';
    $count = 0;
    foreach ($tab_titles as $key => $value) {
        $id = str_replace(" ", "_", $value['title']);
        $tab_html .= '<li role = "presentation" class = "' . ($count == 0 ? 'active' : '') . '" >';
        $tab_html .= '<a href = "#' .trim($prefix).$id . '" aria-controls = "' .trim($prefix).$id . '" role = "tab" data-toggle = "tab" style = "background: #fff;color: #000;">';
        $tab_html .= '<img src = "" class = "iconimg">&nbsp;' . $value['title'] . '</a></li>';
        $count++;
    }
    $tab_html .= '</ul>';
    $tab_html .='<div class="tab-content" style=" border: 1px solid #000; padding: 3px;margin-bottom: 15px;">';
    $count1 = 0;
    foreach ($tab_titles as $key => $value) {
        $id = str_replace(" ", "_", $value['title']);
        $tab_html .= '<div role="tabpanel" class="tab-pane ' . ($count1 == 0 ? 'active' : '') . '" id="'.trim($prefix).$id . '">';
        $tab_html .= '<div class="  " role="alert" style="margin-top: 10px;">';
        $heading = $value['title'];
        $img_size = $value['image_size'];
        $col_size = $value['colomn_size'];
        $caption_line = $value['caption_line'];
        $image_class = $value['image_class'];
        $div_type = $value['div_type'];
        $caption_hight = $value['caption_height'];
        $custom_element_id = $value['id'];
        $row_query = "SELECT * FROM `nfw_custom_element_field` where nfw_custom_element_id = $custom_element_id";
        $row_data = resultAssociate($row_query);
        $row_array = array();
        foreach ($row_data as $key1 => $value1) {
            if ($title == $div_title) {
                $value1['heading'] = $dev_title;
            } else {
                $value1['heading'] = $title;
            }
            array_push($row_array, $value1);
        }

        if ($title == $div_title) {
            $tab_html .= single_row($dev_title, $row_array, $img_size, $col_size, $caption_line, $image_class, $div_type, $caption_hight, $prefix);
        } else {
            $tab_html .= single_row($title, $row_array, $img_size, $col_size, $caption_line, $image_class, $div_type, $caption_hight, $prefix);
        }
        $tab_html .= '<div style="clear: both"></div></div></div>';
        $count1++;
    }
    $tab_html .= "</div>"; //tab containt div closed
    return $tab_html;
}

function get_custom_data($elementid, $prefix) {
  
    $query = "SELECT * FROM nfw_custom_element where id = '$elementid'";
    $result_data = resultAssociate($query);
    $result_data = $result_data[0];
    $heading = $result_data['title'];
    $img_size = $result_data['image_size'];
    $col_size = $result_data['colomn_size'];
    $caption_line = $result_data['caption_line'];
    $image_class = $result_data['image_class'];
    $div_type = $result_data['div_type'];
    $caption_hight = $result_data['caption_height'];
    $custom_element_id = $result_data['id'];
    $row_query = "SELECT * FROM `nfw_custom_element_field` where nfw_custom_element_id = $custom_element_id";
    $row_data = resultAssociate($row_query);
    $row_array = array();
    foreach ($row_data as $key => $value) {
        $value['heading'] = $heading;
        array_push($row_array, $value);
    }
    return panel_creator($heading, single_row($heading, $row_array, $img_size, $col_size, $caption_line, $image_class, $div_type, $caption_hight, $prefix), $prefix);
}

?>