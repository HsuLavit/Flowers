<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Pagelines"></i>
					<div class="content">
						本月熱銷商品
						<div class="sub header">下列為銷售筆數排行</div>
					</div>
				</h2>
				<div class="ui form tableform">
					<div class="field">
						<table class="ui celled padded table">
							<thead>
								<tr class="center aligned">
									<th>商品</th>
									<th>銷售筆數</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $value) { ?>
								<tr class="center aligned">
									<td><?=$value['Product_name'];?></td>
									<td><?=$value['count(*)'];?></td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="2">
										<?=$pagination;?>
									</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>