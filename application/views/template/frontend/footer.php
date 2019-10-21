<?php
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
if($segment2 == 'exam' || $segment2 == 'profile' || $segment2 == 'flagged-questions' || ($segment2 == 'quiz' && $segment3 == '') || $segment2 == 'saved-questions' || $segment2 == 'course-details') {
	?>
	<div class="marked-page-copyright copyright-section text-center">  © All Copyright Reserved by <?= SITE_NAME." ".date('Y'); ?>
	    <div class="devlope-by">
	        <span>&nbsp;Design &amp; Developed by 
	            <a href="https://www.chapter247.com" target="_blank">
	                <img src="<?php echo FRONTEND_THEME_URL;?>img/chapter-logo-1.png" class="gray-logo">
	                <img src="<?php echo FRONTEND_THEME_URL;?>img/chapter-logo-2.png" class="color-logo">
	            </a>
	        </span>
	    </div>
	</div>
	<?php
}
?>
		<footer>
			<script src="<?= base_url("assets/frontend/js/popper.min.js"); ?>"></script>
			<script src="<?= base_url('assets/frontend/js/bootstrap.min.js'); ?>"></script>
			<script src="<?= base_url('assets/frontend/js/parsley.js'); ?>"></script>
			<script type="text/javascript">
				$(document).ready(function(){
				  	$('[data-toggle="tooltip"]').tooltip();   
				});
				$(function () {
				  	$('[data-toggle="popover"]').popover();
				});
			    $( ".header-btn-wrap .dropdown" )
			    .mouseout(function() {
			        $(this).removeClass('show');
			        $(this).find('.dropdown-menu').removeClass('show');
			    })
			    .mouseover(function() {
			        $(this).addClass('show');
			        $(this).find('.dropdown-menu').addClass('show');
			    });
			    $("body").on('click', '.confirm-box', function (e) {
	                e.preventDefault();
	                var link = $(this).attr('href');
	                var msg = $(this).data('msg');

	                swal({
	                    title: "Are you sure?",
	                    text: msg,
	                    icon: "warning",
	                    // buttons: true,
	                    buttons: ['Cancel', 'Yes'],
	                    dangerMode: true,
	                })
	                .then((willDelete) => {
	                    if (willDelete) {
	                        window.location.href = link;
	                    }
	                });
	            });
			</script>
		</footer>
		<div class="main-loader dn" >
		    <div class="loader">
		        <svg class="circular-loader" viewBox="25 25 50 50">
		            <circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke="#016ccb" strokeWidth="2.5"></circle>
		        </svg>
		    </div>
		</div>
	</body>
</html>