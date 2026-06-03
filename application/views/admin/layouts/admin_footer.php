<div class="modal" id="calendarModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" style="overflow-y: scroll;">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row w-100">
    <div class="col-md-6">
        <h5 class="modal-title">Availability Calendar</h5>
    </div>
    <div class="col-md-5">
        <input id="search-pooja" type="text" class="sq_form" placeholder="Search..">
        <div id="search-indicator-pooja"></div>
    </div>
    <div class="col-md-1">
        <button type="button" class="btn btn-light close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
      </div>
      <div class="modal-body h-100">
      	<div id="poojaCalendar"></div>
      </div>
    </div>
  </div>
</div>

    

	<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <!-- Initialize [ SAMPLE ] -->
    
<script>
// $('.close-btn').on('click', () => {
// 	$('#calendarModal').hide()
// });

// document.addEventListener( "DOMContentLoaded", () => {

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

// 	var events = [];
// 	var calendar = ''
//     // Demo purpose - Set the event based on the current year and month.
//     // ----------------------------------------------
//     loadCalendar(events)

// });

// $("#search-pooja").autocomplete({
//         source: function( request, response ) {
//             $.ajax({
//                 url:'<?php echo base_url();?>index.php/admin/admin/fetch_pooja',
//                 type: 'post',
//                 dataType: "json",
//                 data:{
//                     search:request.term
//                 },
//                 beforeSend: function() {
//                     $('#search-indicator-pooja').html('<small class="text-primary">Loading...Please Wait!</small><div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" aria-hidden="true"></div>');
//                 },
//                 success: function( data ) {
//                     if(data.length > 0){
//                         response( data );
                    	
//                     }
//                     else{
//                         $('#search-pooja').val('');
//                         $('#search-indicator-pooja').html('<small class="text-danger">No Data Found!</small>');
//                         return false;
//                     }
//                 }
//             });
//         },

//         select: function (event, ui) {
//         	 var eventSources = calendar.getEventSources(); 
// 			 var len = eventSources.length;
// 			 for (var i = 0; i < len; i++) { 
//     			eventSources[i].remove(); 
// 			 } 
        	
//              $.ajax({
//             	type: "POST",
//             	url: "<?php echo base_url();?>index.php/admin/admin/pooja_availability",
//            		data: {
//             		'pooja_id': ui.item.id
//             	},
//             	dataType: "json",
//             	success: function (events) {
//                 	loadCalendar(events)
//                 	$('#search-pooja').val(ui.item.value)
//            		}
//         	});
//             $('#search-indicator-pooja').html('');
//             return false;
//         }
// });

