<!DOCTYPE html>  
<html>  
<head>  
    <title>table</title>  
    <style> 
	div {color: red;}
    table{  
       border-collapse: collapse;  			
    }
    tbody{
       min-height:3.5cm;
       min-width:12.5cm
    }
    th,td{  
  		border-radius:15px;
        border: 0px solid red;    
        padding:5px;
/*         font-size:15px; */
    } 
    #printer{
        width:12.4cm;
        font-weight: 900;
    }
               
    </style>  
  </head>  
<body onload="printcontend('printer')" onafterprint="myFunction()"> 
<div align="center" id="printer">
<div>
 <?php 
             
                    $dieties = $this->db->select("*")->from("diety")->get()->result_array();
                    if($dieties){
                        foreach ($dieties as $key => $diety){
		                   $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,pooja.pooja_cat,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
        	               $this->db->from('billing_dtls');
        	               $this->db->join('stars','stars.id = billing_dtls.star');
        	               $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	               $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	               $this->db->where('billing_dtls.bill_id', $bill_id);
        	               $this->db->where('billing_dtls.diety_id', $diety['id']);
        	               $query = $this->db->get()->result_array();
                           if(count($query)>0){
                                echo '<pre>',print_r($query),'</pre>';
                                // if($query['pooja_cat'] ==1){
                                // echo '<pre>',print_r($query,1),'</pre>';
                                // }else if($query['pooja_cat'] ==2){
                                //    echo '<pre>',print_r($query,1),'</pre>';
                                // }
                           }
                        }
                    }
              
             
            
		   
		    //print_r($bill_details);
exit;
            //exit();
		    //$a=$this->db->query("SELECT id From diety");
		    //$diety_id=$a->result_array();
		    foreach ($diety_id as $id){
		       
		        $id=$id['id'];
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('billing_dtls.diety_id', $id);
        	    $query = $this->db->get()->result_array();
        	    
        	    if(count($query)>0){
		    ?>
		<table> 
        <thead style="max-width:14cm">
			<tr>
				<td colspan="2" style="font-size:10px;padding-left:1.5cm;" ><?php print_r($query[0]['deity_nm']);?></td>
				<td  align="center"colspan="3"  style="font-size:10px;padding-left:1.5cm;"  ><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:10px; padding-left:1.5cm" ><?php print_r($query[0]['pooja_nm']);?></td>
				<td  align="center"colspan="3" style="font-size:10px;padding-left:1.5cm;"><?php print_r($bill_list[0]['id']);?></td>
			</tr>
        </thead>
        <tbody>
        <tr>  
           <td style="width:8.5cm;height:0.5cm"></td>
           <td style="width:2.3cm;height:0.5cm"></td>
           <td style="width:1.1cm;height:0.5cm"></td>
           <td style="width:1.2cm;height:0.5cm"></td>
           <td style="width:1.7cm;height:0.5cm"></td> 
        </tr>	
        <?php $i=1; $total='0';
		    foreach($query as $val){ 
				    $qlt=$val['qlt'];
				    $pooja_rt=$val['pooja_rt'];
				    $amt=$qlt*$pooja_rt;
				    $total=$total+$amt;
            $count = count($query);
		?>
        <tr>  
           <td style="width:8.5cm;height:0.5cm;font-size:10px"><?php echo strtoupper($val['name']);?></td>
           <td style="width:2.3cm;height:0.5cm;font-size:10px"><?php echo $val['star_eng'];?></td>
           <td style="width:1.1cm;height:0.5cm;font-size:10px"><?php echo $qlt;?></td>
           <td style="width:1.2cm;height:0.5cm;font-size:10px"><?php echo $pooja_rt;?></td>
           <td style="width:1.7cm;height:0.5cm;font-size:10px"><?php echo $amt;?></td> 
       </tr>	
        
       
      <?php  $i++; }?>
          <?php if($count = 1){
                    echo "<tr><td style='height:0.5cm'></br></br></br></td></tr>";
               }
               else if($count = 2){
                   echo "<tr><td style='height:0.5cm'></br></br></br></td></tr>";
               }
               else if($count = 3){
                   echo "<tr><td style='height:0.5cm'></br></br></td></tr>";
               }
               else if($count = 4){
                   echo "<tr><td style='height:0.5cm'></br></td></tr>";
               }
            ?>
    </tbody>   
    <tfoot>    
    <tr>
      <td colspan="4"></td>
      <td style="align:center;"><?php echo $total;?></td>
    </tr>
    <tr>  
		<td colspan="3"  style="font-size:15px;padding-left:4cm" ><?php echo date('d-m-Y'); ?> </td>
		<td align="center"colspan="3" style="font-size:15px;" > സമയം: </td>
	</tr>
    </tfoot>
		</table> 
</div> 
<?php }} ?>
</div> 
</body>  
</html>  
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/billing";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>