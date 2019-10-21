		</section>
    </div>
</section>
		<script>
		    tinymce.init({ selector: ".tinymce_edittor",
		        relative_urls : false,
		        remove_script_host : false,
		        convert_urls : true,
		        menubar: false,
		        height :300,
		        relative_urls : 1,
				remove_script_host : 1,
		        plugins: [
		            "advlist autolink lists link image charmap print preview anchor media",
		            "searchreplace visualblocks code fullscreen",
		            "insertdatetime table contextmenu paste textcolor directionality",
		        ],
		        resize: false,
		        toolbar: "insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview code ",  
		    });
            
		    $(document).on('focusin', function(e) {
		        if ($(e.target).closest(".mce-window").length) {
		            e.stopImmediatePropagation();
		        }
		    });

            $("body").on('click', '.confirm-box', function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                var msg = $(this).data('msg');

                swal({
                    title: "Are you sure?",
                    text: msg,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    }
                });
            });
            $(document).ready(function() {
            	$('[data-toggle="tooltip"]').tooltip();
            });            
		    $( ".modal" ).on('shown.bs.modal', function(){
		        $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
		        // alert("I want this to appear after the modal has opened!");
		    });
		    /*function open_notifications() {
		    	$.get( SITE_URL+"backend/superadmin/open_notifications", function( data ) {
				  	$(".notification-count b").text(data);
				  	$("#notifCount .sidebar-notification-count b").text(data);
				});
		    }
		    setInterval(function(){ open_notifications(); }, 15000);
		    open_notifications();*/
		</script>
	    <script src="<?php echo BACKEND_THEME_URL;?>vendor/popper/umd/popper.min.js"></script>	 
	    <script src="<?php echo BACKEND_THEME_URL;?>vendor/font-awesome-5/js/all.min.js"></script>	 
	    <script src="<?php echo BACKEND_THEME_URL;?>vendor/font-awesome-5/js/fontawesome.min.js"></script>	 
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="<?php echo BACKEND_THEME_URL;?>vendor/bootstrap/js/bootstrap.js"></script>	
		<script src="<?php echo BACKEND_THEME_URL;?>plugin/select2/select2.js"></script>
		<script src="<?php echo BACKEND_THEME_URL;?>/js/theme.js"></script>
		<script>
		  	$( function() {
		    	$( ".datepicker" ).datepicker({
		    		changeMonth: true,
    				changeYear: true,
    				inline: true,
		    	});
		  	} );
		</script>
		<style type="text/css">
		    .modal-open{
		        padding-right: 0px !important;
		    }
		    .select2-container--bootstrap .select2-selection--single, .select2-container--bootstrap .select2-dropdown{
		    	border-radius: 0 !important;
		    }
		    
		    .actions a.text {
		        font-size: 12px;
		        font-weight: 500;
		        padding: 2px 5px;
		        border-radius: 2px;
		        min-width: 64px;
				text-align: center;
		    }
		    html .bg-tertiary, html .background-color-tertiary {
			    background-color: #2BAAB1 !important;
			}			
			.input-group-append{
				height: 34px;
			}
			.myBtn{
				background: #efefef;
			}
			input[type=file].myBtn{
				padding: 3px 10px;
				text-align: left;
			}
			.form-group textarea{
				height: auto !important;
			}
			.select2{
				width: 100%;
			}
		</style>
		
		<script>
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};
		function scrollFunction() {
		    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
		        document.getElementById("myBtn").style.display = "flex";
		    } else {
		        document.getElementById("myBtn").style.display = "none";
		    }
		}
		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
		    document.body.scrollTop = 0;
		    document.documentElement.scrollTop = 0;
		}
		</script>
		<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
	</body>
</html>