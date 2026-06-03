<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2.page_txt {
            margin-top: 20px; 
        }
        .table-responsive {
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="side_right">
        <div class="mt-2"></div>
        <div class="clearfix"></div>
        <div class="page-header">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h2 class="page_txt"> MEMBERSHIP MODULE </h2>
            </div>
        </div>        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Membership Report </h2>
                            <form action="<?php echo base_url();?>index.php/admin/report/membership_report" method="post">
    							<div class="row">
        							<div class="col-lg-5 col-md-5 col-sm-5">
            							<input type="text" class="form-control" placeholder="Search by Name, Mobile Number, or Membership ID" name="search_term" value="<?php if(isset($search_term)){echo $search_term;}?>" style="margin:10px 0;">
        							</div>
									<?php if ($this->db->field_exists('sponser', 'memberships')) {?>
									<div class="col-lg-2 col-md-2 col-sm-2">
									<select name="sponsered" id="sponsered" class="form-control" style="margin:10px 0;">
									<option value="">Sponser</option>
									<?php 
									foreach ($sponsers as $sponser){
									?>
                                  	<option value="<?php echo $sponser['name'];?>"><?php echo $sponser['name'];?></option>
									<?php 
									}
									?>
									</select>
        							</div>
									<?php } ?>
        							<div class="col-lg-2 col-md-2 col-sm-2">
            							<input type="date" class="form-control" value="<?php if(isset($datef)){echo $datef;}?>" title="Date From"  name="datef" style="margin:10px 0;">
            							<?php echo form_error('datef', '<div class="error">', '</div>'); ?>
        							</div>
        							<div class="col-lg-2 col-md-2 col-sm-2">
            							<input type="date" class="form-control" value="<?php if(isset($datet)){echo $datet;}?>" title="Date To"  name="datet" style="margin:10px 0;">
            							<?php echo form_error('datet', '<div class="error">', '</div>'); ?>
        							</div>
        							<div class="col-lg-1 col-md-1 col-sm-1 mt-3">
            							<button type="submit" class="btn btn-outline-secondary" name="serch" value="serch" title="Search"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
        							</div>
    							</div>
							</form>
                        </div>
                    </div>
                    <div class="table-responsive" id="printer">
                        <table>
                            <thead>
                                <tr>
                                    <th>S. No</th>
                                    <th>Membership ID</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Referral Code</th>
                                    <th>Referred By</th>
                                    <th>Membership Date</th>
                                	<th>VIP/Sponsor</th>
									<?php if ($this->db->field_exists('sponser', 'memberships')) {?><th>Sponsor</th><?php } ?>
                                	<th>Bill No</th>
                                	<th>Pooja Date</th>
                                	<th>Download Certificate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($memberships): ?>
                                    <?php 
                                    $serial_number = 1; // Initialize serial number
                                    foreach ($memberships as $membership): ?>
                                        <tr>
                                            <td><?php echo $serial_number++; ?></td>
                                            <td> <strong class="text-orange"> <?php echo $membership->membership_id; ?> </strong> </td>
                                            <td><?php echo $membership->name; ?> <?php if ($this->db->field_exists('purpose', 'memberships')) { if($membership->purpose!='') { ?> - <strong class="text-orange"> Purpose <?php echo $membership->purpose; ?> </strong><?php } } ?></td>
                                            <td><?php echo $membership->mobile_number; ?></td>
                                            <td><?php echo $membership->referral_code; ?></td>
                                            <td><?php echo $membership->referred_by; ?></td>
                                            <td><?php echo date('d M Y', strtotime($membership->created_at)); ?></td>
                                        	<td><?php echo $membership->mode ?? ''; ?></td>
											<?php if ($this->db->field_exists('sponser', 'memberships')) {?><td><?php echo $membership->sponser ?? ''; ?></td><?php } ?>
                                        	<td> <strong class="text-orange">Bill - <?php echo $membership->bill_no ?? ''; ?> </strong></td>
                                        	<td><?php echo date('d M Y', strtotime($membership->pooja_date)) ?? ''; ?></td>
                                        	<td>
    											<a href="<?php echo base_url(); ?>index.php/membership/membership_report_print/<?php echo $membership->membership_id; ?>" target="_blank">
        											<button>Download</button>
    											</a>
											</td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">No membership data found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
</body>
</html>
