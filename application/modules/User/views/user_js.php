<script type="text/javascript">
	$(document).ready(function(){
		if($('table')[0]){
			$('table').dataTable();
		}

		if($('select[name="department"]')[0]){
			$.get('<?= @base_url('User/getDepartments'); ?>', function(data){
				$('select[name="department"]').select2({
					data: data
				});
			});
		}

		if($('select[name="access_level"]')[0]){
			$.get('<?= @base_url('User/getAccessLevels'); ?>', function(data){
				$('select[name="access_level"]').select2({
					data: data
				});
			});
		}
	});
</script>