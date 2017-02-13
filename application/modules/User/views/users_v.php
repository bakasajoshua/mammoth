<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">User List</h3>
		<div class="pull-right"><a class = 'btn btn-success btn-sm' href = '<?= @base_url('User/add'); ?>'><i class="fa fa-credit-card"></i> Add User</a></div>
	</div>
	<div class="box-body">
		<?= @$usersTable; ?>
	</div>
</div>