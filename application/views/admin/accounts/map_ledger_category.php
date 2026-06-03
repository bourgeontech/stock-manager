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
                	<h4> Add Ledger Categories </h4>
        		</div>
            	<div class="card-body p-5">
                	<form method="POST" action="<?php echo base_url(); ?>index.php/accounts/mapLedgerCategory">
                	<table class="table border">
                    	<thead>
                        	<tr>
                            	<th>Pooja Category</th>
                            	<th>Parent Ledger</th>
                            	<th>Ledger</th>
                        	</tr>
                    	</thead>

                    	<tbody>
                       		<tr>
                            	<td>  
                                	<select class="form-control" name="category_id" id="category_id" >
                                    	<option value="">Select Pooja Category</option>
                                    	<?php foreach($categories as $key => $category): ?>
										<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                        				<?php endforeach; ?>
                                	</select>
                            	</td>
                        		<td>
                            		<select class="form-control" name="parent_ledger_id" id="parent_ledger_id" >
                                    	<option value="">Select Parent Ledger</option>
                                    	<?php foreach($parent_ledgers as $key => $ledger): ?>
										<option value="<?php echo $ledger->led_Id; ?>"><?php echo $ledger->name; ?></option>
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
                        <h2 class="page_txt"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp; Ledger Categories </h2>
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
                            <th>Category</th>
                            <th>Parent Ledger</th>
                            <th>Ledger</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($ledger_categories as $key => $ledger_category): ?>
                        <tr>
                            <td> <?php echo $key + 1; ?> </td>
                            <td> <?php echo $ledger_category->category; ?> </td>
                        	<td> <?php echo $ledger_category->parent_ledger; ?> </td>
                        	<td> <?php echo $ledger_category->ledger; ?> </td>
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