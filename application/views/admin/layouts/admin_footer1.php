  <!--end section-->
    <div class="clearfix"></div>
    <div class="mt-5"></div>
  </div>
</div>
</div>
<div class="shadow-sm p-2 mb-0  copy ">
  <div class="container-fluids text-center"> &copy; 2020  </div>
</div>
<!-- ide bar -->
<?php if(isset($this->loggedIn)){
	$name=$this->loggedIn['name'];
	$email=$this->loggedIn['username'];
	$role=$this->loggedIn['role'];
}

?>
<div class="sidebar" id="sidebar">
  <div class="close"> <a href="#" id="sidebar-close" class="btn-close"> <i class="fa fa-close"></i></a> </div>
  <div class="clearfix"></div>
  <div class="content">
    <div class="dp_body"> <img src="<?php echo base_url(); ?>/assets/admin/img/user_img.png"/>
      <h3 class="name"><?php echo $name; ?></h3>
      <p><?php echo $role ?></p>
    </div>
    <ul class="sidebar-list">
      <?php if($this->loggedIn['role']=="superadmin"){?>
        <li><a href="<?php echo base_url();?>index.php/admin/admin/temple_view" class="current"> <i class="fa fa-gear"></i>&nbsp;&nbsp;&nbsp;Temple Setting</a></li>
        <li><a href="<?php echo base_url();?>index.php/admin/admin/user_view" class="current"> <i class="fa fa-gear"></i>&nbsp;&nbsp;&nbsp;User Setting</a></li>
      <?php }?>
      <li><a href="<?php echo base_url();?>index.php/admin/admin/logout" class="current"> <i class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;Sign Out</a></li>
    </ul>
  </div>
</div>

<!--DOCUMENT MODEL-->

<div class="modal fade" id="pop1" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sq_document"> Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" placeholder="Old Pasword" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" placeholder="New Pasword" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Confirm Password" class="form-control">
        </div>
        <div class="form-group ">
          <button class="btn btn-danger" style="width:100px; float:right" type="button">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/sidebar.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/plugin/select2/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/header/jquery.sticky.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/jquery.accordionMenu.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin/js/custom.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/jscolor.js"></script>

<script>
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
                      url: "<?php echo base_url();?>admin/admin/markAsRead/"+id,
                      success: function(result){
                         if (location.href.indexOf('reload')==-1) {
                             location.replace(location.href+'?reload');
                         }
                      }});  
                });
                
              
            });
                      
              

</script>


</html>