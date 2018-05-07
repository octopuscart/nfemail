<?php

include '../dbhandler/dbhandler.php';
$tagsproduct = ['WF154',
    'WF155', 'WF156', 'WF157', 'WF158', 'WF159', 'WF160', 'WF161', 'WF162', 'WF163', 'WF164', 'WF165', 'WF166', 'WF167', 'WF168', 'WF169', 'WF170',
    'WF171', 'WF172', 'WF173', 'WF174', 'WF175', 'WF176', 'WF177', 'WF178', 'WF179', 'WF180', 'WF181', 'WF182', 'WF183', 'WF184', 'WF185', 'WF186',
    'WF187', 'WF188', 'WF189', 'WF190', 'WF191', 'WF192', 'WF193', 'WF194', 'WF195', 'WF196', 'WF197', 'WF198', 'WF199',];
foreach ($tagsproduct as $key => $value) {
    $sqlquery = "select id from nfw_product where title  = '$value'";
    $sqldata = resultAssociate($sqlquery);
    foreach ($sqldata as $key1 => $value1) {
        $product_id = $value1['id'];
        $title = $value;
        $searchtag = "INSERT INTO `nfw_product_search_tag` (`tag_title`) VALUES('$value');<br/>";
    }
}
$nfw_product_search_tag = array(
    array('tag_id' => '3129', 'product_id' => '3173'),
    array('tag_id' => '3130', 'product_id' => '3174'),
    array('tag_id' => '3131', 'product_id' => '3175'),
    array('tag_id' => '3132', 'product_id' => '3176'),
    array('tag_id' => '3133', 'product_id' => '3177'),
    array('tag_id' => '3134', 'product_id' => '3178'),
    array('tag_id' => '3135', 'product_id' => '3179'),
    array('tag_id' => '3136', 'product_id' => '3180'),
    array('tag_id' => '3137', 'product_id' => '3181'),
    array('tag_id' => '3138', 'product_id' => '3182'),
    array('tag_id' => '3139', 'product_id' => '3183'),
    array('tag_id' => '3127', 'product_id' => '3184'),
    array('tag_id' => '3140', 'product_id' => '3184'),
    array('tag_id' => '3128', 'product_id' => '3185'),
    array('tag_id' => '3141', 'product_id' => '3185'),
    array('tag_id' => '3142', 'product_id' => '3186'),
    array('tag_id' => '3143', 'product_id' => '3187'),
    array('tag_id' => '3144', 'product_id' => '3188'),
    array('tag_id' => '3145', 'product_id' => '3189'),
    array('tag_id' => '3146', 'product_id' => '3190'),
    array('tag_id' => '3147', 'product_id' => '3191'),
    array('tag_id' => '3148', 'product_id' => '3192'),
    array('tag_id' => '3149', 'product_id' => '3193'),
    array('tag_id' => '3150', 'product_id' => '3194'),
    array('tag_id' => '3151', 'product_id' => '3195'),
    array('tag_id' => '3152', 'product_id' => '3196'),
    array('tag_id' => '3153', 'product_id' => '3197'),
    array('tag_id' => '3154', 'product_id' => '3198'),
    array('tag_id' => '3155', 'product_id' => '3199'),
    array('tag_id' => '3156', 'product_id' => '3200'),
    array('tag_id' => '3157', 'product_id' => '3201'),
    array('tag_id' => '3158', 'product_id' => '3202'),
    array('tag_id' => '3159', 'product_id' => '3203'),
    array('tag_id' => '3160', 'product_id' => '3204'),
    array('tag_id' => '3161', 'product_id' => '3205'),
    array('tag_id' => '3162', 'product_id' => '3206'),
    array('tag_id' => '3163', 'product_id' => '3207'),
    array('tag_id' => '3164', 'product_id' => '3208'),
    array('tag_id' => '3165', 'product_id' => '3209'),
    array('tag_id' => '3166', 'product_id' => '3210'),
    array('tag_id' => '3167', 'product_id' => '3211'),
    array('tag_id' => '3168', 'product_id' => '3212'),
    array('tag_id' => '3169', 'product_id' => '3213'),
    array('tag_id' => '3170', 'product_id' => '3214'),
    array('tag_id' => '3171', 'product_id' => '3215'),
    array('tag_id' => '3172', 'product_id' => '3216'),
    array('tag_id' => '3173', 'product_id' => '3217'),
    array('tag_id' => '3174', 'product_id' => '3218')
);

foreach ($nfw_product_search_tag as $key => $value) {
    $tag_id = $value['tag_id'];
    $product_id = $value['product_id'];
    echo $searchtag = "INSERT INTO nfw_product_search_tag_connection(product_id, tag_id) VALUES($product_id, $tag_id);<br/>";
}
?>