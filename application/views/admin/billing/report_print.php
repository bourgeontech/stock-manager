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
		    <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		 //  print_r($data);
		   
		    $a=$this->db->query("SELECT id,name, name_mal, has_token From pooja");
		    $pooja_id=$a->result_array();
       
		    foreach ($pooja_id as $id){
            	$has_token = $id['has_token'];
		        $pooja	= base_url() == 'https://kaladyshankaramadomts.org/' ? $id['name'] : $id['name_mal'];
		        $id		= $id['id'];
            
            	if ($has_token && $has_token == 1) {
                	$token = true;
                } else {
                	$token = false;
                }
            
		        $this->db->select('billing_dtls.*,stars.name_eng as star_eng, stars.name_mal as star_mal,pooja.name_mal as pooja_nm,pooja.name as pooja_eng,diety.name_mal as deity_nm,diety.name as deity_eng');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
            	$this->db->join('billing','billing.id = billing_dtls.bill_id');
                $this->db->where('billing_dtls.date', $date);
                $this->db->where('billing.deleted', '0');
                //$this->db->where('billing_dtls.date >=', $date);
                //
                //$this->db->where('billing_dtls.date <=', $dateto);
                if(@$type!=0){
                    $this->db->where('billing_dtls.diety_id', $diety);
                }
        	    $this->db->where('billing_dtls.pooja', $id);
            	if(@$type!=null){
            		$this->db->where('billing.date <', $date);
        		}
            
                if(@$ampm!=null){
            		$this->db->where('billing_dtls.time =', $ampm);
        		}
           // echo $this->db->last_query();
        	    $query = $this->db->get()->result_array();
        	    if(count($query)>0){
		    ?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:2cm;">
			    <thead>
    				<tr>
    					<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
    					</td>
    				</tr>
    				<tr>
    					<th colspan="9"><label style="float:left;">DATE :<?php echo date('d-m-Y',strtotime($query[0]['date']));?> <?php // echo date('d-m-Y',strtotime($date));?></label>
    					    <label style="float:center;">DIETY : <?= base_url() == 'https://kaladyshankaramadomts.org/' ? $query[0]['deity_eng'] : $query[0]['deity_nm']; ?></label>
    					    <label style="float:right;font-size:bold;">POOJA - <?php echo $pooja;?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL NO </th>
                        <th>BILL NO</th>
                    	<?php if($token): ?>
                    	<th>TOKEN</th>
                        <?php endif; ?>
                        <th>NAME</th>
                        <th>STAR</th>
                        <th>NOS</th>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    foreach($query as $val){ 
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
                            <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;">Bill - <?php echo $val['bill_id']; ?></strong></a></td>
                            <?php if($token): ?>
                    		<td><?php echo $val['token']; ?></td>
                        	<?php endif; ?>
                        	
                        
                        <td><?php if($_SERVER['HTTP_HOST']=="chelannursivatemple.templesoftware.in"){ if($val['name_locale']!=""){ echo $val['name_locale'];}else { echo strtoupper($val['name']);}}else { ?><?php echo strtoupper($val['name']);?><?php } ?></td>
                            <td><?= base_url() == 'https://kaladyshankaramadomts.org/' ? strtoupper($val['star_eng']) : strtoupper($val['star_mal']); ?> </td>
                            <td><?php echo $val['qlt']; ?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				</tbody>
			</table>
			<?php }}?>
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