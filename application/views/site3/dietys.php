<?php 
$site_settings=$this->site_model->settings();
$asideimage=$site_settings['asideimage'];
$videolink=$site_settings['video_link'];
$smbanner=$site_settings['small_banner'];
?>
    <section class="slide_part">
      <div class="container">
        <div class="row">
          <div class='col-md-12'>
            <div class='homeslider'>
                <img class='img-fluid maxheight' title='' alt='' src='<?php echo $smbanner ?>'> 
            </div>
          </div>
        </div>  
      </div>
    </section>
    
    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-9">
              <div class="home_main_block">
                <div class='inner_pak'>
                  <div class='row'>
                    <div class='col-md-12'>
                    <?php 
                    $a=$this->db->query("SELECT id,name From diety WHERE online=1 ORDER BY order_ ASC ");
                    $diety_id=$a->result_array();
                    foreach ($diety_id as $id){
                        $diety=$id['name'];
                        $id=$id['id'];
                        $this->db->select('diety_pooja.*,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt');
                        $this->db->from('diety_pooja');
                        $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
                        $this->db->where('diety_pooja.temple_id', $id);
                        $query = $this->db->get()->result_array();
                        
                        if(count($query)>0){
                    ?>
                  <div class='pooja_sub showSingle'> <?php echo $diety;?> </div>
                  <div class='pooja_ctbook'>
                    <table class='pooja_list table table-hover' width='100%' border='0' cellspacing='0' cellpadding='0'>
                      <tbody>
                        <?php
                        foreach($query as $val){ 
                            ?>
                            <tr>
                              <td><?php echo $val['pooja_nm'];?></td>
                              <td align='center'>Rs <?php echo $val['pooja_rt'];?></td>
                            </tr>
                            <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                    <?php
                    }
                    }
                    ?>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
        <!-- ASIDE START-->
        <?php $this->load->view('site3/layouts/aside'); ?>   
        <!-- ASIDE END-->
          </div>
        </div>
      </div>
    </section>  

    <div class="clearfix"></div>