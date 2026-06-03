<html>
<head>
</head>
<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer" style="border: 2px solid; width:100%; height:100%;" >
    <div align="center" >
    <div >
<table align="center"  >
<?php  if(isset($customer)){ foreach($customer as $val){  ?>

<?php
$groom_star=$val['groom_star'];
$bride_star=$val['bride_star'];
$sql1 ="SELECT * FROM stars where id=$groom_star";
$query1 = $this->db->query($sql1);  
$sql2 ="SELECT * FROM stars where id=$bride_star";
$query2 = $this->db->query($sql2);  
?>
    <tr style="text-align: center;">
       
        <td><br><h3><?php print_r($temple_list[0]['name']);?></h3>
        <h5><?php print_r($temple_list[0]['address']." , ".$temple_list[0]['location']);?></h4>
        <h4><u>വിവാഹ സാക്ഷ്യപത്രം </u></h5>
		<?php
		if ($this->db->field_exists('receipt_no', 'marriage_reg')) { if($val['receipt_no']!='') {?><h5>Receipt No.<?php echo $val['receipt_no']; ?> </h5><?php } } ?></td>
        </tr>
    </table>
 <table align="center" >     
<tr>
<td colspan=3><h4>വരന്റെ വിവരങ്ങൾ:</h4>
</tr>

<tr>
<td>പേര്:   &nbsp; <b><?php echo $val['groom_name']; ?>   </b></td> <td></td>
</tr>


<tr>
    <td>നക്ഷത്രം:<b> <?php  echo $query1->row()->name_mal;  ?></b> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;ജന്മദിനം: &nbsp; <b> <?php
    $date = str_replace('/', '-', $val['groom_DOB']);
    $newDate = date("d-m-Y", strtotime($date));
    echo $newDate;   ?>    </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;വയസ്സ്: &nbsp; <b><?php echo $val['groom_age']; ?>   </b></td>
    </tr>

    <tr>
        <td>പിതാവിന്റെ പേര്: &nbsp; <b><?php echo $val['groom_fname']; ?>   </b></td> <td></td>
        </tr>

        <tr>
            <td>മാതാവിന്റെ പേര്: &nbsp; <b><?php echo $val['groom_mname']; ?>   </b></td> <td></td>
            </tr>

            <tr>
                <td>വിലാസം: &nbsp; <b><?php echo $val['groom_address']; ?>   </b></td>
            </tr>

               

                

<tr>
    <td>ഫോൺ: &nbsp; <b><?php echo $val['groom_phone1']; ?>   </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  മൊബൈൽ നമ്പർ: &nbsp; <b><?php echo $val['groom_phone2']; ?>   </b></td>
    </tr>
                             
<!-- 
<tr>
    <td>വിവാഹ തീയതി: &nbsp; <b><?php echo $val['mdate']; ?>   </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; മുഹൂർത്തം: .&nbsp; <b><?php echo $val['muhoortham']; ?>   </b></td>
    </tr> -->

    
<tr>
    <td>ഐഡി തെളിവ്: &nbsp; <b><?php echo $val['groom_id_proof']; ?>   </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  നമ്പർ: &nbsp; <b><?php echo $val['groom_id_proof_no']; ?>   </b></td>
    </tr>
     <tr>     
    <td> <br>
    <strong> <hr></strong>
     <br> </td>
     </tr>         


    <tr>
        <td colspan=3><h4>വധുവിന്റെ വിവരങ്ങൾ:</h4>
        </tr>
        <tr>
            <td>പേര്: &nbsp;<b><?php echo $val['bride_name']; ?>   </b></td> <td></td>
            </tr>
            
            
            <tr>
                <td>നക്ഷത്രം: <b> <?php  echo $query2->row()->name_mal;  ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ജന്മദിനം: &nbsp;<b>
    <?php
    $date = str_replace('/', '-', $val['bride_DOB']);
    $newDate = date("d-m-Y", strtotime($date));
    echo $newDate;   ?>   </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;വയസ്സ്: &nbsp;<b><?php echo $val['bride_age']; ?>   </b></td>
                </tr>
            
                <tr>
                    <td>പിതാവിന്റെ പേര്: &nbsp;<b><?php echo $val['bride_fname']; ?>   </b></td> <td></td>
                    </tr>
            
                    <tr>
                        <td>മാതാവിന്റെ പേര്: &nbsp;<b><?php echo $val['bride_mname']; ?>   </b></td> <td></td>
                        </tr>
            
                        <tr>
                            <td> വിലാസം: &nbsp;<b><?php echo $val['bride_address']; ?>   </b></td>
                        </tr>
            
                           
            
                            
            
            <tr>
                <td>ഫോൺ: &nbsp;<b><?php echo $val['bride_phone1']; ?>   </b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;മൊബൈൽ നമ്പർ: &nbsp;<b><?php echo $val['bride_phone2']; ?>   </b></td>
                </tr>
                                         
<!--             
            <tr>
                <td>വിവാഹ തീയതി: &nbsp;<b><?php echo $val['mdate']; ?>   </b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;മുഹൂർത്തം: &nbsp;<b><?php echo $val['muhoortham']; ?>   </b></td>
                </tr>
             -->
                
            <tr>
                <td>ഐഡി തെളിവ്: &nbsp;<b><?php echo $val['bride_id_proof']; ?>   </b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; നമ്പർ: &nbsp;<b><?php echo $val['bride_id_proof_no']; ?>   </b></td>
                </tr>
            <tr><td><br></td></tr>
        <tr>
            <td><p>&nbsp;&nbsp;&nbsp;ഇവർ  തമ്മിലുള്ള  വിവാഹം  <?php echo $val['mdate']; ?> ന്  (<?php echo $val['f_muhoortham']; ?>  നും  <?php echo $val['to_muhoortham']; ?> ഇടയ്ക് )  <?php print_r($temple_list[0]['name']);?> സന്നിധിയിൽ വെച്ചു നടന്നതായി ഞാൻ സാക്ഷ്യപ്പെടുത്തുന്നു . <br><br></p></td>
            </tr>
                                     
            <tr>
                <td>റഫ.എം.ആർ  നമ്പർ :  MR0<?php echo $val['id']; ?> </td>  
                </tr>
                <tr>
                <td style="text-align:right;">എന്ന്
            <br>ക്ലാർക്/എക്സിക്യൂട്ടീവ്  ഓഫീസർ </td>    
                </tr>
                <tr>
                <td>സാക്ഷികൾ : &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
                </tr>
                <tr>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;1.<?php echo $val['witness1']; ?>   </b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> </td>
                </tr>
                <tr>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;2.<?php echo $val['witness2']; ?> &nbsp;   </td>
                </tr>
<?php }} ?>
</table>
</div></div>
</body>
</html> 
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/marriage_reg_view" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/marriage_reg_view";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>