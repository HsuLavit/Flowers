<div class="ad-slider">
	<div class="unslider-images">
		<ul class="slider-images">
			<li class="image" style="background-image: url(assets/img/IMG_3499.JPG)"></li>
			<li class="image" style="background-image: url(assets/img/IMG_3497.JPG)"></li>
			<li class="image" style="background-image: url(assets/img/IMG_3681.JPG)"></li>
			<li class="image" style="background-image: url(assets/img/IMG_3724.JPG)"></li>
		</ul>
	</div>
</div>


<div class="feature-product">
	<div class="title-spec">
		<h2 class="ui header">
			<i class="icon star"></i>
			<div class="content">
				New Arrivals
				<div class="sub header">
					新品上市
				</div>
			</div>
		</h2>
	</div>
	<div class="product-spec">
		<div class="ui five column grid">
		<?php foreach ($feature as $key => $value) { ?>
			<div class="column">
				<div class="ui fluid card">
					<a href="index.php/product/<?=$value['id'];?>" class="image">
						<img style="background-image: url(<?=$value['main_photo'];?>)">
					</a>
					<div class="content">
						<a href="index.php/product/<?=$value['id'];?>"><?=$value['title'];?></a>
						<span class="price">$ <?=$value['price'];?></span>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.unslider-images').unslider({
			autoplay: true,
			delay: 10000,  // 10s
			arrows: {
				prev: '<a class="unslider-arrow prev"><i class="icon chevron left"></i></a>',
				next: '<a class="unslider-arrow next"><i class="icon chevron right"></i></a>',
			}
		});
	});
</script>