</script>
<!-- Right-sidebar-->
</div></div>
			<div class="sidebar sidebar-right sidebar-animate">
				<div class="p-2 pr-3 mb-2 sidebar-icon">
					<a href="#" class="text-right float-right" data-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x"></i></a>
				</div>
				<!--<div class="tab-menu-heading siderbar-tabs border-0">-->
				<!--	<div class="tabs-menu ">-->
						<!-- Tabs -->
				<!--		<ul class="nav panel-tabs">-->
				<!--			<li class=""><a href="#tab1"  class="active" data-toggle="tab">Settings</a></li>-->
				<!--			<li><a href="#tab2" data-toggle="tab">Followers</a></li>-->
				<!--			<li><a href="#tab3" data-toggle="tab">Todo</a></li>-->
				<!--		</ul>-->
				<!--	</div>-->
				<!--</div>-->
				<!--<div class="panel-body tabs-menu-body side-tab-body p-0 border-0 ">-->
				<!--	<div class="tab-content border-top">-->
				<!--		<div class="tab-pane active " id="tab1">-->
				<!--			<div class="p-3 border-bottom">-->
				<!--				<h5 class="border-bottom-0 mb-0">General Settings</h5>-->
				<!--			</div>-->
				<!--			<div class="p-4">-->
				<!--				<div class="switch-settings">-->
				<!--					<div class="d-flex mb-2">-->
				<!--						<span class="mr-auto fs-15">Notifications</span>-->
				<!--						<div class="onoffswitch2">-->
				<!--							<input type="checkbox" name="onoffswitch2" id="onoffswitch" class="onoffswitch2-checkbox" checked>-->
				<!--							<label for="onoffswitch" class="onoffswitch2-label"></label>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="d-flex mb-2">-->
				<!--						<span class="mr-auto fs-15">Show your emails</span>-->
				<!--						<div class="onoffswitch2">-->
				<!--							<input type="checkbox" name="onoffswitch2" id="onoffswitch1" class="onoffswitch2-checkbox">-->
				<!--							<label for="onoffswitch1" class="onoffswitch2-label"></label>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="d-flex mb-2">-->
				<!--						<span class="mr-auto fs-15">Show Task statistics</span>-->
				<!--						<div class="onoffswitch2">-->
				<!--							<input type="checkbox" name="onoffswitch2" id="onoffswitch2" class="onoffswitch2-checkbox">-->
				<!--							<label for="onoffswitch2" class="onoffswitch2-label"></label>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="d-flex mb-2">-->
				<!--						<span class="mr-auto fs-15">Show recent activity</span>-->
				<!--						<div class="onoffswitch2">-->
				<!--							<input type="checkbox" name="onoffswitch2" id="onoffswitch3" class="onoffswitch2-checkbox" checked>-->
				<!--							<label for="onoffswitch3" class="onoffswitch2-label"></label>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="d-flex mb-2">-->
				<!--						<span class="mr-auto fs-15">System Logs</span>-->
				<!--						<div class="onoffswitch2">-->
				<!--							<input type="checkbox" name="onoffswitch2" id="onoffswitch4" class="onoffswitch2-checkbox" >-->
				<!--							<label for="onoffswitch4" class="onoffswitch2-label"></label>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="d-flex mb-2">-->
				<!--						<span class="mr-auto fs-15">Error Reporting</span>-->
				<!--						<div class="onoffswitch2">-->
				<!--							<input type="checkbox" name="onoffswitch2" id="onoffswitch5" class="onoffswitch2-checkbox" >-->
				<!--							<label for="onoffswitch5" class="onoffswitch2-label"></label>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="d-flex mb-2">-->
				<!--						<span class="mr-auto fs-15">Show your status to all</span>-->
				<!--						<div class="onoffswitch2">-->
				<!--							<input type="checkbox" name="onoffswitch2" id="onoffswitch6" class="onoffswitch2-checkbox" checked>-->
				<!--							<label for="onoffswitch6" class="onoffswitch2-label"></label>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="d-flex mb-2">-->
				<!--						<span class="mr-auto fs-15">Keep up to date</span>-->
				<!--						<div class="onoffswitch2">-->
				<!--							<input type="checkbox" name="onoffswitch2" id="onoffswitch7" class="onoffswitch2-checkbox">-->
				<!--							<label for="onoffswitch7" class="onoffswitch2-label"></label>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="p-3 border-bottom">-->
				<!--				<h5 class="border-bottom-0 mb-0">Overview</h5>-->
				<!--			</div>-->
				<!--			<div class="p-4">-->
				<!--				<div class="progress-wrapper">-->
				<!--					<div class="mb-3">-->
				<!--						<p class="mb-2">Achieves<span class="float-right text-muted font-weight-normal">80%</span></p>-->
				<!--						<div class="progress h-1">-->
				<!--							<div class="progress-bar bg-primary w-80 " role="progressbar"></div>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				<div class="progress-wrapper pt-2">-->
				<!--					<div class="mb-3">-->
				<!--						<p class="mb-2">Projects<span class="float-right text-muted font-weight-normal">60%</span></p>-->
				<!--						<div class="progress h-1">-->
				<!--							<div class="progress-bar bg-secondary w-60 " role="progressbar"></div>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				<div class="progress-wrapper pt-2">-->
				<!--					<div class="mb-3">-->
				<!--						<p class="mb-2">Earnings<span class="float-right text-muted font-weight-normal">50%</span></p>-->
				<!--						<div class="progress h-1">-->
				<!--							<div class="progress-bar bg-success w-50" role="progressbar"></div>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				<div class="progress-wrapper pt-2">-->
				<!--					<div class="mb-3">-->
				<!--						<p class="mb-2">Balance<span class="float-right text-muted font-weight-normal">45%</span></p>-->
				<!--						<div class="progress h-1">-->
				<!--							<div class="progress-bar bg-warning w-45 " role="progressbar"></div>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				<div class="progress-wrapper pt-2">-->
				<!--					<div class="mb-3">-->
				<!--						<p class="mb-2">Toatal Profits<span class="float-right text-muted font-weight-normal">75%</span></p>-->
				<!--						<div class="progress h-1">-->
				<!--							<div class="progress-bar bg-danger w-75" role="progressbar"></div>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--				<div class="progress-wrapper pt-2">-->
				<!--					<div class="mb-3">-->
				<!--						<p class="mb-2">Total Likes<span class="float-right text-muted font-weight-normal">70%</span></p>-->
				<!--						<div class="progress h-1">-->
				<!--							<div class="progress-bar bg-teal w-70" role="progressbar"></div>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--		<div class="tab-pane" id="tab2">-->
				<!--			<div class="list-group-item d-flex  align-items-center border-top-0">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/female/2.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/female/2.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Mozelle Belt</div>-->
				<!--					<small class="text-muted">Web Designer-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="list-group-item d-flex  align-items-center">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/female/6.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/female/6.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Alina Bernier</div>-->
				<!--					<small class="text-muted">Administrator-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="list-group-item d-flex  align-items-center">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/male/5.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/male/5.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Isidro Heide</div>-->
				<!--					<small class="text-muted">Web Designer-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="list-group-item d-flex  align-items-center">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/male/6.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/male/6.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Isidro Heide</div>-->
				<!--					<small class="text-muted">Web Designer-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="list-group-item d-flex  align-items-center">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/male/2.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/male/2.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Isidro Heide</div>-->
				<!--					<small class="text-muted">Web Designer-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="list-group-item d-flex  align-items-center">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/male/4.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/male/2.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Isidro Heide</div>-->
				<!--					<small class="text-muted">Web Designer-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="list-group-item d-flex  align-items-center">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/male/5.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/male/2.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Isidro Heide</div>-->
				<!--					<small class="text-muted">Web Designer-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="list-group-item d-flex  align-items-center">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/male/2.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/male/2.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Isidro Heide</div>-->
				<!--					<small class="text-muted">Web Designer-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--			<div class="list-group-item d-flex  align-items-center border-bottom-0">-->
				<!--				<div class="mr-2">-->
				<!--					<span class="avatar avatar-md brround cover-image" data-image-src="<?php echo base_url(); ?>/assets/new_style/images/users/female/3.jpg" style="background: url(&quot;<?php echo base_url(); ?>/assets/new_style/images/users/female/3.jpg&quot;) center center;"></span>-->
				<!--				</div>-->
				<!--				<div class="">-->
				<!--					<div class="font-weight-500">Florinda Carasco</div>-->
				<!--					<small class="text-muted">Project Manager-->
				<!--					</small>-->
				<!--				</div>-->
				<!--				<div class="ml-auto">-->
				<!--					<a href="#" class="btn btn-sm  btn-light">Follow</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--		<div class="tab-pane" id="tab3">-->
				<!--			<div class="">-->
				<!--				<div class="d-flex p-3">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">-->
				<!--						<span class="custom-control-label">Do Even More..</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2" checked="">-->
				<!--						<span class="custom-control-label">Find an idea.</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox3" value="option3" checked="">-->
				<!--						<span class="custom-control-label">Hangout with friends</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox4" value="option4" >-->
				<!--						<span class="custom-control-label">Do Something else</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox5" value="option5" >-->
				<!--						<span class="custom-control-label">Eat healthy, Eat Fresh..</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox6" value="option6" checked="">-->
				<!--						<span class="custom-control-label">Finsh something more..</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox7" value="option7" checked="">-->
				<!--						<span class="custom-control-label">Do something more</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox8" value="option8" >-->
				<!--						<span class="custom-control-label">Updated more files</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox9" value="option9" >-->
				<!--						<span class="custom-control-label">System updated</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox10" value="option10" >-->
				<!--						<span class="custom-control-label">Settings Changings...</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div><div class="d-flex p-3 border-top">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox9" value="option9" >-->
				<!--						<span class="custom-control-label">System updated</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--				<div class="d-flex p-3 border-top border-bottom">-->
				<!--					<label class="custom-control custom-checkbox mb-0">-->
				<!--						<input type="checkbox" class="custom-control-input" name="example-checkbox10" value="option10" >-->
				<!--						<span class="custom-control-label">Settings Changings...</span>-->
				<!--					</label>-->
				<!--					<span class="ml-auto">-->
				<!--						<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title=""  data-placement="top" data-original-title="Edit"></i>-->
				<!--						<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>-->
				<!--					</span>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
			</div><!-- End Rightsidebar-->

			<!-- FOOTER -->
			<footer class="footer left-footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 text-center">
							 &copy; 2020  
						</div>
					</div>
				</div>
			</footer>
			<!-- FOOTER END -->
		</div>
		<a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
		<script src="<?php echo base_url(); ?>/assets/new_style/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/js/vendors/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/js/vendors/jquery.sparkline.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/js/vendors/circle-progress.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/rating/rating-stars.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/chart/chart.bundle.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/chart/utils.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/peitychart/jquery.peity.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/peitychart/peitychart.init.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/horizontal-menu/horizontal-menu.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/p-scroll/p-scroll.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/p-scroll/p-scroll-1.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/right-sidebar/right-sidebar.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/counters/counterup.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/counters/waypoints.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/plugins/counters/counters-1.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/js/index.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/js/stiky.js"></script>
		<script src="<?php echo base_url(); ?>/assets/new_style/js/custom.js"></script>
        <!-- Multi Select -->
        <script src="<?php echo base_url(); ?>/assets/plugins/select2/select2.full.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/js/select2.js"></script>
		<script src="<?php echo base_url(); ?>/assets/plugins/multipleselect/multiple-select.js"></script>
		<script src="<?php echo base_url(); ?>/assets/plugins/multipleselect/multi-select.js"></script>
		<script src="<?php echo base_url(); ?>/assets/plugins/select2/select2.full.min.js"></script>
        <script src="https://www.openjs.com/scripts/events/keyboard_shortcuts/shortcut.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
        
         shortcut.add("F1", function() {
            window.location.replace("billing");
         });
         shortcut.add("F2", function() {
         	<?php $code_settings = $this->db->select('*')->from('site_settings')->get()->row()->code_settings; if($code_settings == 5 || $code_settings == 7): ?>
                  window.location.replace("<?php echo base_url();?>index.php/admin/schedulebilling/multy_schedule_hierarchical_pooja")
            <?php else: ?>
            window.location.replace("schedule");
         	<?php endif; ?>
         });
         shortcut.add("F3", function() {
            window.location.replace("billing_view");
         });
         shortcut.add("F4", function() {
            window.location.replace("counter_wise");
         });
         shortcut.add("F5", function() {
            window.location.replace("detail_view");
         });
         shortcut.add("F6", function() {
            window.location.replace("detail_view");
         });
         shortcut.add("F7", function() {
            window.location.replace("bill_report");
         });

        
            $(document).ready(function() {
                $("#checkAll").change(function() {
                    if (this.checked) {
                        $(".week").each(function() {
                            this.checked=true;
                        });
                    } else {
                        $(".week").each(function() {
                            this.checked=false;
                        });
                    }
                });
            
                $(".week").click(function () {
                    if ($(this).is(":checked")) {
                        var isAllChecked = 0;
            
                        $(".week").each(function() {
                            if (!this.checked)
                                isAllChecked = 1;
                        });
            
                        if (isAllChecked == 0) {
                            $("#checkAll").prop("checked", true);
                        }     
                    }
                    else {
                        $("#checkAll").prop("checked", false);
                    }
                });
            });
            $(document).ready(function() {
                $("#checkmonth").change(function() {
                    if (this.checked) {
                        $(".month").each(function() {
                            this.checked=true;
                        });
                    } else {
                        $(".month").each(function() {
                            this.checked=false;
                        });
                    }
                });
            
                $(".month").click(function () {
                    if ($(this).is(":checked")) {
                        var isAllChecked = 0;
            
                        $(".month").each(function() {
                            if (!this.checked)
                                isAllChecked = 1;
                        });
            
                        if (isAllChecked == 0) {
                            $("#checkmonth").prop("checked", true);
                        }     
                    }
                    else {
                        $("#checkmonth").prop("checked", false);
                    }
                });
            });
                         $(document).ready(function() {
                            $('.js-example-basic-single').select2();
            				jQuery("#acdnmenu").accordionMenu();
            				jQuery("#acdnmenub").accordionMenu();
            				
            				
            				$( ".oid" ).ready(function() {
                    	      var id = $('.oid').text();
                             $.ajax({
                                  url: "<?php echo base_url();?>admin/markAsRead/"+id,
                                  success: function(result){
                                     if (location.href.indexOf('reload')==-1) {
                                         location.replace(location.href+'?reload');
                                     }
                                  }});  
                            });
                            
                          
                        });
                            
					$('#logout-btn').on('click', () => {
                    	Swal.fire({
  title: 'Do you want to take a database backup?',
  text: "Please ignore it if you have already downloaded it!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Backup!'
}).then((result) => {
  if (result.isConfirmed) {
//        $.ajax({
//               url:'<?php echo base_url();?>index.php/cms/database_backup_ajax',
//               type: 'get',
//               dataType: "json",
//               success: function( data ) {
//               	   var downloadLink = document.createElement('a');
//             	   downloadLink.href = response.backup_path;
//             	   downloadLink.download = response.backup_name; // Set the desired filename
//             	   downloadLink.click();
                  
//               }                   
//          });
		window.location.href = '<?php echo base_url();?>index.php/cms/database_backup_ajax'; 
  } else {
  	window.location.href = '<?php echo base_url();?>index.php/admin/admin/logout';
  }
})
                    })
   
                       
            
            </script>
	</body>
</html>