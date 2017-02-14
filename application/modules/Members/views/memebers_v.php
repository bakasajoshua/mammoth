
<!-- Default box -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Title</h3>
  </div>
  <div class="box-body">
    <table id="example" class="display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Created By</th>
          <th>Creators Email</th>
          <th>Status</th>
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
<script type="text/javascript">
  $startProjectPage = "<?= @base_url('members/');?>"
</script>
<!-- <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
<?= $this->load->view('members_v_footer'); ?>