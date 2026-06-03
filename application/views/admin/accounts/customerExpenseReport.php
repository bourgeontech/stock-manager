<div class="fluid-container mt-3">
    <!-- Header -->
    <div class="card p-3">
        <div class="row">
            <div class="col-md-3 d-flex flex-column">
                <h2 class="page_txt my-auto">Customer credit report</h2>
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
        <form method="POST" action="<?php echo base_url();?>index.php/admin/account">
        <div class="row justify-content-between">
            <div class="col-md-12 row">
                <div class="col-md-5 d-flex flex-column">
                    <input class="form-control" type="date" id="start_date" name="start_date" placeholder="From Date" value="<?php echo date('Y-m-d'); ?>" />
                </div>
                <div class="col-md-5 text-right">
                    <input class="form-control" type="date" id="end_date" name="end_date" placeholder="From Date" value="<?php echo date('Y-m-d'); ?>" />
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
                        <th>#</th>
                        <th>Bill No</th>
                        <th>Customer</th>
                    	<th>Total</th>
                        <th>Debit</th>
                        <th>Credit</th>
                    </tr>
                </thead>

                <tbody>
                	<?php $total = 0; $total_debit = 0; $total_credit = 0; ?>
                    <?php foreach($bills as $key => $bill): $total += $bill->total; $total_debit += $bill->received;  $total_credit += $bill->balance; ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $bill->bill_id; ?></td>
                        <td><?php echo $bill->customer ?? $bill->name; ?></td>
                    	<td><?php echo $bill->received + $bill->balance; ?></td>
                        <td><?php echo $bill->received; ?></td>
                        <td><?php echo $bill->balance; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            
            	<tfoot class="border">
                    <tr>
                        <th colspan="3" class="text-right">Total</th>
                    	<th><?php echo $total; ?></th>
                        <th><?php echo $total_debit; ?></th>
                        <th><?php echo $total_credit; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Scripts -->
