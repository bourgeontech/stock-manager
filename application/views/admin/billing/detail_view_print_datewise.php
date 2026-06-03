 <html>
	<head>
	<style>
    th, td {
        padding: 5px;
    }

    thead.print-only,
    tfoot.print-only {
        display: none;
    }

    @media print {
        thead.print-only {
            display: table-header-group;
        }

        /* Show tfoot only on the last printed page */
        tfoot.print-only {
            display: table-footer-group;
        }
    }
</style>
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
<style>
@media print {
    .page-break { page-break-before: always; }
}
</style>

<?php if (!empty($bill_list)): ?>
<?php $page=0; foreach ($bill_list as $date => $rows): ?>

<?php if ($page > 0): ?>
<div class="page-break"></div>
<?php endif; ?>

<?php
$cashtot = $qrtot = $nefttot = $cardtot = $motot = 0;
$postal_tot = $grand_tot = 0;
$i = 0;
?>

<h4 style="text-align:center">
<?= $temple_list[0]['name']; ?><br>
<?= $temple_list[0]['address'].' , '.$temple_list[0]['location']; ?><br>
Pooja Date : <?= date('d-m-Y', strtotime($date)); ?>
</h4>

<table border="1" width="100%" cellspacing="0" cellpadding="5">
<thead>
<tr>
<th>SL</th>
<th>Pooja</th>
<th>Qty</th>
<th>Rate</th>
<th>Cash</th>
<th>UPI</th>
<th>NEFT</th>
<th>CARD</th>
<th>MO</th>
<th>Postal</th>
<th>Amount</th>
</tr>
</thead>

<tbody>
<tbody>
<?php foreach ($rows as $row): 
    // Match these IDs to your site_settings/payment_modes table
    $cash = $row->amount_array[1] ?? 0;
    $upi  = $row->amount_array[6] ?? 0;
    $neft = $row->amount_array[5] ?? 0;
    $card = $row->amount_array[4] ?? 0; // Changed from 7 to 4 to match common settings, verify this!
    $mo   = $row->amount_array[8] ?? 0;

    $gross = $row->amt + $row->postal_amt;

    $cashtot += $cash;
    $qrtot   += $upi;
    $nefttot += $neft;
    $cardtot += $card;
    $motot   += $mo;

    $postal_tot += $row->postal_amt;
    $grand_tot  += $gross;
?>
<tr>
    <td><?= ++$i ?></td>
    <td><?= $row->pooja ?></td>
    <td><?= $row->quantity ?></td>
    <td><?= number_format($row->pooja_rt, 2) ?></td>
    <td><?= number_format($cash, 2) ?></td>
    <td><?= number_format($upi, 2) ?></td>
    <td><?= number_format($neft, 2) ?></td>
    <td><?= number_format($card, 2) ?></td>
    <td><?= number_format($mo, 2) ?></td>
    <td><?= number_format($row->postal_amt, 2) ?></td>
    <td><?= number_format($gross, 2) ?></td>
</tr>
<?php endforeach; ?>

</tbody>

<tfoot>
<tr>
<th colspan="4">Total</th>
<th><?= number_format($cashtot,2) ?></th>
<th><?= number_format($qrtot,2) ?></th>
<th><?= number_format($nefttot,2) ?></th>
<th><?= number_format($cardtot,2) ?></th>
<th><?= number_format($motot,2) ?></th>
<th><?= number_format($postal_tot,2) ?></th>
<th><?= number_format($grand_tot,2) ?></th>
</tr>

<tr>
<th colspan="11">
Total Cash in Hand :
<?= number_format($cashtot + $motot,2) ?>
</th>
</tr>
</tfoot>
</table>

<?php $page++; endforeach; ?>
<?php endif; ?>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/detail_view";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>
