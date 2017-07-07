<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Add User"></i>
					<div class="content">
						新增商品分類
						<div class="sub header">可針對商品分類做新增</div>
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
					<div class="field required">
						<label>分類Category</label>
						<input type="text" name="type">
					</div>
					<button class="ui green button" type="submit" tabindex="0">送出</button>
				</form>
			</div>
		</div>
	</div>
</div>