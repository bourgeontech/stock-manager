<!DOCTYPE html>  
<html>  
<head>  
    <title>table</title>
   <style>
    body{
      margin:0px;
      padding:0px;
    }
    #printer{
         width:582.047244094px;
         height:378.51181102px;
/*      height:385.51181102px; */

         font-size:14px;
/*         background-color:green; */
    }
    .fixed-header{
        height:112.568188976px;
/*         background-color:red; */
    } 
    .bill-details{
        height:37.7952755912px;
/*         background-color:orange; */
    }
    .item-header{
        height:26.456692913px;
/*         background-color:blue; */
    }
    .item-details{
        display: table;
/*         height:121.283464567px; */
        height:130.28346457px;
        width:491.338582677px;
/*         background-color:purple; */
    }
    .bill-total{
       height:37.795275591px;
/*        background-color:white; */
    }
    .bottom{
       /*height:41.57480315px;
/*        background-color:yellow; */
    height:48.795275591px;
    }
    .bill-no{
       position: relative;
       float: left;
       margin-left:71.811023622px;
    }
    .bill-date{
       position: relative;
       float: right;
       margin-right:94.488188976px;
    }
    .pooja-name{
       float: left;
       clear: left;
       margin-left:71.811023622px;
    }
    .happen-date{
       float: right;
       clear: right;
       margin-right:94.488188976px;
    }
    .item-row{
       display: table-row;
       height:44.094488315px;
    }
    .name{
       display: table-cell;
       width:94.488188976px;
       text-align:left;
    }
    .star{
       display: table-cell;
       width:94.488188976px;
       text-align:left;
    }
    .pooja{
       display: table-cell;
       width:170.07874016px;
       text-align:left;
    }
    .qty{
       display: table-cell;
       width:56.692913386px;
       text-align:left;
    }
    .total{
       display: table-cell;
       width:75.590551181px;
       text-align:left;
    }
    .grand-total{
       float:right;
       clear:right;
       margin-right:100.488188976px;
       text-align:center;
    }
    .pooja-date{
       float:left;
       margin-left:207.87401575px;
       text-align:center;
    }         
    </style>
  </head>  
<body onload="printcontend('printer')" onafterprint="myFunction()"> 
	<?php   $a = $this->db->query("SELECT date FROM billing_dtls WHERE bill_id = $bill_id GROUP BY date");
		    $dates=$a->result_array();
            
          foreach ($dates as $date){
            $da = $date['date'];
	        $b = $this->db->query("SELECT pooja_cat FROM pooja WHERE id IN (SELECT pooja FROM billing_dtls WHERE bill_id = $bill_id and date='$da') GROUP BY pooja_cat");
		    $pooja_cat=$b->result_array();
          
		    foreach ($pooja_cat as $id){
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,diety.name_mal as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star','left');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('pooja.pooja_cat', $id['pooja_cat']);
                $this->db->where('billing_dtls.date', $da);
                $this->db->group_by('billing_dtls.pooja');
                $this->db->group_by('billing_dtls.name');
        	    $query = $this->db->get()->result_array();
             
        	    if(sizeof($query)>0){
                
		    ?>
          <div align="center" id="printer" >
              <div class="fixed-header"></div>
              <div class="bill-details">
                  <span class="bill-no"><?php print_r($bill_list[0]['id']);?></span>
                  <span class="bill-date"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></span>
                  <span class="happen-date"><?php print_r(date('d-m-Y',strtotime($query[0]['date'])));?></span>
              </div>
              <div class="item-header">
              
              </div>
              <div class="item-details">
                    <?php $i=1; $total='0';
		                  foreach($query as $val){ 
				              $qlt=$val['qlt'];
				              $pooja_rt=$val['pooja_rt'];
				              $amt=$qlt*$pooja_rt;
				              $total=$total+$amt;
                              $count = sizeof($query);
		           ?>
                    <div class="item-row">
                      <span class="name"><?php echo strtoupper($val['name']);?></span>
                      <span class="star"><?php echo $val['star_eng'];?></span>
                      <span class="pooja"><?php echo $val['pooja_nm'];?></span>
                      <span class="qty"><?php echo $qlt;?></span>
                      <span class="total"><?php echo $amt;?></span>
                   </div>
                   <?php  $i++; }?>
<!--                    <?php //if($count == 1){ ?>
                        <div class="item-row">&nbsp;hi</div><div class="item-row">&nbsp;hi</div>
                   <?php//3 } else if($count == 2){ ?>
                        <div class="item-row">&nbsp;hi</div>
                   <?php// } ?> -->
              </div>
              <div class="bill-total">
                 <span class="grand-total"><?php echo $total;?></span>
              </div>
              <div class="bottom"></div>
    </div> 
<?php }} } ?> 
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