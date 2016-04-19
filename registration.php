<?php
/**
 * Template Name: Registration
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
		<main id="main" class="site-main" role="main">

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
		
			<div class="registration-container">
			<div class="share-buttons">
				<?php echo do_shortcode('[addtoany]' ); ?>
			</div>
				<?php
				if (session_id() == "")
					session_start();
					if(isset($_SESSION['place_submission_success'])){
				?>
				<div class="success">成功！</div>
				<?php
					}
					unset($_SESSION['place_submission_success']);
					if(isset($_SESSION['place_submission_error'])){
				?>
				<div class="warning">
					<?php
					
					foreach($_SESSION['place_submission_error'] as $error){
						if(is_array($error)){
							foreach($error as $k=>$v){
								echo "<p class=\"error error-$k\">$v</p>";
							}
						}else{
							echo "<p class=\"error\">$error</p>";
						}
					}
					//unset($_SESSION['place_submission_error']);
					?>
				</div>
				<?php
					}
				?>
				<p class="warning"><em><?php _e('※善意の利用方法を想定してますが、掲載することでインターネット上に公開されます。何かトラブルが合った際には弊社では責任が負いかねますので、ご了承下さい。',TextDomain); ?></em></p>
				<form action="<?php echo get_the_permalink(); ?>" method="POST" enctype="multipart/form-data">
					<div class="input-container">
						<label for="category" class="input-label">カテゴリ</label>

						<div class="input-field">
							<div class="pop-text">
								<?php _e('ご協力有難うございます！',TextDomain); ?>
							</div>
							<select name="category" id="category" required>
								<option selected="selected" disabled="disabled" readonly="readonly">カテゴリを選んで下さい</option>
								<?php
								$categories = get_terms( 'place_category', array( 'hide_empty' => 0 ) );
								foreach($categories as $category){
									echo "<option value=\"$category->name\">$category->name</option>";
								}
								?>
							</select>
						</div>
					</div>

					<div class="input-container">
						<label for="post_title" class="input-label">場所の名前</label>
						<div class="input-field">
							<div class="pop-text">その調子でよろしくお願いします</div>
							<input type="text" name="post_title" id="post_title" required>
						</div>
					</div>
					<div class="input-container">
						<label for="post_content" class="input-label">説明</label>
						<div class="input-field">
							<div class="pop-text">詳細な説明助かります！</div>
							<textarea name="post_content" id="post_content" cols="30" rows="10" placeholder="受け入れ期間、連絡対応時間、対応収容人数、チェックイン、チェックアウト時間、ベッドルームについて、布団のご用意、英語対応可能などを入力して下さい。" required></textarea>
						</div>
					</div>
					<!-- <div class="input-container">
						<label  class="input-label full-label">宿泊、もしくは、シャワー、お風呂のみの提供も歓迎です。</label>
					</div> -->

					<div class="input-container">
						<label for="link" class="input-label">リンク（airbnbやHPがある方）</label>

						<div class="input-field">
							<div class="pop-text">今半分です！</div>
							<input type="url" name="link" id="link">
						</div>
					</div>

					<div class="input-container">
						<label for="marker" class="input-label">場所※マーカーを移動して下さい。この位置がサイト上に表示されますので、おおよその位置を指定し、詳細な住所は、被災者との連絡時に行なって下さい。
</label>
						<div class="input-field">
							<div id="EQSIMAP"></div>
						</div>
						
					</div>

					<div class="input-container">
						<label for="latlng" class="input-label two-lane">緯度,経度は自動で表示されます。</label>

						<div class="input-field">
							<div class="pop-text">いい場所ですね！</div>
							<input type="text" name="latlng" id="latlng" value="36.2048,138.2529" required>
						</div>
					</div>

					<div class="input-container">
						<label for="city_name" class="input-label">町名までの住所※町名までの記入でお願い致します。インターネット上に公開されるため、詳細な住所は、被災者との連絡時に行なって下さい。</label>

						<div class="input-field">
							<div class="pop-text">もう少しで完了です</div>
							<input type="text" name="city_name" id="city_name" required>
						</div>
					</div>

					<div class="input-container">
						<label for="place_thumb" class="input-label">写真</label>

						<div class="input-field file-field">
							<div class="pop-text">いい写真ですね</div>
							<input type="file" name="place_thumb" id="place_thumb" accept="image/*">
						</div>
					</div>

					<div class="input-container">
						<label for="submitter_name" class="input-label">名前</label>

						<div class="input-field">
							<div class="pop-text">いい名前ですね！</div>
							<input type="text" name="submitter_name" id="submitter_name" required>
						</div>
					</div>
					
					<div class="input-container">
						<label for="submitter_email" class="input-label">メール</label>
						<div class="input-field">
							<div class="pop-text">覚えやすいメールですね！</div>
							<input type="text" name="submitter_email" id="submitter_email" required>
						</div>
					</div>
					
					<div class="input-container">
						<label for="submitter_phone" class="input-label">電話</label>
						<div class="input-field">
							<div class="pop-text">良い番号ですね！</div>
							<input type="text" name="submitter_phone" id="submitter_phone" required>
						</div>
					</div>

					<p><?php _e('ご協力有難うございます！下記のボタンよりご登録されれば自動でサイトへ掲載されます。','twenty_sixteen') ?></p>
					<input type="hidden" name="place_confirm_nonce" value="<?php echo wp_create_nonce('place_confirm_nonce'); ?>" >
					<div class="input-footer">
						<input type="submit" name="register_plan" value="Submit">
					</div>
				</form>
			</div><!-- .registration-form -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
