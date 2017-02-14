<!-- Default box -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Title</h3>
  </div>
  <div class="box-body">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Created By</th>
          <th>Creators Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?= @$active_reports; ?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
  Footer
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
<?= $this->load->view('members_v_footer'); ?>