<ul class="tp_tab">
    <li><a href="<?php echo base_url();?>admin/admin/category_view" <?php if($active=="1"){ echo 'class="active"';}?>><i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;Category </a></li>
    <li><a href="<?php echo base_url();?>admin/admin/subcategory_view" <?php if($active=="2"){ echo 'class="active"';}?>><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Sub Category </a></li>
    <li><a href="<?php echo base_url();?>admin/admin/unit_view" <?php if($active=="3"){ echo 'class="active"';}?>><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;Unit</a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/admin/state_view" <?php if($active=="4"){ echo 'class="active"';}?>><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;&nbsp;State </a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/admin/district_view" <?php if($active=="5"){ echo 'class="active"';}?>><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;District </a></li>
    <li><a href="<?php echo base_url();?>index.php/admin/admin/pincode_view" <?php if($active=="6"){ echo 'class="active"';}?>><i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp;&nbsp;Pincode </a></li>
</ul>