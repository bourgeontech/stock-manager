<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Pooja Calendar</h2>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-8">
              </div>
              
              <div class="col-lg-4 col-md-4 col-sm-4 ">
          		<input id="search-pooja" type="text" class="sq_form" placeholder="Search..">
             	<div id="search-indicator-pooja"></div>
              </div>
            	<div class="col-lg-12 col-md-12 col-sm-12" style="height:10px;"></div>
			 </div>		
          <div class="mt-5">
          	<div id="poojaCalendar"></div>
          </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
	<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <!-- Initialize [ SAMPLE ] -->
    
<script>
// $('.close-btn').on('click', () => {
// 	$('#calendarModal').hide()
// });

const loadCalendar = (events = null) => {
        
        const today         = new Date();
        const currentYear   = today.getFullYear();
        const currentMonth  = (today.getMonth() + 1).toString().padStart(2, "0");

        // Initialize the FullCalendar
        // ----------------------------------------------
        
		calendar = new FullCalendar.Calendar( document.getElementById( "poojaCalendar" ), {
                    timeZone: "UTC",
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar
                    dayMaxEvents: true, // allow "more" link when too many events
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                    },
            		eventBackgroundColor: "red",
                    themeSystem: "bootstrap",
            
                    bootstrapFontAwesome: {
                        close: " fa fa-times",
                        prev: " demo-psi-arrow-left",
                        next: " demo-psi-arrow-right",
                        prevYear: " demo-psi-arrow-left-2",
                        nextYear: " demo-psi-arrow-right-2"
                    },
                    events: events,
                    dayRender: function (date, cell) {
cell.css("background-color", "yellow");

} 
                });

		calendar.render();
    }


document.addEventListener( "DOMContentLoaded", () => {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	var events = [];
	var calendar = ''
    // Demo purpose - Set the event based on the current year and month.
    // ----------------------------------------------
    loadCalendar(events)

});

$("#search-pooja").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url:'<?php echo base_url();?>index.php/admin/admin/fetch_pooja',
                type: 'post',
                dataType: "json",
                data:{
                    search:request.term
                },
                beforeSend: function() {
                    $('#search-indicator-pooja').html('<small class="text-primary">Loading...Please Wait!</small><div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" aria-hidden="true"></div>');
                },
                success: function( data ) {
                    if(data.length > 0){
                    	$('#search-indicator-pooja').html('')
                        response( data );
                    }
                    else{
                        $('#search-pooja').val('');
                        $('#search-indicator-pooja').html('<small class="text-danger">No Data Found!</small>');
                        return false;
                    }
                }
            });
        },

        select: function (event, ui) {
        	 var eventSources = calendar.getEventSources(); 
			 var len = eventSources.length;
			 for (var i = 0; i < len; i++) { 
    			eventSources[i].remove(); 
			 } 
        	
             $.ajax({
            	type: "POST",
            	url: "<?php echo base_url();?>index.php/admin/admin/pooja_availability",
           		data: {
            		'pooja_id': ui.item.id
            	},
            	dataType: "json",
            	success: function (events) {
                	loadCalendar(events)
                	$('#search-pooja').val(ui.item.value)
           		}
        	});
            $('#search-indicator-pooja').html('');
            return false;
        }
});

</script>
