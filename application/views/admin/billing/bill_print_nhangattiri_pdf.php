 <html>
	<head>
    <style>
    @media print {
  		footer {page-break-after: always;}
	}
    </style>
	</head>
	<body >
    <?php   
            $site_settings=$this->site_model->settings();
            $preparedby = $this->db->query("select admin.name,bill_time,counter.name as countername from admin join billing on billing.user_id = admin.id join counter on billing.counter=counter.id where billing.id = $bill_id")->row();
            //$a = $this->db->query("SELECT date FROM billing_dtls WHERE bill_id = $bill_id GROUP BY date");
            $a = $this->db->query("SELECT diety_id FROM billing_dtls WHERE bill_id = $bill_id GROUP BY diety_id");
		    $dates=$a->result_array();
        
          foreach ($dates as $date){
            //$da = $date['date'];
            $da = $date['diety_id'];
	        //$b = $this->db->query("SELECT pooja_cat FROM pooja WHERE id IN (SELECT pooja FROM billing_dtls WHERE bill_id = $bill_id and date='$da') GROUP BY pooja_cat");
		    $b = $this->db->query("SELECT pooja_cat FROM pooja WHERE id IN (SELECT pooja FROM billing_dtls WHERE bill_id = $bill_id and diety_id='$da') GROUP BY pooja_cat");
            $pooja_cat=$b->result_array();
          
		    foreach ($pooja_cat as $id){
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star','left');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('pooja.pooja_cat', $id['pooja_cat']);
                //$this->db->where('billing_dtls.date', $da);
                $this->db->where('billing_dtls.diety_id', $da);
                $this->db->group_by('billing_dtls.pooja');
                $this->db->group_by('billing_dtls.name');
                $this->db->group_by('billing_dtls.id');
        	    $query = $this->db->get()->result_array();
             
        	    if(sizeof($query)>0){
                
		    ?>
		<div id="printer">
		    <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		   
// 		  $site_settings=$this->site_model->settings();
// 		   $a=$this->db->query("SELECT id From diety");
// 		      $diety_id=$a->result_array();
// 		    foreach ($diety_id as $id){
		        
// 		        $id=$id['id'];
// 		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
//         	    $this->db->from('billing_dtls');
//         	    $this->db->join('stars','stars.id = billing_dtls.star');
//         	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
//         	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
//         	    $this->db->where('billing_dtls.bill_id', $bill_id);
//         	    $this->db->where('billing_dtls.diety_id', $id);
//         	    $query = $this->db->get()->result_array();
        	    
//         	    if(count($query)>0){
		    ?>
			<table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
			    <thead>
    				<tr>
    					<td  lang="ml" colspan="7" style="width:100%;" ><?php print_r($temple_list[0]['name']);?><br><?php print_r($temple_list[0]['address']." <br>".$temple_list[0]['location']);?>
                        </td><td><img alt="Image" src="<?php echo $site_settings['bill_image'];?>" style="height: 1.5cm;width: auto;">
    					
                        </td>
    				</tr>
    				<tr>
    					<td style="float:left;" colspan="3"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></td>
                        	<td  style="float:center;text-align:center;" colspan="3"  lang="ml"><?php print_r($query[0]['deity_nm']);?></td>
    					    <td style="float:right;font-size:bold;" colspan="2"  lang="ml">Bill - <?php print_r($bill_list[0]['id']);?></td>
    				    </th>
    				</tr>
    				<tr style="text-align:center;">
    				    <td style="max-width:1cm;">SN</td>
    				    <td>NAME</td>
    				    <td>STAR</td>
    				    <td>POOJANAME</td>
                    <td>T</td>
    				    <td>NO</td>
    				    <td>RATE</td>
    				    <td>AMT</td>
    				</tr>
				</thead>
				<tbody>
				    <?php
				    $i=1;
				    $total='0';
				    foreach($query as $val){ 
				        $qlt=$val['qlt'];
				        $pooja_rt=$val['pooja_rt'];
				       // $amt=$qlt*$pooja_rt;
                     $amt=$val['amount'];
				        $total=$total+$amt;
				        $date=$val['date'];
				        $today=date('Y-m-d');
                      $amount=$val['amount'];
				        ?>
				        <tr style="text-align:center;">
				            <td><?php echo $i;?></td>
				            <td lang="ml"><?php echo strtoupper($val['name']);?></td>
				            <td lang="ml"><?php echo $val['star_eng'];?></td>
				            <td lang="ml"><?php echo $val['pooja_nm']; if ($date!=$today){echo "(".date('d-m-Y',strtotime($date)).")";}?></td>
				          <td style="text-align:right"><?php  echo $val['time'];?></td>   
                        <td style="text-align:right"><?php echo $qlt;?></td>
				            <td style="text-align:right"><?php echo $pooja_rt;?></td>
				            <td style="text-align:right"><?php echo $amount;?></td>
				        </tr>
				    <?php 
				        $i++;
				    }?>
				    <tr>
				        <th></th>
				        <th colspan="6" style="text-align:left">Total</th>
				        <th style="text-align:right"><?php echo $total;?></th>
				    </tr>
				    <tr>
				        <th colspan="8" >For Online Pooja booking  <a href="<?php print_r($temple_list[0]['website']);?>"><?php print_r($temple_list[0]['website']);?></a>   - </th>
				    </tr>
				</tbody>
			</table>
        	<div style="width:100%">
                <strong style="text-align: left;margin-bottom:1cm;float:left;">Prepared By : <?= $preparedby->name; ?><br><?php echo  date("g:i a", strtotime($preparedby->bill_time)); ?><br>
           </strong>
				<strong style="text-align: right;margin-bottom:1cm;float:right;">CLERK <br> <?= $preparedby->countername; ?></strong>
             
            
        	</div>
        <footer></footer>
			<?php }} }?>
        
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/admin/billing_view" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/admin/billing";
}
function printcontend(value) {
	//var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
document.body.innerHTML=printcontend;
	window.print();
	//document.body.innerHTML=restorpage;
}

</script>