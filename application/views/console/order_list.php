<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Shopping Basket"></i>
					<div class="content">
						商品訂單設置
						<div class="sub header">可針對商品訂單做修改。</div>
					</div>
				</h2>
				<div class="ui form tableform">
					<a href="index.php/console/order/insert" class="ui tiny blue button spBtn btnInsert">新增(測試用)</a>
					<div class="field">
						<table class="ui celled padded table">
							<thead>
								<tr class="center aligned">
									<th>編號</th>
									<th>姓名</th>
									<th>訂單狀態</th>
									<th>總額</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $value) { ?>
								<tr class="center aligned">
									<td><?=$value['buy_id'];?></td>
									<td><?=$value['buy_name'];?></td>
									<td><?php if($value['status'] == 0)  { ?>
											等待付款
										<?php }else if($value['status'] == 1){ ?>
											完成付款
										<?php }else if($value['status'] == 2){ ?>
											運送處理
										<?php }else if($value['status'] == 3){ ?>
											完成訂單
										<?php }else { ?>
											發生錯誤
										<?php } ?>
									</td>
									<td><?=$value['total'];?></td>
									<td>
										<a href="index.php/console/order/details/<?=$value['id']?>" class="ui tiny green button spBtn">查看訂單</a>
										<a href="javascript: void(0)" class="ui tiny red button spBtn btnDelete" data-id="<?=$value['id'];?>">刪除(測試用)</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="5">
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

<div class="ui basic modal removeModal" id="removeModal">
	<i class="icon close"></i>
	<div class="header">
		注意
	</div>
	<div class="image content">
		<div class="image">
			<i class="icon Shopping Basket"></i>
		</div>
		<div class="description">
			<p>確認是否真的要刪除？</p>
		</div>
	</div>
	<div class="actions">
		<div class="two fluid ui inverted buttons">
			<div class="ui ok green basic inverted button">
				<i class="icon checkmark"></i>確認
			</div>
			<div class="ui cancel red basic inverted button">
				<i class="icon remove"></i>取消
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		remove();
	});

	function remove() {
		$('.btnDelete').on('click', function(e) {
			e.preventDefault();

			var that = $(this);
			var modal = $('#removeModal');
			var id = that.data('id');

			modal.modal({
				closable: false,
				onDeny: function() {
					// 取消
				},
				onApprove: function() {
					var api = 'index.php/api_console/delete_order';
					$.post(api, {'id': id}, function(response) {
						window.alert(response.sys_msg);
						if(response.sys_code == 200) {
							location.href = 'index.php/console/order';
						}
					}, 'json');
				}
			}).modal('show');
		});
	}
</script>