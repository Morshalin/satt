
			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2017 - <?php echo date('Y'); ?>. &copy; <?php echo FOOTER; ?> <i class="icon-heart5"></i> Developed by <a href="https://sattit.com" target="_blank">Team SATT IT</a>
					</span>
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
	<?php if (isset($data['element']) AND array_key_exists('modal', $data['element'])) {?>
        <!-- Remote source -->
        <div id="modal_remote" class="modal fade border-top-success rounded-top-0" tabindex="-1"  data-backdrop="static">
            <div class="modal-dialog <?php echo isset($data['element']['modal']) ? 'modal-' . $data['element']['modal'] : '' ?>">
                <div class="modal-content">
                    <div class="modal-header bg-light border-grey-300">
                        <h5 class="modal-title"><?php echo isset($data['page_title']) ? $data['page_title'] : 'Dashboard' ?></h5>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="modal-loader" style="display: none; text-align: center;"> <img src="<?php echo BASE_URL; ?>/assets/preloader.gif"> </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <!-- /remote source -->
		<?php }?>

	<!-- Core JS files -->
	<script src="<?php echo BASE_URL; ?>/global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/loaders/pace.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/pickers/moment.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/pickers/daterangepicker.js"></script>
	<script src="<?php echo BASE_URL; ?>/global_assets/js/plugins/notifications/noty.min.js"></script>

	<script src="<?php echo BASE_URL; ?>/assets/js/parsley.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo BASE_URL; ?>/assets/js/app.js"></script>
	<script src="<?php echo CUSTOMER_URL; ?>/jquery-ui/jquery-ui.min.js"></script>






	
<script>
	$(document).ready(function(){
		var customer_id = $('#customer_id').val();
		// console.log(customer_id);

		setInterval(function(){
            $.ajax({
                url: CUSTOMER_URL+'/message_notification/count_new_message.php', 
                data: {customer_id:customer_id },
                type:"POST",
    			dataType:'json',
                success:function(data){
                    // $('#chat_message_'+to_user_id).val('');
                    $('#message').html(data);
                    console.log(data);
                },
                error: function(data) {
		            	console.log(data);
		            }
            })

    	},500);

	});



</script>












	<script type="text/javascript">
	swal.setDefaults({
				buttonsStyling: false,
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-light'
		});
		paceOptions = {
			 ajax: true, // disabled
		 };
		 Pace.start();
	</script>

	<?php
if (isset($data['page_js'])) {
	foreach ($data['page_js'] as $value) {
		?>
	<script src="<?php echo BASE_URL; ?>/<?php echo $value; ?>.js"></script>
				<?php
}
}
?>
	<script src="<?php echo BASE_URL; ?>/assets/js/main.js"></script>
	<?php if (Session::get('login_message')) {
	?>
		<script type="text/javascript">
		$(document).ready(function(){
			new PNotify({
					title: 'Success',
					text: '<?php echo Session::get('login_message'); ?>',
					type: 'success',
					addclass: 'alert alert-styled-left',
			});
		});
		</script>
		<?php
Session::set('login_message', Null);
}?>

	<?php if (Session::get('login_error')) {
	?>
		<script type="text/javascript">
		$(document).ready(function(){
			new PNotify({
					title: 'Access Denied',
					text: '<?php echo Session::get('login_error'); ?>',
					type: 'error',
					addclass: 'alert alert-styled-left',
			});
		});
		</script>
		<?php
Session::set('login_error', Null);
}?>
  <!-- /theme JS files -->
