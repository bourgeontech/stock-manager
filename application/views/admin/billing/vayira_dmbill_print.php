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
         height:385.51181102px;
         font-size:15px;
/*         background-color:green; */
    }
    .fixed-header{
        height:113.385826772px;
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
        height:132.283464567px;
        width:491.338582677px;
/*         background-color:purple; */
    }
    .bill-total{
       height:37.795275591px;
/*        background-color:white; */
    }
    .bottom{
       height:41.57480315px;
/*        background-color:yellow; */
    }
    .deity-name{
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
       width:190.330709px;
       text-align:left;
    }
    .star{
       display: table-cell;
       width:83.149606299px;
       text-align:left;
    }
    .pooja{
       display: table-cell;
       width:41.57480315px;
       text-align:left;
    }
    .qty{
       display: table-cell;
       width:45.354330709px;
       text-align:left;
    }
    .total{
       display: table-cell;
       width:56.692913386px;
       text-align:left;
    }
    .grand-total{
       float:right;
       clear:right;
       margin-right:94.488188976px;
       text-align:center;
    }
    .pooja-date{
       float:left;
       margin-left:207.87401575px;
       text-align:center;
    }
               
    </style>  
  </head>  
<body onload="printcontend('printer')" onafterprint="myFunction()" > 
	 <?php 
		   // $diety_id=$this->db->query("SELECT id From diety")->get()->result_array();
		    $pooja = $this->db->query("SELECT pooja FROM billing_dtls WHERE bill_id=$bill_id GROUP BY pooja")->result_array();
            $pooja_count = sizeof($pooja);
            //print_r($pooja_count);

		    $a=$this->db->query("SELECT id From pooja");
		    $diety_id=$a->result_array();
		    foreach ($diety_id as $id){
		        $id=$id['id'];
		        $this->db->select('billing_dtls.*,stars.name_mal as star_eng,pooja.name_mal as pooja_nm,billing_dtls.rate as pooja_rt,billing_dtls.amount as amt,diety.name_mal as deity_nm');
        	    $this->db->from('billing_dtls');
        	    $this->db->join('stars','stars.id = billing_dtls.star');
        	    $this->db->join('pooja','pooja.id = billing_dtls.pooja');
        	    $this->db->join('diety','diety.id = billing_dtls.diety_id');
        	    $this->db->where('billing_dtls.bill_id', $bill_id);
        	    $this->db->where('billing_dtls.pooja', $id);
        	    $query = $this->db->get()->result_array();
        	    
        	    if(sizeof($query)>0){
		    ?>
          <div align="center" id="printer" >
              <div class="fixed-header"></div>
              <div class="bill-details">
                  <span class="deity-name"><?php print_r($query[0]['deity_nm']);?></span>
                  <span class="bill-date"><?php print_r(date('d-m-Y',strtotime($bill_list[0]['date'])));?></span>
                  <br>
                  <span class="pooja-name"><?php print_r($query[0]['pooja_nm']);?></span>
                  <span class="bill-date"><?php print_r($bill_list[0]['id']);?></span>
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
                          $amount=$val['amount'];
                              $count = sizeof($query);
		           ?>
                    <div class="item-row">
                      <span class="name"><?php echo strtoupper($val['name']);?></span>
                      <span class="star"><?php echo $val['star_eng'];?></span>
                      <span class="pooja"><?php echo $qlt;?></span>
                      <span class="qty"><?php echo $pooja_rt;?></span>
                      <span class="total"><?php echo $amount;?></span>
                   </div>
                   <?php  $i++; }?>
                   <?php if($count == 1){ ?>
                        <div class="item-row"></div><div class="item-row"></div>
                   <?php } else if($count == 2){ ?>
                        <div class="item-row"></div>
                   <?php } ?>
              </div>
              <div class="bill-total">
                 <span class="grand-total"><?php echo $total;?></span><br>
                 <span class="pooja-date"><?php print_r(date('d-m-Y',strtotime($query[0]['date'])));?></span>
              </div>
              <div class="bottom"></div>
    </div> 
<?php }}  ?> 
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