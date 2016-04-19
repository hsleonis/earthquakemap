<?php
$base = energy_option('color_base');
$base_hsl = RGBToHSL($base);

$sub = energy_option('color_sub');
$sub_hsl = RGBToHSL($sub);
$btn_request = energy_option('request_icon');
$mail = energy_option('mail_icon');
?>

<style type="text/css">

<?php if($base != null): ?>
	.reason-sub,
	p strong,
	.pink,
	.base,
	.faq-circle,
	.news-title{
		color:<?php echo $base;  ?>!important;
	}

	a{
		color:<?php echo $base;  ?>;
	}

	.flow-item,
	.faq-circle,
	.faq-item,
	.news-items{
		border-color:<?php echo $base;  ?>!important;
	}

	.step-content,
	.faq-question,
	input[type="submit"],
	.btn-request,
	.goup,
	.mobile-trigger,
	.nav-previous a,
	.nav-next a,
	.flag-current,
	.flags a{

		background-color:<?php echo $base;  ?>!important;
		<?php if($base_hsl->lightness > 200): ?>
		color:#000;
		<?php else: ?>
		color:#fff;
		<?php endif; ?>
	}

	.double-border:after{
		border-color:<?php echo $base;  ?>!important;
		opacity:0.3;
	}

	.arrow-down,
	.btn-next:after{
		border-color: <?php echo $base;  ?> transparent transparent transparent !important;
	}
<?php endif; ?>

<?php if($sub != null): ?>

	.flow-item-green{
		border-color:<?php echo $sub;  ?>!important;
	}

	a:hover{
		color:<?php echo $sub;  ?>;
	}

	.flow-item-green .step-content,
	input[type="submit"]:hover,
	.btn-request:hover,
	.goup:hover{
		background-color:<?php echo $sub;  ?>!important;
		<?php if($sub_hsl->lightness > 200): ?>
		color:#000;
		<?php endif; ?>
	}

	.arrow-down-green{
		border-color: <?php echo $sub;  ?> transparent transparent transparent !important;
	}
<?php endif; ?>
<?php if($btn_request != null): ?>
	.btn-request{
		background-image:url('<?php echo $btn_request; ?>') !important;

	}
<?php endif; ?>

<?php if($mail != null): ?>
	.mail-link:before{
		background-image:url('<?php echo $mail; ?>') !important;
		background-size:contain !important;
		background-position:center !important;
	}
<?php endif; ?>
</style>

