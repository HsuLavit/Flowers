<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Check Square"></i>
					<div class="content">
						詳細聯絡狀況
						<div class="sub header">可查看詳細聯絡狀況</div>
					</div>
				</h2>
				<?php if(isset($sys_code)) { ?>
					<div class="ui bottom attached warning message">
						<i class="icon warning"></i>
						<?=$sys_msg; ?>
					</div>
					<?php } ?>
				<form class="ui form tableform" method="post">
					<h4 class="ui dividing header">個人資訊</h4>
					<div class="three fields">
						<div class="field">
							<label>姓名</label>
							<input type="text" disabled name="name" value="<?=$res['name'];?>">
						</div>
						<div class="field">
							<label>手機</label>
							<input type="text" disabled name="phone" value="<?=$res['phone'];?>">
						</div>
						<div class="field">
							<label>信箱</label>
							<input type="text" disabled name="email" value="<?=$res['email'];?>">
						</div>
					</div>
					<div class="field">
						<label>訊息</label>
						<textarea disabled><?=$res['message'];?></textarea>
					</div>
					<a class="ui button" href="index.php/console/contact/">返回</a>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.ui.dropdown.dropdownStatus').dropdown('set selected', '<?=$res['status'];?>');

	});
</script>