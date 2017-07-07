<div class="headerSpec">
	<div class="center aligned headerLogo">
		<a href="index.php/console/index" class="itemLogo">花 譜</a>
	</div>
	<div class="headerMeun">
		<div class="headerRightMeun">
			<div class="ui dropdown itemDropdownPerson">
				<i class="icon user"></i>
				<?=$this->session->userdata('manager_name')?>
				<div class="menu">
					<a href="index.php/console/logout" class="item">管理員登出</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.itemDropdownPerson').dropdown();
	});
</script>