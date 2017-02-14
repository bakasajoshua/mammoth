<?php //echo "<pre>";print_r($report_data);exit; ?>
<!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Report details</h3>

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
                <?php //echo form_open('Manager/review_report'); ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Report title</label>
                      <?php if (isset($report_data['title'])&& $report_data['title']!='') { ?>
                        <input type="text" class="form-control" name="title" value="<?php echo $report_data['title']; ?>" placeholder="Enter title">
                      <?php }else{ ?>
                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="">Description</label>
                      <?php if (isset($report_data['desc'])&& $report_data['desc']!='') { ?>
                        <input type="text" class="form-control" name="desc" value="<?php echo $report_data['desc']; ?>" placeholder="Description">
                      <?php }else{ ?>
                        <input type="text" class="form-control" name="desc" placeholder="Description">
                      <?php } ?>
                    </div>

                    <div class="form-group">
                      <label for="">Deadline date</label>
                      <?php if (isset($report_data['deadline'])&& $report_data['deadline']!='') { ?>
                        <input type="date" class="form-control" name="deadline" value="<?php echo $report_data['deadline']; ?>" placeholder="Deadline">
                      <?php }else{ ?>
                        <input type="date" class="form-control" name="deadline" placeholder="Deadline">
                      <?php } ?>
                    </div>
                </div>
              </div>
              </div>
              </div>

               <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Report Content</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

                        <div class="form-group">
                        <label for="">Written by: </label>
                        <?php if (isset($report_data['writer_name'])&& $report_data['writer_name']!='') { ?>
                          <input type="text" class="form-control" name="writer_name" value="<?php echo $report_data['writer_name']; ?>" placeholder="Fullname">
                        <?php }else{ ?>
                          <input type="text" class="form-control" name="writer_name" value="<?php echo $report_data['writer_name']; ?>" placeholder="Fullname">
                        <?php } ?>
                      </div>
                        <div class="form-group">
                        <label for="">Email: </label>
                        <?php if (isset($report_data['writer_email'])&& $report_data['writer_email']!='') { ?>
                          <input type="text" class="form-control" name="writer_email" value="<?php echo $report_data['writer_email']; ?>" placeholder="Enail">
                        <?php }else{ ?>
                          <input type="text" class="form-control" name="writer_email" value="<?php echo $report_data['writer_email']; ?>" placeholder="Enail">
                        <?php } ?>
                      </div>
                    <div class="form-group">
                      <label for="">Report content</label>
                      <?php if (isset($report_data['content'])&& $report_data['content']!='') { ?>
                        <textarea type="text" disabled="disabled" class="form-control" name="content" value="<?php echo $report_data['content']; ?>" placeholder="Content"><?php echo $report_data['content']; ?></textarea>
                      <?php }else{ ?>
                        <textarea type="text" class="form-control" name="content" placeholder="Content"></textarea>
                      <?php } ?>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <!-- <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div> -->
                <?php //echo form_close(); ?>
          </div>
        </div>
      
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->