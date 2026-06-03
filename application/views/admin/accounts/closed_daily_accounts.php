<style>
.badge-danger {
  color: #fff;
  background: #e81212 !important;
  border-radius: 1em !important;
  padding: 0.25em 1.5em !important;
  font-weight: bold !important;
}

.badge-success {
  color: #fff;
  background: #06b64b !important;
  border-radius: 1em !important;
  padding: 0.25em 1.5em !important;
  font-weight: bold !important;
}

.btn-new {
	padding: 0.2em 1em !important;
  	border-radius: .2em !important;
}
</style>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
            <h2 class="page_txt"> Accounts Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
            <ul class="btn_ul" style="float:right;">
                <li> <a href="<?php echo base_url();?>index.php/accounts/closedDailyAccounts" class="btn btn-primary">Closed Accounts&nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li> 
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 ">
            <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 ">
                        <h2 class="page_txt"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Closed Account Dates </h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 ">
                        <div class="header">

                        </div>
                    </div>
                </div>	
            
                <br>

                <table class="table border">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($closed_accounts as $key => $account): ?>
                        <tr>
                            <td> <?php echo $key + 1; ?> </td>
                            <td> <?php echo $account->date; ?> </td>
                            <td> 
                            	<?php if($account->closure == 1): ?>  
                            	<span class="badge badge-danger">Closed</span> 
                            	<?php else: ?> 
                            	<span class="badge badge-success">Open</span> 
                            	<?php endif; ?> 
                        	</td>
                            <td>
                            	<?php if($account->closure == 1): ?>  
                            	<form action="<?php echo base_url(); ?>index.php/accounts/openDailyAccount/<?php echo $account->id; ?>" method="post" id="myform">
                                    <button class="btn btn-new btn-dark">Open</button>
                                </form>
                            	<?php else: ?> 
                            	<form action="<?php echo base_url(); ?>index.php/accounts/dailyAccountClosure" method="post" id="myform">
                                	<input type="hidden" name="date" value="<?php echo $account->date; ?>" />
                                    <button class="btn btn-new btn-secondary">Close</button>
                                </form>
                            	<?php endif; ?> 
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>
    
<script>

<?php if($this->session->flashdata('error')) { ?>
    Swal.fire('Error', "<?php echo $this->session->flashdata('error'); ?>", 'warning');
<?php } ?>

<?php if($this->session->flashdata('success')) { ?>
    Swal.fire('', "<?php echo $this->session->flashdata('success'); ?>", 'success');
<?php } ?>


</script>