<?php
/**
 * Module Our Recipients Section
 *
 * @link        https: //developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     bvbj
 * @subpackage  Modules
 * @author      Very LLC - Andres Posada
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

$acfDBOR = [
	'heading'   => get_sub_field('heading'),
]; ?>

<!-- Begin Our Recipients Section -->
<section class="d-flex -items-center -row -wrap -justify-normal d-section our-recipients">
	<div class="container">

		<?php if ($acfDBOR['heading']): ?>
			<div class="heading">
				<p>
					<?php print $acfDBOR['heading']; ?>
				</p>
			</div>
		<?php endif; ?>


		<div class="wrapper">
			<div class="carouselrrr">
				<div>
					<a data-fancybox data-src="#modal1" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+1">
					</a>
					<div style="display: none;" id="modal1">
						<h2>Hello! #1</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal2" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+2">
					</a>
					<div style="display: none;" id="modal2">
						<h2>Hello! #2</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal3" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+3">
					</a>
					<div style="display: none;" id="modal3">
						<h2>Hello! #3</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal4" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+4">
					</a>
					<div style="display: none;" id="modal4">
						<h2>Hello! #4</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal5" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+5">
					</a>
					<div style="display: none;" id="modal5">
						<h2>Hello! #5</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal6" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+6">
					</a>
					<div style="display: none;" id="modal6">
						<h2>Hello! #6</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal7" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+7">
					</a>
					<div style="display: none;" id="modal7">
						<h2>Hello! #7</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal8" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+8">
					</a>
					<div style="display: none;" id="modal8">
						<h2>Hello! #8</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal9" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+9">
					</a>
					<div style="display: none;" id="modal9">
						<h2>Hello! #9</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal10" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+10">
					</a>
					<div style="display: none;" id="modal10">
						<h2>Hello! #10</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal11" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+11">
					</a>
					<div style="display: none;" id="modal11">
						<h2>Hello! #11</h2>
						<p>You are awesome!</p>
					</div>
				</div>
				<div>
					<a data-fancybox data-src="#modal12" href="javascript:;" class="btn btn-primary">
						<img src="https://via.placeholder.com/140x140?text=Image+12">
					</a>
					<div style="display: none;" id="modal12">
						<h2>Hello! #12</h2>
						<p>You are awesome!</p>
					</div>
				</div>
			</div>
		</div>



	</div>
</section>
<!-- End Our Recipients Section -->
