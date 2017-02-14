<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">
			Add User
		</h3>
	</div>
	<div class="box-body">
		<?= @form_open('User/completeReg'); ?>
			<div class="form-group">
				<label class="control-label">User's Fullname</label>
				<input type="text" name="user_fullname" class= "form-control" required>
			</div>

			<div class="form-group">
				<label class="control-label">User's Email Address</label>
				<input type="email" name="user_emailaddress" class= "form-control" required>
			</div>

			<div class="form-group">
				<label class="control-label">User's Department</label>
				<select name="department" class = "form-control" required>
					
				</select>
			</div>

			<div class="form-group">
				<label class="control-label">User's Access Level</label>
				<select name="access_level" class = "form-control" required>
					
				</select>
			</div>

			<button class = "btn btn-success">ADD USER</button>
		</form>
	</div>
</div>