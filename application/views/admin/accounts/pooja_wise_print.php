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
		   $a=$this->db->query("SELECT id,name_mal From pooja");
		      $pooja_id=$a->result_array();
		    foreach ($pooja_id as $key=>$id){
		        $pooja=$id['name_mal'];
		        $id=$id['id'];
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,diety.name as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
                $this->db->where('billing_dtls.date', $date);
                $this->db->where('billing_dtls.diety_id', $diety);
        	    $this->db->where('billing_dtls.pooja', $id);
        	    $query = $this->db->get()->result_array();
        	    if(count($query)>0){
		          ?>
    				<tr>
    					<th colspan="9">
    					    <label style="float:center;">Pooja - <?php echo $pooja;?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL No </th>
                        <th>Bill No</th>
                        <th>Name</th>
                        <th>Star</th>
                        <th>Nos</th>
    				</tr>
				    <?php
				    $i=1;
				    foreach($query as $val){ 
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
                            <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?php echo $val['bill_id']; ?></strong></a></td>
                            <td><?php echo $val['name']; ?></td>
                            <td><?php echo $val['star_eng']; ?></td>
                            <td><?php echo $val['qlt']; ?></td>
				        </tr>
				    <?php 
				        $i++;
				    }
        	    }
		    }?>
			</table>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/bill_report" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/bill_report";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>