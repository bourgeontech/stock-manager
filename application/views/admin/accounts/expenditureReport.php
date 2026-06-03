<script src="https://jsuites.net/v5/jsuites.js"></script>
<link rel="stylesheet" href="https://jsuites.net/v5/jsuites.css" type="text/css" />
<div class="fluid-container mt-3">
    <!-- Header -->
    <div class="card p-3">
        <div class="row">
            <div class="col-md-3 d-flex flex-column">
                <h2 class="page_txt my-auto">Expenditure report</h2>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <h4 class="page_txt text-center my-auto"></h4>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <h4 class="page_txt text-center my-auto"></h4>
            </div>
            <div class="col-md-3 text-right">
                <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a>
            </div>
        </div>
    </div>
    
    <!-- Create Row -->
    <div class="card p-3">
        <!-- Heading -->
    	<div class="row mb-5">
            <div class="col-md-12 d-flex flex-row align-items-center">
                <h3 class="page_txt my-auto"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp; </h3>
                <h4 class="page_txt my-auto"> Filter </h4>
            </div>    
        </div>
        <form method="POST" action="<?php echo base_url();?>index.php/accounts/expenditureReport">
        <div class="row justify-content-between">
            <div class="col-md-12 row">
                <div class="col-md-10 text-right">
                    <input class="form-control" type="text" id="month" name="month" value="<?php if(isset($month)) echo $month; ?>" placeholder="Month" />
                </div>
                
                <div class="col-md-2 text-right">
                	<button class="btn btn-primary w-100"> Search </button>
                </div>
            </div>
        </div>
        </form>
    </div>
    
    <!-- Details -->
    <div class="card p-3">
        <!-- Contents -->
        <div class="row justify-content-between">
            <table class="table border">
                <thead>
                	<tr>
                        <th colspan="5" class="text-center">Expenditure Report of <span class="text-primary"> <?php if(isset($month)) echo $month; ?> </span> </th>
                    </tr>
                    <tr>
                        <th>S.No</th>
                        <th>Voucher No</th>
                        <th>Particulars</th>
                    	<th>Amount</th>
                        <th>Remarks</th>
                    </tr>
                </thead>

                <tbody>
                	<?php $total = 0; $total_debit = 0; $total_credit = 0; ?>
                	<?php if(isset($expenses)): ?>
                    <?php foreach($expenses as $key => $expense): $total += $expense->amount;  ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $expense->voucher_no; ?></td>
                        <td><?php echo $expense->ledger." - ".$expense->ledger_locale; ?></td>
                    	<td><?php echo $expense->amount; ?></td>
                        <td><?php echo $expense->remarks; ?></td>
                    </tr>
                    <?php endforeach; ?>
                	<?php endif; ?>
                </tbody>
            
            	<tfoot class="border">
                    <tr>
                        <th colspan="3" class="text-right">Total</th>
                    	<th><?php echo $total; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Scripts -->
<script>
var today = "<?php echo date('Y-m-d'); ?>";
jSuites.calendar(document.getElementById('month'), {
    type: 'year-month-picker',
    format: 'MMM-YYYY',
    validRange: [ '2018-02-01', today ]
});

$('#month').on('change', (e) => {
	alert(e.target.value)
})
</script>