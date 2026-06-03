<?php
ini_set('max_execution_time', 600);
		ini_set('memory_limit', '2000M');
?>
<html>
	<head>
	    <style>
	        th , td{
	            padding:5px;
            	text-align:left;
	        }
	    </style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
        	<table style="border-collapse:collapse;width:100%;">
			    
    			<tr>
    				<td colspan="9" style="width:100%;"><h4 style="text-align:center;"><?php print_r($temple_list[0]['name']);?><br>
    					<?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
    				</td>
    			</tr>
            	<tr>
            		<th colspan="9">Pooja Details For The Date : <?php echo date('d-m-Y',strtotime($date));?></th>
            	</tr>
            		
		    <?php 
		   //$diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		 //  print_r($data);
		   
		    $a=$this->db->query("SELECT id,name_mal From pooja");
		    $pooja_id=$a->result_array();
    
		    foreach ($pooja_id as $id){
		        $pooja=$id['name_mal'];
		        $id=$id['id'];
		        $this->db->select('billing_dtls.*,billing.date as bill_date,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,diety.name_mal as deity_nm');
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
                if(@$diety!=0){
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
    				<tr>
    					<th colspan="9" style="padding-top:1cm;">
                        	<label style="float:left; font-size:1.1em"><?php echo $pooja;?> - <?php echo $query[0]['deity_nm'];?></label>
    				    </th>
    				</tr>
    				<tr>
    				    <th>SL NO </th>
                      <th>Bill no </th>
                        <th>BILL DATE</th>
                    	<th>QTY</th>
                        <th>NAME</th>
                        <th>STAR</th>
                        <th>TIME</th>
    				</tr>
				<tbody style="padding-bottom:2cm;">
				    <?php
				    $i=1; 
				    foreach($query as $val){ 
                    
                    
				        ?>
				        <tr>
				            <td><?php echo $i;?></td>
                        <td><?php echo $val['bill_id'];?></td>
                            <td><?php echo date('d-m-Y',strtotime($val['bill_date'])); ?></td>
                        	<td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?php echo $val['qlt']; ?></strong></a></td>
                           <td><?php if($_SERVER['HTTP_HOST']=="chelannursivatemple.templesoftware.in"){ if($val['name_locale']!=""){ echo $val['name_locale'];}else { echo strtoupper($val['name']);}}else { ?><?php echo strtoupper($val['name']);?><?php } ?></td>
                            <td><?php echo strtoupper($val['star_eng']); ?></td>
                            <td><?php echo $val['time']; ?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				</tbody>
			<?php }}?>
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