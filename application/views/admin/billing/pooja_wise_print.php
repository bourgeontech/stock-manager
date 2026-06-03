 <html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
	        }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<table border="1" style="border-collapse:collapse;width:100%;">
			<?php 
		      $b=$this->db->query("SELECT name From diety where id='$diety'");
		      $diety_id=$b->row_array();?>
				<tr>
					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?>
					<br><br>Pooja details as on <?php echo $date;?> - <?php echo $diety_id['name'];?></h4>
					</td>
				</tr>
			    <?php 
		   $this->db->select('
    billing_dtls.bill_id,
    billing_dtls.name,
    billing_dtls.time,
    billing_dtls.qlt,
    billing_dtls.pooja,
    stars.name_mal AS star_name,
    pooja.name_mal AS pooja_name,
    diety.name as dietyname
');

$this->db->from('billing_dtls');
$this->db->join('billing', 'billing.id = billing_dtls.bill_id AND billing.deleted = 0', 'INNER');
$this->db->join('pooja', 'pooja.id = billing_dtls.pooja', 'INNER');
$this->db->join('stars', 'stars.id = billing_dtls.star', 'LEFT');
$this->db->join('diety', 'diety.id = billing_dtls.diety_id', 'LEFT');
/* Filters */
$this->db->where('billing_dtls.date', $date);


if ($diety != '0') {
    $this->db->where('billing_dtls.diety_id', $diety);
}

if(isset($isimp) && $isimp=='1'){
                	$url = base_url().'index.php/admin/admin/bill_report_important';
     				$this->db->where('pooja.isimp', '1'); 
                }else{
                	$url = base_url().'index.php/admin/admin/bill_report';
                }

$this->db->order_by('billing_dtls.pooja', 'ASC');

$result = $this->db->get()->result_array();
$grouped = [];

foreach ($result as $row) {
    $grouped[$row['pooja_name']][] = $row;
}

$data['grouped'] = $grouped;
            //echo $this->db->last_query();
        	    //if(count($query)>0){
		          ?>
    				

<?php foreach ($grouped as $pooja_name => $rows): ?>
<tr>
    <th colspan="6">Pooja - <?= $pooja_name ?> (<?= $rows[0]['dietyname'];?>)</th>
</tr>

<tr>
    <th>SL No</th>
    <th>Bill No</th>
    <th>Name</th>
    <th>Star</th>
    <th>Time</th>
    <th>Nos</th>
</tr>

<?php $i = 1; foreach ($rows as $val): ?>
<tr>
    <td><?= $i++ ?></td>
    <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?php echo $val['bill_id']; ?></strong></a></td>
    <td><?= $val['name'] ?></td>
    <td><?= $val['star_name'] ?></td>
    <td><?= $val['time'] ?></td>
    <td><?= $val['qlt'] ?></td>
</tr>
<?php endforeach; ?>

<?php endforeach; ?>

</table>
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo $url;?>" }, 500); }
function myFunction(){
    window.location = "<?php echo $url;?>";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>