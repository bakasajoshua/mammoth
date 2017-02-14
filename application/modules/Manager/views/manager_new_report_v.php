<?php //echo "<pre>";print_r($update);exit; ?>
<!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create Report</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-12">
                <!-- form start -->
                <?php echo form_open('Manager/save_report'); ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Report title</label>
                      <?php if (isset($update['title'])&& $update['title']!='') { ?>
                        <input type="hidden" name="uuid" value="<?php echo $update['uuid']; ?>">
                        <input type="text" class="form-control" name="title" value="<?php echo $update['title']; ?>" placeholder="Enter title">
                      <?php }else{ ?>
                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="">Description</label>
                      <?php if (isset($update['desc'])&& $update['desc']!='') { ?>
                        <input type="text" class="form-control" name="desc" value="<?php echo $update['desc']; ?>" placeholder="Description">
                      <?php }else{ ?>
                        <input type="text" class="form-control" name="desc" placeholder="Description">
                      <?php } ?>
                    </div>

                    <div class="form-group">
                      <label for="">Deadline date</label>
                      <?php if (isset($update['deadline'])&& $update['deadline']!='') { ?>
                        <input type="date" class="form-control" name="deadline" value="<?php echo $update['deadline']; ?>" placeholder="Deadline">
                      <?php }else{ ?>
                        <input type="date" class="form-control" name="deadline" placeholder="Deadline">
                      <?php } ?>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                <?php echo form_close(); ?>
          </div>
        </div>
      
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->