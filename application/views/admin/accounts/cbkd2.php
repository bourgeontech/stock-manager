<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cash Book - Sree Kadampuzha Bhagavathi Temple</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    background: #c8c8c8;
    font-family: 'Times New Roman', Times, serif;
    font-size: 11px;
  }

  .print-controls {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
    padding: 10px;
    background: #f0f0f0;
    border-bottom: 1px solid #ccc;
  }
  .print-controls button {
    padding: 6px 20px;
    font-size: 14px;
    font-family: Arial, sans-serif;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
    border: none;
  }
  .btn-print { background: #1a5276; color: #fff; }
  .btn-pdf   { background: #1e8449; color: #fff; }
  .btn-print:hover { background: #154360; }
  .btn-pdf:hover   { background: #196f3d; }

  .page-wrapper {
    display: flex;
    justify-content: center;
    padding: 20px;
  }

  .a4 {
    width: 297mm;
    min-height: 210mm;
    background: #fff;
    padding: 10mm 12mm 12mm;
    border: 0.5px solid #aaa;
  }
   .a3 {
    width: 100%;
    min-height: 297mm;
    background: #fff;
    padding: 10mm 12mm 12mm;
    border: 0.5px solid #aaa;
  }

  /* ---- Page Header ---- */
  .header {
    text-align: center;
    margin-bottom: 8px;
  }
  .header .temple-name {
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  .header .sub-title {
    font-size: 12px;
    font-weight: 600;
    margin-top: 2px;
  }
  .header .date-line {
    font-size: 11px;
    margin-top: 2px;
  }

  /* ---- Two-table side-by-side layout ---- */
  .tables-wrapper {
    display: flex;
    gap: 0;
    align-items: stretch;
    width: 100%;
  }

  .table-section {
    flex: 1;
    min-width: 0;
  }

  .table-divider {
    width: 5px;
    background: #bbb;
    border-top: 1px solid #333;
    border-bottom: 1px solid #333;
    flex-shrink: 0;
  }

  /* ---- Shared table styles ---- */
  .cb-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
  }

  .cb-table th,
  .cb-table td {
    border: 1px solid #333;
    padding: 3px 5px;
    vertical-align: top;
  }

  /* Column widths */
  .cb-table col.c-sno  { width: 9%; }
  .cb-table col.c-head { width: 56%; }
  .cb-table col.c-cash { width: 17.5%; }
  .cb-table col.c-bank { width: 17.5%; }

  /* Section header */
  .section-hdr th {
    background: #333;
    color: #fff;
    text-align: center;
    font-size: 12px;
    font-family: Arial, sans-serif;
    letter-spacing: 1.5px;
    padding: 5px 4px;
    font-weight: 700;
  }

  /* Column heading row */
  .col-hdr th {
    background: #d6d6d6;
    text-align: center;
    font-size: 10.5px;
    font-family: Arial, sans-serif;
    font-weight: 700;
    padding: 4px 3px;
  }

  /* Data cells */
  td.sno  { text-align: center; font-size: 10px; }
  td.cash { text-align: right;  font-size: 10.5px; white-space: nowrap; }
  td.bank { text-align: right;  font-size: 10.5px; white-space: nowrap; }

  td.achead-wrap { padding: 3px 5px; }
  .achead {
    font-weight: 700;
    font-size: 11px;
  }
  .narration {
    font-weight: 400;
    font-size: 11.5px;
    font-style: italic;
    color: #444;
    line-height: 1.5;
    white-space: pre-line;
    margin-top: 2px;
  }

  /* Opening balance row */
  .row-opening td { background: #f5f5f5; }

  /* Empty filler rows */
  .row-empty td { height: 18px; }

  .totals-section {
    display: flex;
    gap: 0;
    width: 100%;
    margin-top: 0; /* flush against last data row */
  }

  .totals-section .table-section {
    flex: 1;
    min-width: 0;
  }

  .totals-section .table-divider {
    width: 5px;
    background: #bbb;
    flex-shrink: 0;
  }

  .totals-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
  }

  .totals-table col.c-sno  { width: 9%; }
  .totals-table col.c-head { width: 56%; }
  .totals-table col.c-cash { width: 17.5%; }
  .totals-table col.c-bank { width: 17.5%; }

  .totals-table td {
    border: 1px solid #333;
    padding: 4px 5px;
    font-family: Arial, sans-serif;
    font-size: 11px;
    font-weight: 700;
  }

  /* Total row */
  .row-total td {
    background: #e8e8e8;
    border-top: 2px solid #333;
  }
  .row-total td.cash,
  .row-total td.bank { text-align: right; }
  .row-total .label  { text-align: right; }

  /* Closing balance row */
  .row-closing td {
    background: #ddeedd;
    border-top: 1px solid #555;
  }
  .row-closing td.cash,
  .row-closing td.bank { text-align: right; }
  .row-closing .label  { text-align: right; }

  /* Note row (expense side) */
  .row-note td {
    background: #ddeedd;
    border-top: 1px solid #555;
    font-size: 9.5px;
    font-style: italic;
    font-weight: 400;
    color: #444;
    text-align: center;
  }

  /* ---- Print styles ---- */
  @media print {
    body { background: #fff; }
    .print-controls { display: none !important; }
    .page-wrapper { padding: 0; }
    .cashbook-doc {
      border: none;
      width: 100%;
      padding: 0;
    }
    @page { size: A4 landscape; margin: 10mm; }

    /*
      The header repeats on each printed page automatically
      because it is outside the scrollable table body.
      If you need it to repeat on every page use:
      thead { display: table-header-group; }
    */
    thead { display: table-header-group; }

    /*
      TOTAL + CLOSING BALANCE on last page only.
      The .totals-section has no special break by default —
      it will appear right after the last data row.
      If you want to force it to a NEW page, uncomment below:
    */
    /* .totals-section { break-before: page; } */

    /* Prevent totals rows from breaking across pages */
    .totals-section { break-inside: avoid; }
    .row-total, .row-closing, .row-note { break-inside: avoid; }
  }
</style>
</head>
<body>
<?php
    
     $search_date=$date;
     if($search_date==""){
         $search_date=date('Y-m-d');
     }
     $convertDate = date("Y-m-d", strtotime($search_date));

     $payment = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
  
     $pay=$payment['payment'];
    

        $receipt = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='2' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
        $rec=$receipt['receipt'];
          
    $open_cash=$rec-$pay;
    
    $payment1 = $this->db->query("SELECT sum(payment.amount) as payment,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='1'")->row_array();
    
    $pay1=$payment1['payment'];
    
    
    $receipt1 = $this->db->query("SELECT sum(payment.amount) as receipt,ledger.* FROM `payment` Join ledger On payment.mode=ledger.led_Id WHERE `group`='3' AND payment.is_delete!=1 AND `payment_date` < '$convertDate' and `type`='2'")->row_array();
    $rec1=$receipt1['receipt'];
    
    $open_bank=$rec1-$pay1;
        

//TOTAL DEBIT & CREDIT

$payment = $this->db->query("SELECT sum(amount) as payment FROM `payment` WHERE `payment_date` = '$convertDate' and type='1'")->result_array();
  
          foreach($payment as $val){ 
          $total_debit=$val['payment'];
        }

     $receipt = $this->db->query("SELECT sum(amount) as receipt FROM `payment` WHERE `payment_date` = '$convertDate' and type='2'")->result_array();
  
          foreach($receipt as $val){ 
          $total_credit=$val['receipt'];
        }
        $this->db->select('payment.*,ledger.*,ledger.name_mal as led_mal');
        $this->db->from('payment');
        $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
        $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
        $this->db->where('payment.payment_date',$convertDate);
        $this->db->where('payment.type', 2);
        $this->db->where('payment.is_delete !=', 1);
        $query2 = $this->db->get()->result_array();
        
        $this->db->select('payment.*,ledger.*,ledger.name_mal as led_mal');
        $this->db->from('payment');
        $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
        $this->db->join('ledger_group', 'ledger_group.group_id = ledger.group');
        $this->db->where('payment.payment_date',$convertDate);
        $this->db->where('payment.type', 1);
        $this->db->where('payment.is_delete !=', 1);
        $query3 = $this->db->get()->result_array();
        
        $count=count($query2);
        $count1=count($query3);
		
		$income_count = count($query2);
    $expense_count = count($query3);
	
	$max_rows = max(($income_count + 1), $expense_count); 
    
    // Optional: Set a minimum number of rows if you want the book to always look full
    $min_display_rows = 10; 
    $final_row_target = max($max_rows, $min_display_rows);

   ?>
<div class="print-controls">
  <button class="btn-print" onclick="window.print()">🖨️ Print</button>
  <button class="btn-pdf"   onclick="window.print()">⬇️ Save as PDF</button>
</div>

<div class="page-wrapper">
<div class="a3">

  <div class="header">
    <div class="temple-name">Sree Kadampuzha Bhagavathi Temple</div>
    <div class="sub-title">Cash Book</div>
    <div class="date-line">Date: <?php if (isset($date)){echo date('d/m/Y',strtotime($date));};?>)</div>
  </div>

  <div class="tables-wrapper">

    <!-- ============================================================ -->
    <!--                      INCOME TABLE                            -->
    <!-- ============================================================ -->
    <div class="table-section">
      <table class="cb-table">
        <colgroup>
          <col class="c-sno">
          <col class="c-head">
          <col class="c-cash">
          <col class="c-bank">
        </colgroup>

        <thead>
          <tr class="section-hdr">
            <th colspan="4">INCOME</th>
          </tr>
          <tr class="col-hdr">
            <th>Sno</th>
            <th>A/C Head</th>
            <th>Cash (₹)</th>
            <th>Bank (₹)</th>
          </tr>
        </thead>

        <tbody>

          <!-- Opening Balance -->
          <tr class="row-opening">
            <td class="sno"></td>
            <td class="achead-wrap">
              <div class="achead">Cash / Bank Opening Balance</div>
              <div class="narration">Opening balance as on 01/01/2026</div>
            </td>
            <td class="cash"><?php echo (number_format($open_cash, 2, '.', '')); ?></td>
            <td class="bank"><?php echo (number_format($open_bank, 2, '.', '')); ?></td>
          </tr>

          <!-- ===== LOOP INCOME ROWS START ===== -->
         <?php 
                	    			$i=0;
                	    			$c_tot=0;
                	    			$b_tot=0;
                	    			$c_tot=$c_tot+$open_cash;
                	    			$b_tot=$b_tot+$open_bank;
                                	$c_tot1=0;
                	    			$b_tot1=0;
                	    			foreach ($query2 as $val){
                	    			    $mode=$val['mode'];
                	    			    $this->db->select('group');
                	    			    $this->db->from('ledger');
                	    			    $this->db->where('led_Id', $mode);
                	    			    $query1 = $this->db->get()->row_array();
                	    			    if ($query1['group']=='2'){
                	    			        $cash=$val['amount'];
                	    			        $bank="0";
                	    			        $c_tot=$c_tot+$cash;
                                        	$c_tot1+=$cash;
                	    			    }elseif ($query1['group']=='3'){
                	    			        $bank=$val['amount'];
                	    			        $cash="0";
                	    			        $b_tot=$b_tot+$bank;
                                        	$b_tot1+=$bank;
                	    			    }
                	    			    ?> <tr>
            <td class="sno"><?php echo $val['voucher_no']?></td>
            <td class="achead-wrap">
              <div class="achead"><?php echo $val['name'];?></div>
              <div class="narration"><?php echo $val['narration']?></div>
            </td>
            <td class="cash"><?php echo (number_format($cash, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($bank, 2, '.', ''));?></td>
          </tr>
<?php }?>
          
          <!-- ===== LOOP INCOME ROWS END ===== -->

          <!-- Filler rows — add or remove to balance height -->
         <?php 
            $income_filler = $final_row_target - ($income_count + 1);
            for($i = 0; $i < $income_filler; $i++) {  ?>
          <tr class="row-empty"><td class="sno"></td><td></td><td class="cash"></td><td class="bank"></td></tr>
         <?php 
        }?>
        </tbody>

     <!--   <tfoot>
          <tr class="row-total">
            <td colspan="2" class="label">TOTAL</td>
            <td class="cash"><?php echo (number_format($c_tot1, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot1, 2, '.', ''));?></td>
          </tr>
          <tr class="row-closing">
            <td colspan="2" class="label">CLOSING BALANCE</td>
            <td class="cash"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
          </tr>
        </tfoot>-->
      </table>
    </div>
    <!-- END INCOME TABLE -->

    <div class="table-divider"></div>

    <!-- ============================================================ -->
    <!--                    EXPENDITURE TABLE                         -->
    <!-- ============================================================ -->
    <div class="table-section">
      <table class="cb-table">
        <colgroup>
          <col class="c-sno">
          <col class="c-head">
          <col class="c-cash">
          <col class="c-bank">
        </colgroup>

        <thead>
          <tr class="section-hdr">
            <th colspan="4">EXPENDITURE</th>
          </tr>
          <tr class="col-hdr">
            <th>Vr. No</th>
            <th>A/C Head</th>
            <th>Cash (₹)</th>
            <th>Bank (₹)</th>
          </tr>
        </thead>

        <tbody>
<?php 
                	    			$i=0;
                	    			$c_tot1=0;
                	    			$b_tot1=0;
                                	$total_rows=count($query2);
                                	$total_rows1=count($query3);
                                $count=$total_rows-$total_rows1;
                               
                	    			foreach ($query3 as $val){
                	    			    $mode=$val['mode'];
                	    			    $this->db->select('group');
                	    			    $this->db->from('ledger');
                	    			    $this->db->where('led_Id', $mode);
                	    			    $query1 = $this->db->get()->row_array();
                	    			    if ($query1['group']=='2'){
                	    			        $cash=$val['amount'];
                	    			        $bank="0";
                	    			        $c_tot1=$c_tot1+$cash;
                	    			    }elseif ($query1['group']=='3'){
                	    			        $bank=$val['amount'];
                	    			        $cash="0";
                	    			        $b_tot1=$b_tot1+$bank;
                	    			    }
                	    			    ?>
          <!-- ===== LOOP EXPENDITURE ROWS START ===== -->
          <tr>
            <td class="sno"><?php echo $val['voucher_no']?></td>
            <td class="achead-wrap">
              <div class="achead"><?php echo $val['name'];?></div>
              <div class="narration"><?php echo $val['narration']?></div>
            </td>
            <td class="cash"><?php echo (number_format($cash, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($bank, 2, '.', ''));?></td>
          </tr>
<?php } ?>
          
          <!-- ===== LOOP EXPENDITURE ROWS END ===== -->

          <!-- Filler rows -->

         <?php  $expense_filler = $final_row_target - $expense_count;
            for($i = 0; $i < $expense_filler; $i++) { ?>
          <tr class="row-empty"><td class="sno"></td><td></td><td class="cash"></td><td class="bank"></td></tr>
<?php } ?>
        </tbody>

       <!-- <tfoot>
            <tr class="row-total">
            <td colspan="2" class="label"></td>
            <td class="cash"><?php echo (number_format($c_tot1, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot1, 2, '.', ''));?></td>
          </tr>
          <tr class="row-total">
            <td colspan="2" class="label">CASH/BANK CLOSING BALANCE</td>
            <td class="cash"><?php echo (number_format($c_tot-$c_tot1, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot-$b_tot1, 2, '.', ''));?></td>
          </tr>
          <tr class="row-total">
            <td colspan="2" class="label">TOTAL</td>
            <td class="cash"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
          </tr>
          
        </tfoot>-->
      </table>
    </div>
    <!-- END EXPENDITURE TABLE -->

  </div><!-- .tables-wrapper -->
<div class="totals-section">

    <!-- Income totals -->
    <div class="table-section">
      <table class="totals-table">
        <colgroup>
          <col class="c-sno">
          <col class="c-head">
          <col class="c-cash">
          <col class="c-bank">
        </colgroup>
        <tbody>
          <tr class="row-total">
            <td colspan="2" class="label">TOTAL</td>
            <td class="cash"><?php echo (number_format($c_tot1, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot1, 2, '.', ''));?></td>
          </tr>
          <tr class="row-closing">
            <td colspan="2" class="label">CLOSING BALANCE</td>
            <td class="cash"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="table-divider"></div>

    <!-- Expenditure totals -->
    <div class="table-section">
      <table class="totals-table">
        <colgroup>
          <col class="c-sno">
          <col class="c-head">
          <col class="c-cash">
          <col class="c-bank">
        </colgroup>
        <tbody>
         
          <tr class="row-closing">
            <td colspan="2" class="label">TOTAL</td>
            <td class="cash"><?php echo (number_format($c_tot-$c_tot1, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot-$b_tot1, 2, '.', ''));?></td>
          </tr>
          <tr class="row-total">
            <td colspan="2" class="label">CLOSING BALANCE</td>
            <td class="cash"><?php echo (number_format($c_tot, 2, '.', ''));?></td>
            <td class="bank"><?php echo (number_format($b_tot, 2, '.', ''));?></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div><!-- .a4 -->
</div><!-- .page-wrapper -->

</body>
</html>
