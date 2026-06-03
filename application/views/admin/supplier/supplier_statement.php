<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Supplier Master</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 ">
          <form  action="<?php echo base_url();?>index.php/admin/admin/supplier_statement/<?php echo $id;?>" method="post">
            <div class="input-group">
              <input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}else{echo date('Y-m-d');}?>" name="datef" autofocus="autofocus" style="margin:10px 0;">
              <input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}else{echo date('Y-m-d');}?>" name="datet" style="margin:10px 0;">
              <select id="supplier" name="supplier" class="form-control" style="margin:10px 0;" disabled="disabled">
                  <option value="">Select Supplier</option>
                  <?php foreach($supplier as $val){ ?>
                    <option value="<?= $val['id']; ?>" <?php if(isset($id)&&$id==$val['id']){echo "selected";}?>><?= $val['name']; ?></option>
                  <?php } ?>
              </select>
              <div class="input-group-append" style="margin:10px 0;">
                <button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
<!--                         <button type="submit" class="btn btn-outline-secondary" name="serch" value="print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></button> -->
              </div>
            </div>
          </form>
      </div>
       <?php if(isset($purchase_list)){?>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Purchase </h2>
              </div>
             </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap" width="100%">
                  <thead>
                    <tr>
                      <th scope="col" width="">SL No </th>
                      <th scope="col" width="">Date</th>
                      <th scope="col" width="">Invoice No</th>
                      <th scope="col" width="">Total Amount</th>
                    </tr>
                  </thead>
                    <?php 
                        $total=0;
                        if(!empty($purchase_list)){
                        $i=0;
                        foreach($purchase_list as $val){
                            ?>
                  <tbody>
                    <tr>
                         <td><?= ++$i; ?></td>
                         <td><?= date('d-m-Y',strtotime($val['date'])); ?></td>
                         <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $val['invoice_no']; ?></strong></a></td>
                         <td style="text-align: right;"><?= $val['total_amt']; ?></td>
                    </tr>
                  </tbody>
                    <?php 
                    $total=$total+$val['total_amt'];
                        } }
                     else {
                    ?>	
                    <tbody><tr><td colspan="6" style="text-align:center;">No Data Found!</td></tr></tbody>	
                    <?php } ?>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th colspan="2">Total</th>
                            <th style="text-align: right;"><?php echo $total;?></th>
                        </tr>
                    </tfoot>	
                </table>
             </div>
            </div> 
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;List of Payments </h2>
              </div>
             </div>		
           <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap" width="100%">
                  <thead>
                    <tr>
                      <th scope="col" width="">SL No</th>
                      <th scope="col" width="">Date</th>
                      <th scope="col" width="">Ledger</th>
                      <th scope="col" width="">Amount</th>
                    </tr>
                  </thead>
                    <?php 
                    $total1=0;
                    $this->db->select('led_id');
                    $this->db->from('supplier');
                    $this->db->where('id', $id);
                    $query1 = $this->db->get()->row_array();
                    $supp_led=$query1['led_id'];
                    $this->db->select('*');
                    $this->db->from('payment');
                    $this->db->join('ledger', 'ledger.led_Id = payment.ledger');
                    $this->db->where('payment.ledger', $supp_led);
                    $this->db->where('payment.is_delete !=', 1);
                    $query = $this->db->get()->result_array();
                    if(!empty($query)){
                          $i=0;
                          foreach($query as $val){
                              $total1=$total1+$val['amount'];?>
                  <tbody>
                    <tr>
                      <td><?= ++$i; ?></td>
                      <td><?= date('d-m-Y',strtotime($val['payment_date'])); ?></td>
                      <td><?php echo $val['name'];?></td>
                      <td style="text-align: right;"><?php echo $val['amount'];?></td>
                    </tr>
                  </tbody>
                    <?php } } 
                          else{ ?>
                          <tr>
                             <td class="text-center" colspan="9">No Data Found</td>
                          </tr>
                    <?php } ?>	
            	  <tfoot>
                        <tr>
                            <th></th>
                            <th colspan="2">Total</th>
                            <th style="text-align: right;"><?php echo $total1;?></th>
                        </tr>
                    </tfoot>	  
                </table>
             </div>
            </div> 
          </div>
          <?php }?>
          </div>
      </div>
  </div>
<div class="clearfix"></div>
<br>
</body>