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
	padding: 0.2em 3em !important;
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
        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
        	<a class="btn btn-blue" href="<?php echo base_url(); ?>index.php/accounts/dayClosingByCategories" >Day Closing</a>
        </div>
    </div>
	
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 ">
        	<div class="card">
            	<div class="card-header pt-5">
                	<h4> Add Counter Banks </h4>
        		</div>
            	<div class="card-body p-5">
                	<form method="POST" action="<?php echo base_url(); ?>index.php/accounts/createCounterBanks">
                	<table class="table border">
                    	<thead>
                        	<tr>
                            	<th>Counter</th>
                            	<th>Bank </th>
                            	<th>Ledger (Bank Ledger)</th>
                        	</tr>
                    	</thead>

                    	<tbody>
                       		<tr>
                            	<td>  
                                	<select class="form-control" name="counter_id" id="counter_id" >
                                    	<option value="">Select Counter</option>
                                    	<?php foreach($counters as $key => $counter): ?>
										<option value="<?php echo $counter->id; ?>"><?php echo $counter->name; ?></option>
                        				<?php endforeach; ?>
                                	</select>
                            	</td>
                        		<td>
                            		<select class="form-control" name="bank_id" id="bank_id" >
                                    	<option value="">Select Bank</option>
                                    	<?php foreach($banks as $key => $bank): ?>
										<option value="<?php echo $bank->id; ?>"><?php echo $bank->name; ?></option>
                        				<?php endforeach; ?>
                                    	
                                	</select>
                            	</td>
                        		<td>
                            		<select class="form-control" name="ledger_id" id="ledger_id" >
                                    	<option value="">Select Ledger</option>
                                    	<?php foreach($ledgers as $key => $ledger): ?>
										<option value="<?php echo $ledger->led_Id; ?>"><?php echo $ledger->name; ?></option>
                        				<?php endforeach; ?>
                                	</select>
                            	</td>
                        	</tr>
                    	</tbody>
                	</table>
                	
                    <div class="d-flex flex-row justify-content-center">
                		<button class="btn btn-dark btn-new"> Save </button>
                    </div>
                    </form>
        		</div>
        	</div>
    	</div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 ">
            <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 ">
                        <h2 class="page_txt"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp; Counter Banks </h2>
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
                            <th>Counter</th>
                            <th>Bank</th>
                            <th>Ledger</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($counter_banks as $key => $counter_bank): ?>
                        <tr>
                            <td> <?php echo $key + 1; ?> </td>
                            <td> <?php echo $counter_bank->counter; ?> </td>
                        	<td> <?php echo $counter_bank->bank; ?> </td>
                        	<td> <?php echo $counter_bank->ledger; ?> </td>
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