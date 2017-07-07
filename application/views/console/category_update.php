<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Check Square"></i>
					<div class="content">
						更新分類
						<div class="sub header">可針對分類做更新</div>
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
					<input type="hidden" name="rule" value="update">
					<input type="hidden" name="id" value="<?=$res['id'];?>">
					<div class="field required">
						<label>分類Category</label>
						<input type="text" name="type" value="<?=$res['type'];?>">
					</div>
					<button class="ui primary button" type="submit" tabindex="0">送出</button>
					<a class="ui button" href="index.php/console/category/">取消</a>
				</form>
			</div>
		</div>
	</div>
</div>