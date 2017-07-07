<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Check Square"></i>
					<div class="content">
						更新會員
						<div class="sub header">可針對會員做更新</div>
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
					<input type="hidden" name="rule" value="update">
					<input type="hidden" name="id" value="<?=$res['id'];?>">
					<div class="field required">
						<label>帳號 Email</label>
						<input type="text" name="email" value="<?=$res['email'];?>">
					</div>
					<div class="field">
						<label>密碼</label>
						<input type="password" name="password">
					</div>
					<div class="field">
						<label>請再輸入一次密碼</label>
						<input type="password" name="confirmPassword">
					</div>
					<h4 class="ui dividing header">Member Information</h4>
					<div class="two fields">
						<div class="field required">
							<label>暱稱</label>
							<input type="text" name="nickname" value="<?=$res['nickname'];?>">
						</div>
						<div class="field">
							<label>手機</label>
							<input type="text" name="phone" value="<?=$res['phone'];?>">
						</div>
					</div>
					<div class="field">
							<label>地址</label>
							<input type="text" name="address" value="<?=$res['address'];?>">
					</div>
					<button class="ui primary button" type="submit" tabindex="0">送出</button>
					<a class="ui button" href="index.php/console/member/">取消</a>
				</form>
			</div>
		</div>
	</div>
</div>