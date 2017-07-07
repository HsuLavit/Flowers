<div class="contentSpec">
	<div class="ui container containerSpec">
		<div class="ui grid">
			<div class="sixteen wide column">
				<h2 class="ui dividing header">
					<i class="icon Comments"></i>
					<div class="content">
						聯絡設置
						<div class="sub header">可針對聯絡做查看。</div>
					</div>
				</h2>
				<div class="ui form tableform">
				<a href="index.php/console/contact/insert" class="ui tiny blue button spBtn btnInsert">新增 測試用</a>
					<div class="field">
						<table class="ui celled padded table">
							<thead>
								<tr class="center aligned">
									<th>編號</th>
									<th>姓名</th>
									<th>信箱</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $value) { ?>
								<tr class="center aligned">
									<td><?=$value['id'];?></td>
									<td><?=$value['name'];?></td>
									<td><?=$value['email'];?></td>
									<td>
										<a href="index.php/console/contact/details/<?=$value['id']?>" class="ui tiny green button spBtn">查看內容</a>
										<a href="javascript: void(0)" class="ui tiny red button spBtn btnDelete" data-id="<?=$value['id'];?>">刪除</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="4">
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
			<i class="icon Browser"></i>
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
					var api = 'index.php/api_console/delete_contact';
					$.post(api, {'id': id}, function(response) {
						window.alert(response.sys_msg);
						if(response.sys_code == 200) {
							location.href = 'index.php/console/contact';
						}
					}, 'json');
				}
			}).modal('show');
		});
	}
</script>