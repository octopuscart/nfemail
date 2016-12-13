<?php include 'header.php'; ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker(
            { dateFormat:'yy-mm-dd'
    }).val();
  });
  </script>
<!--header image-->
<section class="image_bg_8 darkness type_4 relative"  >
    <!--url(http://192.168.3.45/nf3/frontend/assets/images/slide_06.jpg);-->
    <!--style="background: url('../images/home_img_19.jpg') no-repeat;"--> 
    <div class="container" onload="new_captcha();"> 
        <div >
            <div class="col-lg-6 col-md-6 col-sm-6 f_none d_table_cell v_align_m d_xs_block t_align_c" style="float:right">
                <div class="create_account_form_wrap r_corners d_inline_b w_xs_full">
                    <h4 class="fw_light color_dark m_bottom_23">Sign Up </h4>
                    <form class="create_account_form" method="post" action="#">
                        <ul>
                            
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="first_name" placeholder="First Name" class="r_corners bg_light w_full border_none" required>
                            </li>
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="middle_name" placeholder="Middle Name" class="r_corners bg_light w_full border_none" >
                            </li>
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="last_name" placeholder="Last Name /Surname" class="r_corners bg_light w_full border_none" required>
                            </li>
                            
                            <li class="m_bottom_20 m_xs_bottom_15 relative" style="text-align: left;color:#fff">
                                                                        <input type="radio" checked id="radio_1" name="gender" class="d_none" value="male">
									<label for="radio_1" class="d_inline_m m_right_15 m_bottom_3 fw_light" style="font-size: 22px;font-weight: 600;">Male</label>
                                                                        <span style="margin: 3%">&nbsp;</span>
                                                                        <input type="radio" id="radio_2" name="gender" class="d_none" value="female">
									<label for="radio_2" class="d_inline_m m_right_15 m_bottom_3 fw_light" style="font-size: 22px;font-weight: 600;">Female</label>
				 </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative">
                                <label for="birth" style="width:25%;float:left;font-size:15px;color:#fff;font-weight:600;">Birth Date</label>
                                <br>
                                <select name="birth_year" class="r_corners bg_light w_full border_none" style="width: 36%;height:30px" required >
                                    <option value="" >-YYYY-</option>
                                    <?php $year=date('Y'); foreach (range(1920,$year) as $number) {  ?>
                                       <option value="<?php echo $number; ?>" ><?php echo $number; ?></option>
                                    <?php  } ?>
                                </select>
				
                                <select name="birth_month" class="r_corners bg_light w_full border_none" style="width: 30%;height:30px" required >
                                    <option value="" >-MM-</option>
                                    <?php foreach (range(1,12) as $number) {  ?>
                                       <option value="<?php echo $number; ?>" ><?php echo $number; ?></option>
                                    <?php  } ?>
                                </select> 
                                <select name="birth_date" class="r_corners bg_light w_full border_none" style="width: 30%;height:30px" required >
                                    <option value="" >-DD-</option>
                                    <?php foreach (range(1,31) as $number) {  ?>
                                       <option value="<?php echo $number; ?>" ><?php echo $number; ?></option>
                                    <?php  } ?>
                                </select>
                                
                                        
                            </li>
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-mail-alt login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="email" name="email" placeholder="Email as Username" class="r_corners bg_light w_full border_none" required>
                            </li>
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="password" name="pass"  placeholder="Password" class="r_corners bg_light w_full border_none pass" required>
                            </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative">
                                <!--<i class="icon-lock login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="password" name="con_pass" placeholder="Confirm Password" class="con_pass r_corners bg_light w_full border_none" required>
                            </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative">
                                <img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' style="width: 34%" /> 
                                <input name="captcha" id="captcha" type="text" placeholder="Type the text" class="con_pass r_corners bg_light border_none" style="width: 65%" required>
                                <small class='details'>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
                                
                            </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative" id="captcha_hide" style="display: none;color: red">
                                Captcha Not Match 
                            </li>
                             
                            <li class="t_align_c">
                                <button name="registration" type="submit" class="registration button_type_3 d_inline_b color_purple r_corners tr_all fw_light">Create An Account</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<script>
    $(function(){
        //console.log('<?php echo  $_SESSION['6_letters_code']; ?>');
        $(document).on("click",".registration", function(){
        
        var pass=$('.pass').val();
        var re_pass=$('.con_pass').val();
        var captcha=$('#captcha').val();
        var Check_captcha='<?php echo  $_SESSION['6_letters_code']; ?>';
        if(pass===re_pass){
          
            return true;
  
        }
        else{
            $('.pass , .con_pass').css('background','#D87E7E');
            return false;
        }
        
        });
        
    });
</script>
<?php
include 'footer.php'; ?>