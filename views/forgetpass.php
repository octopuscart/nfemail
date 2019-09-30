<?php include 'header.php';?>
			<!--header image-->
			<section class="image_bg_8 darkness type_4 relative"> 
				<div class="container">
					<div class="">
						<div class="col-lg-6 col-md-6 col-sm-6 f_none d_table_cell v_align_m d_xs_block m_xs_bottom_30 form_description">

						</div>
						<div class="pull-right col-lg-6 col-md-6 col-sm-6 f_none d_table_cell v_align_m d_xs_block t_align_c">
							<div class="create_account_form_wrap r_corners d_inline_b w_xs_full">
								<h4 class="fw_light color_dark m_bottom_23">Change Password</h4>
                                                                <form class="create_account_form" method="post" action="#">
									<ul>
<!--										<li class="m_bottom_20 m_xs_bottom_15 relative">
										<i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
											<input type="password" name="old_password" placeholder="Old Password" class="r_corners bg_light w_full border_none">
										</li>-->
										<li class="m_bottom_20 m_xs_bottom_15 relative">
										<i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
                                                                                <input type="hidden" name="token" value="<?php echo $_REQUEST['admin'];?>">
											<input type="password" name="pass" placeholder="Enter New Password" class="r_corners bg_light w_full border_none">
										</li>
										
                                                                                <li class="t_align_c">
											<button name="change" class="button_type_3 d_inline_b color_purple r_corners tr_all fw_light">Submit</button>
										</li>
									</ul>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
	<?php include 'footer.php' ; ?>