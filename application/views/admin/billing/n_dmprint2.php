<!DOCTYPE html>  
<html>  
<head>  
    <title>table</title>  
    <style> 
    table{  
       border-collapse: collapse;  			
    }
    tbody{
       min-height:1cm;
       min-width:15.5cm
    }
    th{  
        border: 0px solid red;    
        padding:5px;
        display:block;
/*         font-size:15px; */
    } 
    td{ 
        border: 0px solid red;    
        padding:5px;
/*         font-size:15px; */
    } 
    #printer{
        width:12.2cm;
        font-weight:bold;
    }
               
    </style>  
  </head>  
<body onload="printcontend('printer')" onafterprint="myFunction()"> 
	    
	<?php   $a = $this->db->query("SELECT pooja_cat FROM pooja WHERE id IN (SELECT pooja FROM billing_dtls WHERE bill_id = $bill_id) GROUP BY pooja_cat");
		    $pooja_cat=$a->result_array();
  // print_r($pooja_cat);
		    foreach ($pooja_cat as $id){
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('pooja.pooja_cat', $id['pooja_cat']);
                $this->db->group_by('billing_dtls.pooja');
                $this->db->group_by('billing_dtls.name');
        	    $query = $this->db->get()->result_array();
        	    if(sizeof($query)>0){
		    ?>
   <div align="center" id="printer" >
      <div>  
		<table> 
        <tbody>
        <tr>
          <td colspan="5" valign="top">
            <table width="100%" height="100%">
              <thead style="height:2cm;width:12.2cm">
                <tr>
                  <td style="width:88px;"></td>
                  <td valign="top" style="font-size:13px;text-align:left;"><?php print_r($bill_list[0]['id']);?></td>
                  <td colspan="3" valign="top" style="font-size:13px;text-align:right"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></td>
               </tr>
               <tr>
                 <td colspan="1" valign="top" style="font-size:13px;"></td>
                 <td>&nbsp;</td>
                 <td  colspan="3" valign="top" style="font-size:13px;text-align:right"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></td>
              </tr>
           </thead>
          </table>
          </td>
        </tr>
        <tr>  
           <td style="width:3.5cm;height:0.5cm"></td>
           <td style="width:2.3cm;height:0.5cm"></td>
           <td style="width:2.2cm;height:0.5cm"></td>
           <td style="width:1.1cm;height:0.5cm"></td>
           <td style="width:1.7cm;height:0.5cm"></td> 
        </tr>	
        <?php $i=1; $total='0';
		    foreach($query as $val){ 
				    $qlt=$val['qlt'];
				    $pooja_rt=$val['pooja_rt'];
				    $amt=$qlt*$pooja_rt;
				    $total=$total+$amt;
                    $count = sizeof($query);
		?>
        <tr>  
           <td style="width:3.5cm;height:1.1cm;font-size:15px;text-align:left"><?php echo strtoupper($val['name']);?></td>
           <td style="width:2.3cm;height:1.1cm;font-size:15px;text-align:left"><?php echo $val['star_eng'];?></td>
           <td style="width:3.2cm;height:1.1cm;font-size:15px;text-align:left"><?php echo $val['pooja_nm'];?></td>
           <td style="width:1.1cm;height:1.1cm;font-size:15px;text-align:left"><?php echo $qlt;?></td>
           <td style="width:1.7cm;height:1.1cm;font-size:15px;text-align:right"><?php echo $amt;?></td> 
       </tr>	
        
         
      <?php  $i++; }?>
          <?php if($count == 1){
                    echo "<tr><td style='height:1.1cm'>&nbsp;</td></tr><tr><td style='height:1.1cm'>&nbsp;</td></tr>";
               }
               else if($count == 2){
                   echo "<tr><td style='height:1.1cm'>&nbsp;</td></tr>";
               }
            ?>
           <tr>
              <td colspan="4">&nbsp;</td>
              <td colspan="1" style="height:1.1cm;float:right;"><?php echo $total;?></td>
          </tr>
           
    </tbody>      
</table>
</div> 
       </div> 
<?php }} ?> 

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