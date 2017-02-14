<script type="text/javascript">
	$().ready(function() {
		
		$(".button").click(function() {
			rep_id = $(this).val();
			console.log(rep_id);
			$(".box-body").empty().load("<?= @base_url('members/get_write_page'); ?>/"+rep_id);
		});
		// $('#example').DataTable();
	});
</script>