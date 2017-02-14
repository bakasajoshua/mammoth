<div class="box">
  <div class="box-header">
    <h3 class="box-title">Report List</h3>
    <div class="pull-right">
      <a href="<?php echo base_url().'Manager/create_report'; ?>" class="btn btn-primary">Create Report</a>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">
  <div class="col-md-12 clearfix">
    <table id="datatable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Date published</th>
          <th>Title</th>
          <th>Description</th>
          <th>Deadline</th>
          <th>Days to deadline</th>
          <th>Status</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($report_data as $key => $value): ?>
        <tr>
          <td><?php echo date('Y-M-d', strtotime($value['created_at'])); ?></td>
          <td><?php echo $value['title']; ?></td>
          <td><?php echo $value['desc']; ?></td>
          <td><?php echo date('Y-M-d', strtotime($value['deadline'])); ?></td>
          <td><?php 
                $formatted = date('Y-m-d',strtotime($value['deadline']));
                $today = new DateTime();
                $due_date = new DateTime($formatted);
                echo date_diff($today,$due_date)->format("%R%a days"); 
                ?></td>
          <td>
            <?php 
              $status = $value['status_desc']; 
              if ($status =="Pending") {
                echo '<span class="label label-warning">'.$status.'</span>';
              }else if ($status =="Ongoing") {
                echo '<span class="label label-primary">'.$status.'</span>';
              }else if ($status =="Accepted") {
                echo '<span class="label label-success">'.$status.'</span>';
              }else if ($status =="Rejected") {
                echo '<span class="label label-danger">'.$status.'</span>';
              }
              ?>
                  
          </td>
          <td>
          <a href="<?php echo base_url().'Manager/view_report/'.$value['uuid']; ?>" class=""><span class="fa fa-eye"></span> View</a>
          </td>
          <td>
          <a href="<?php echo base_url().'Manager/edit_report/'.$value['uuid']; ?>" class=""><span class="fa fa-pencil"></span> Edit</a>
          </td>
          <td>
          <a href="<?php echo base_url().'Manager/delete_report/'.$value['uuid']; ?>" class="label label-danger"><span class="fa fa-trash-o"></span> Delete</a>
          </td>
        </tr>
      <?php endforeach ?>
      </tbody>
      </table>
      </div>
        </div><!-- /.box -->
</div>
