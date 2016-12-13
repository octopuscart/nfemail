<?php
$menuArray = array(
    "Home" => array(
        "About Us" => array(),
        "Schedule" => array(),
        "FAQ's" => array(),
        "Contact Us" => array()
    ),
    "Shop Now" => array(
        "Men's" => array("Shirt", "Tuxedo Shirt", "Suit", "Sports Jacket", "Trouser", "Waisetcoat", "Tuxedo Suit", "Tuxedo Jacket", "Tuxedo Trousers", "Overcoat"),
        "Woman's" => array("Shirt", "Blouse", "Suit", "Jacket"),
    // "Accessories" => array("Tie", "Bow", "Cuffline", "Suspender")
    ),
//    "Men's" => array(
//        "Shirt" => array("Two-Ply Superline", "Wrinkle-Free 100% Cotton", "Executive", "Linen", "Cotton/Poly Blends")
//    ),
//    "Mens Shirt"=>array("Two-Ply Superline","Wrinkle-Free 100% Cotton","Executive","Linen","Cotton/Poly Blends"),
//    "Women's" => array(
//        "Shirt" => array(),
//        "Blouse" => array(),
//        "Suit" => array(),
//        "Jacket" => array()
//    ),
    "Accessories" => array(
        "Tie" => array(),
        "Bow" => array(),
        "Cuffline" => array(),
        "Suspender" => array()
    ),
    "Schedule" => array(
        "Us" => array(),
        "Uk" => array(),
        "Eurpo" => array("France", "Germany", "Spain"),
        "Australia" => array()
    ),
    "FAQ's" => array(),
    "Contact Us" => array()
);

function parent_get($table, $column, $id) {
    ?>
    <ul class="hr_list main_menu type_2 fw_light true">       
        <?php
        $query = mysql_query("select * from $table where $column=$id order by menu_index");
        while ($row = mysql_fetch_array($query)) {
            ?> 
            <li class="container3d relative <?php if ($row['menu_page'] == '') { ?> f_xs_none m_xs_bottom_5 <?php } ?>"  >

                <a href="<?php echo $row['menu_page']; ?> " class="menu-link d_block color_dark relative main-menu-link"> <?php echo $row['name']; ?> </a>

                <?php
                $cat[$row['id']] = child($table, $column, $row['id']);
                ?>
            </li>
            <?php
        }
        ?>
    </ul>           
    <?php
    return $cat;
}

