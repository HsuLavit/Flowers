<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Add User"></i>
					<div class="content">
						新增會員
						<div class="sub header">可針對會員做新增</div>
					</div>
				</h2>
				<?php if(isset($sys_code)) { ?>
					<div class="ui bottom attached warning message">
						<i class="icon warning"></i>
						<?=$sys_msg; ?>
					</div>
					<?php } ?>
				<form class="ui form tableform" method="post">
					<h4 class="ui dividing header">Login Part</h4>
					<input type="hidden" name="rule" value="insert">
					<div class="field required">
						<label>帳號 Email</label>
						<input type="text" name="email">
					</div>
					<div class="field required">
						<label>密碼</label>
						<input type="password" name="password">
					</div>
					<div class="field required">
						<label>請再輸入一次密碼</label>
						<input type="password" name="confirmPassword">
					</div>
					<h4 class="ui dividing header">Member Information</h4>
					<div class="two fields">
						<div class="field required">
							<label>暱稱</label>
							<input type="text" name="nickname">
						</div>
						<div class="field">
							<label>手機</label>
							<input type="text" name="phone">
						</div>
					</div>
					<div class="field">
							<label>地址</label>
							<input type="text" name="address">
					</div>
					<button class="ui green button" type="submit" tabindex="0">送出</button>
				</form>
			</div>
		</div>
	</div>
</div>