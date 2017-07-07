<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Add User"></i>
					<div class="content">
						新增留言
						<div class="sub header">測試用</div>
					</div>
				</h2>
				<?php if(isset($sys_code)) { ?>
					<div class="ui bottom attached warning message">
						<i class="icon warning"></i>
						<?=$sys_msg; ?>
					</div>
					<?php } ?>
				<form class="ui form tableform" method="post">
					<h4 class="ui dividing header">Basic</h4>
					<input type="hidden" name="rule" value="insert">
					<div class="three fields">
						<div class="field">
							<label>姓名</label>
							<input type="text" name="name">
						</div>
						<div class="field">
							<label>Email</label>
							<input type="text" name="email">
						</div>
						<div class="field">
							<label>連絡電話</label>
							<input type="text" name="phone">
						</div>
					</div>
					<div class="field">
						<label>想跟我們說些什麼？</label>
						<textarea type="text" name="message"></textarea>
					</div>
					<button class="ui green button" type="submit" tabindex="0">送出</button>
					<a class="ui button" href="index.php/console/contact/">取消</a>
				</form>
			</div>
		</div>
	</div>
</div>