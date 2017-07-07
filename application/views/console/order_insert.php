<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Check Square"></i>
					<div class="content">
						可增加一筆訂單 
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
					<h4 class="ui dividing header">個人資訊</h4>
					<input type="hidden" name="rule" value="insert">
					<div class="three fields">
						<div class="field">
							<label>姓名</label>
							<input type="text" name="buy_name">
						</div>
						<div class="field">
							<label>連絡電話</label>
							<input type="text" name="buy_phone">
						</div>
						<div class="field">
							<label>信箱</label>
							<input type="text" name="buy_email">
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>地址</label>
							<input type="text" name="buy_addr">
						</div>
						<div class="field">
							<label>買家編號</label>
							<input type="text" name="buy_id">
						</div>
						<div class="field">
							<label>訂單狀態</label>
							<div class="field">
								<div class="ui fluid search selection dropdown">
									<input type="hidden" disabled name="status">
									<i class="dropdwon icon"></i>
									<div class="default text">未設定</div>
								</div>
							</div>
						</div>
					</div>
					<div class="field">
						<label>買家備註</label>
						<input type="text" name="buy_remark">
					</div>
					
					<button class="ui primary button" type="submit" tabindex="0">送出</button>
					<a class="ui button" href="index.php/console/order/">取消</a>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

	});
</script>