function child($table, $column, $id) {
    // echo "select * from $table where $column=$id order by menu_index";
    ?>

    <?php
    $query = mysql_query("select * from $table where $column=$id order by menu_index");
    $cat = array();
    if (mysql_num_rows($query)) {
        ?>
        <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
            <?php
            while ($row = mysql_fetch_array($query)) {
                ?>
                <li class="container3d relative <?php if ($row['menu_page'] == '') { ?> f_xs_none m_xs_bottom_5 <?php } ?>">
                    <?php
                    ?>
                    <a href="<?php echo $row['menu_page']; ?> " class="menu-link d_block color_dark relative main-menu-link"> <?php echo $row['name']; ?> <?php echo $row['name']=='Tuxedo'?'<i class="icon-angle-right"></i>':'';?></a>
                    <?php
                    $tt = child($table, $column, $row['id']);


                    $cat[$row['id']] = $tt;
                    ?> 
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
    ?>

    <?php
    return $cat;
}
?>
<nav role="navigation" class="d_inline_m d_xs_none m_xs_right_0 m_right_15 m_sm_right_5 t_align_l m_xs_bottom_15">
    <?php $cat = parent_get('nfw_menu', 'parent', '0'); ?>
</nav>
<!--<nav role="navigation" class="d_inline_m d_xs_none m_xs_right_0 m_right_15 m_sm_right_5 t_align_l m_xs_bottom_15">
    <ul class="hr_list main_menu type_2 fw_light true">      
        <li class="container3d relative "  >
            <a href="index.php " class="menu-link d_block color_dark relative main-menu-link"> Home </a>
            <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                <li class="container3d relative ">
                    <a href="pages_about.php " class="menu-link d_block color_dark relative main-menu-link"> About Us </a>   
                </li>
                <li class="container3d relative ">
                    <a href="pages_faq.php " class="menu-link d_block color_dark relative main-menu-link"> FAQ's </a>   
                </li>
                <li class="container3d relative ">
                    <a href="pages_t&c.php " class="menu-link d_block color_dark relative main-menu-link"> Terms of Service </a>   
                </li>
                <li class="container3d relative ">
                    <a href="pages_policy.php " class="menu-link d_block color_dark relative main-menu-link"> Privacy Policy </a>   
                </li>
                <li class="container3d relative ">
                    <a href="scheduler2.php " class="menu-link d_block color_dark relative main-menu-link"> Schedule </a>   
                </li>
                <li class="container3d relative ">
                    <a href="pages_contact.php " class="menu-link d_block color_dark relative main-menu-link"> Contact Us </a>   
                </li>
            </ul>
        </li>

        <li class="container3d relative "  >
            <a href="# " class="menu-link d_block color_dark relative main-menu-link"> Customize Now </a>
            <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                <li class="container3d relative ">
                    <a href="product_list.php?item_type=1 " class="menu-link d_block color_dark relative main-menu-link"> Shirt </a>   
                </li>
                <li class="container3d relative ">
                    <a href="# " class="color_dark fs_large relative r_xs_corners menu-link d_block color_dark relative main-menu-link"> Tuxedo <i class="icon-angle-right"></i></a>
                    <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                        <li class="container3d relative ">
                            <a href="product_list.php?item_type=7 " class="menu-link d_block color_dark relative main-menu-link"> Shirt </a>   
                        </li>
                        <li class="container3d relative ">
                            <a href="product_list.php?item_type=8 " class="menu-link d_block color_dark relative main-menu-link"> Pant </a>   
                        </li>
                        <li class="container3d relative ">
                            <a href="product_list.php?item_type=14 " class="menu-link d_block color_dark relative main-menu-link"> Jacket </a>   
                        </li>
                        <li class="container3d relative ">
                            <a href="product_list.php?item_type=10 " class="menu-link d_block color_dark relative main-menu-link"> Suit </a>   
                        </li>
                    </ul>

                </li>
                <li class="container3d relative ">
                    <a href="product_list.php?item_type=11 " class="menu-link d_block color_dark relative main-menu-link"> Suit </a>   
                </li>
                <li class="container3d relative ">
                    <a href="product_list.php?item_type=13 " class="menu-link d_block color_dark relative main-menu-link"> 3 Piece Suit </a>   
                </li>
                <li class="container3d relative ">
                    <a href="product_list.php?item_type=2 " class="menu-link d_block color_dark relative main-menu-link"> Pant </a>   
                </li>
                <li class="container3d relative ">
                    <a href="product_list.php?item_type=5 " class="menu-link d_block color_dark relative main-menu-link"> Jacket </a>   
                </li>
                <li class="container3d relative ">
                    <a href="product_list.php?item_type=3 " class="menu-link d_block color_dark relative main-menu-link"> Waistcoat </a>  
                </li>
                <li class="container3d relative ">
                    <a href="product_list.php?item_type=12 " class="menu-link d_block color_dark relative main-menu-link"> Sports Jacket </a>   
                </li>
                <li class="container3d relative ">
                    <a href="product_list.php?item_type=15 " class="menu-link d_block color_dark relative main-menu-link"> Overcoat </a>   
                </li>
            </ul>
        </li>

        <li class="container3d relative "  >
            <a href="pages_about.php " class="menu-link d_block color_dark relative main-menu-link"> About Us </a>
        </li>
        <li class="container3d relative "  >
            <a href="pages_faq.php " class="menu-link d_block color_dark relative main-menu-link"> FAQ's </a>
        </li>

        <li class="container3d relative "  >

            <a href="scheduler2.php " class="menu-link d_block color_dark relative main-menu-link"> Schedule </a>
        </li>

        <li class="container3d relative "  >
            <a href="pages_contact.php " class="menu-link d_block color_dark relative main-menu-link"> Contact Us </a>
        </li>
    </ul>           
</nav>   -->