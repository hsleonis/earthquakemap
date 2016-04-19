<?php
/**
 * Template Name: Search [English]
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main search-function-wrapper" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

			<div class="share-buttons">
				<?php echo do_shortcode('[addtoany]' ); ?>
			</div>
			<div class="search-func-container">
				<form action="<?php echo get_the_permalink(); ?>" id="EQSIM">
					

					<div class="input-search-func">
						<p>
							こちらの情報は、被災者の方にスピーディに情報をお届けするため、運営の方で確認しておりません。必ずご自身の責任のもと、住居提供者と連絡を取ってください。<br>
							弊社では、住居提供時にトラブルが発生しても責任は負いかねます。<br>
							誤登録、誰かが勝手に申請して掲載されてるなど場合は、<a href="mailto:kanae@samepagenet.com">kanae@samepagenet.com</a>までお知らせ下さい。削除の対応をさせて頂きます。
						</p>
						
					</div>
					<div class="input-search-func">
						<?php
						$categories = get_terms( 'place_category', array( 'hide_empty' => 0 ) );
						foreach($categories as $category){
							$checked = "";
							if(isset($_GET['filter']) && is_array($_GET['filter'])){
								if(in_array($category->slug, $_GET['filter'])){
									$checked = 'checked="echecked"';
								}
							}
						?>
						<div class="check-field">
							<label for="place_category-<?php echo $category->term_id; ?>" class="check-label">
								<input type="checkbox" value="<?php echo $category->slug; ?>" name="filter[]" class="place_category" id="place_category-<?php echo $category->term_id; ?>" <?php echo $checked; ?>><?php echo $category->name; ?>
							</label>
						</div>
						<?php } ?>
						<input type="submit" value="Filter">
						<p>
						チェックボックスにチェックを入れた後にFILTERをクリックすると、チェックボックスにチェックを入れたものだけ、表示されます。<br>
						</p>
					</div><!-- checkbox-field -->
					<?php
					
					$eqspArgs = array(
							"post_type" => "support_place",
							"post_status" => "publish",
							"posts_per_page" => -1,
					);
					if(isset($_GET['filter']) && is_array($_GET['filter'])){
						$eqspArgs['tax_query'] = array(
									//'relation' => 'AND',
									array(
											'taxonomy' => 'place_category',
											'field'    => 'slug',
											'terms'    => $_GET['filter'],
									),
							);
					}
					$eqsp = get_posts($eqspArgs);
					if(count($eqsp) > 0){
						$place_title = "";
						$markers = "";
						$cluster = array(
								'center' => array('33.158051','130.394586'),
								'zoom'   => 8,
						);
						foreach($eqsp as $place){
							$latlng = get_post_meta($place->ID, EQCMB.'marker_latlng', true);
							$latlng = str_replace(' ', '', $latlng);
							$tmp = explode(',', $latlng);
							$submittedBy = get_post_meta($place->ID, EQCMB.'submitter_name', true);
							$submittedBy = ($submittedBy)? "<p>Submitted By $submittedBy</p>" : "";
							
							$address = get_post_meta($place->ID, EQCMB.'address', true);
							$address = ($address)? "<p>Address: $address</p>" : "";
							
							$phone = get_post_meta($place->ID, EQCMB.'submitter_phone', true);
							$phone = ($phone)? "<p>Phone: <a href=\"tel:$phone\">$phone</a></p>" : "";
							
							$email = get_post_meta($place->ID, EQCMB.'submitter_email', true);
							$email = ($email)? "<p>Email: <a href=\"mailto:$email\">$email</a></p>" : "";
							$reservation = get_post_meta($place->ID, EQCMB.'ref_url', true);
							$target = ($reservation)? 'target="_blank"' : "";
							$reservation = ($reservation)? $reservation : "#";
							
							$category = get_the_terms($place->ID, 'place_category');
							$icon = get_term_meta( $category[0]->term_id, EQCMB.'marker_icon', true );
							
							$place_title .= '<li><a href="'.$reservation.'" '.$target.'>'.$place->post_title.'</a></li>'.PHP_EOL;
							$markers .= '<div
					data-latlng="'.$latlng.'"
					data-marker-image="'.$icon.'"
					data-title="'.$place->post_title.'"><div id="place-'.$place->ID.'">
					<h3><a href="'.$reservation.'" '.$target.'>'.$place->post_title.'</a></h3>
					'. wpautop($place->post_content) .'
					'.$address.'
					'.$submittedBy.'
					'.$phone.'
					'.$email.'
					</div></div>';
							$cluster['places'][] = array(
									'id'        => $place->ID,
									'title'     => $place->post_title,
									'latitude'  => $tmp[0],
									'longitude' => $tmp[1],
									'icon'      => $icon,
									'infobox'   => '<div id="place-'.$place->ID.'"><h3><a href="'.$reservation.'" '.$target.'>'.$place->post_title.'</a></h3>'. wpautop($place->post_content) . $address . $submittedBy . $phone . $email.'</div>',
							);
						}
					?>
					<div class="input-search-func">
						<script type="application/json" id="esimcData"><?php echo json_encode($cluster); ?></script>
						<div class="map-container" id="esimc"></div>
					</div>
					<?php /*
					<div class="input-search-func">
						<div class="axgmap map-container" data-latlng="33.158051,130.394586" data-zoom="8">
							<?php echo $markers; ?>
						</div>
					</div>
					*/ ?>
					
					<div class="input-search-func">
						<div class="text-listing">
							<ul>
								<?php echo $place_title; ?>
							</ul>	
						</div>
					</div>
					<?php
					}
					?>
					<?php echo do_shortcode('[addtoany]' ); ?>
				</form>
				
			</div><!-- .search-func-form -->

			<!-- <div class="social-box">
				<h4>Twitter</h4>
				<a class="twitter-timeline" href="https://twitter.com/hashtag/socialninja" data-widget-id="721624779174752256">#socialninja Tweets</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div> -->
			
		

			<div id="references">
				<div class="staff-container">
				<p>
						参考サイト<br>
						【熊本地震支援情報】お風呂開放場所など※随時更新 - 東京はなれてまったりと <a href="http://sayurice.hatenadiary.com/entry/2016/04/16/102328" target="_blank">http://sayurice.hatenadiary.com/entry/2016/04/16/102328</a>
						</p>
						<p>
						熊本地震 情報掲示板 <a href="http://kumamoto-jishin.info/" target="_blank">http://kumamoto-jishin.info/</a>
						</p>
						<p>お疲れ様です。拡散してください｜☆春陽座☆かずまのブログだぁ☆☆ <a href="http://ameblo.jp/kazumanokeitai0221/entry-12150965567.html" target="_blank">http://ameblo.jp/kazumanokeitai0221/entry-12150965567.html</a>
						</p>
					<div class="staff-photo">
						<img src="<?php echo get_template_directory_uri(); ?>/img/takagi.jpg" alt="Takagi">
					</div>
					<div class="staff-message">
						<p>
						私たちは株式会社セームページ（代表取締役、高木）です<br>
						今回発生した熊本地震により熊本を中心に九州各地で多数の死者、行方不明者および被災者が出ております。
						</p>
						<p>
						また、弊社の現地社員およびその家族も被災をしたと話を聞いております。
						</p>
						<p>
						私たちは今回の現状を受け、現地の熊本を中心とした各県で被災者の方々を支援することができる情報の一元化をしようと考えております。<br>
						被災者の方々が一日も早く日常生活を取り戻すためには、多くの支援が必要です。
						</p>
						<p>

						皆さまからのご理解・ご協力をお願いいたします。<br>
						株式会社セームページ/SamePage Ltd. 代表取締役　高木昭博<br><br>
						<strong>SNS link</strong><br>
						Facebook <a href="https://www.facebook.com/whitebelt33" target="_blank">https://www.facebook.com/whitebelt33</a><br>
						Linkedin <a href="https://jp.linkedin.com/in/akihirotakagi" target="_blank">https://jp.linkedin.com/in/akihirotakagi</a><br>
						Twitter <a href="https://twitter.com/samepage33" target="_blank">https://twitter.com/samepage33</a>
						</p>
						<p>
						セームページ企業サイト　<a href="http://samepagenet.com/" target="_blank">http://samepagenet.com/</a>
						</p>
						<p>
						<a href="https://goo.gl/13qX35" target="_blank">プレスリリースはこちら</a>
						</p>
						
					</div>
					<h3><?php _e('ソーシャルニンジャ','twentysixteen'); ?></h3>
					<div class="staff-item">
						<div class="staff-photo">
							<img src="<?php echo get_template_directory_uri(); ?>/img/hasan.png" alt="Hasan">
						</div>
						<h5>Mhumudul Hasan</h5>
						<h6>Web Developer</h6>
					</div>
					<div class="staff-item">
						<div class="staff-photo">
							<img src="<?php echo get_template_directory_uri(); ?>/img/noimage.png" alt="Hasan">
						</div>
						<h5>David Borromeo</h5>
						<h6>Web Developer</h6>
					</div>
					<div class="staff-item">
						<div class="staff-photo">
							<img src="<?php echo get_template_directory_uri(); ?>/img/shahed.png" alt="Hasan">
						</div>
						<h5>Shahed Alam</h5>
						<h6>Sales</h6>
					</div>
					<div class="staff-item">
						<div class="staff-photo">
							<img src="<?php echo get_template_directory_uri(); ?>/img/noimage.png" alt="Hasan">
						</div>
						<h5>Takahashi Keita</h5>
					</div>
				</div>
					<div class="social-box">
				<h4>Facebook</h4>
				<div class="fb-page" data-href="https://www.facebook.com/samepageltd/" data-tabs="timeline" data-width="500px" data-height="250" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/samepageltd/"><a href="https://www.facebook.com/samepageltd/">Same Page Limited</a></blockquote></div></div>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=704111153005993";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
			</div>
			</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
	<script src="//j.wovn.io/1" data-wovnio="key=r_MhG" async></script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>