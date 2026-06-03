<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
    //<![CDATA[
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    //]]>
</script>

<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
            <h2 class="page_txt"> Image Category </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
            <ul class="btn_ul" style="float:right;">
                <li>
                    <a href="<?php echo base_url();?>index.php/cms/viewImageCategories" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 ">         
            <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit Image Category </h2>
                    </div>
                </div>
            
                <form action="<?php echo base_url();?>index.php/cms/editImageCategory/<?php echo $category->id; ?>" method="post">
                    <div class="form_body">
                        <div class="row">
                        	<div class="col-md-6 row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="div_label">
                                        <label class="text_label">Category <span class="red"></span></label>
                                    </div>
                                    <input class="sq_form" placeholder="Category" name="category" type="text" value="<?php echo $category->name; ?>">
                                    <?php echo form_error('category', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success pull-right" style="margin-top:7px;">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        	</div>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>
