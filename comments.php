<?php
if ( post_password_required() )
	return;
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php

				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'twentythirteen' ),

					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );

			?>
		</h2>
		<ol class="comment-list">
			<?php

				wp_list_comments( array(

					'style'       => 'ol',

					'short_ping'  => true,

					'avatar_size' => 48,

				) );

			?>
		</ol><!-- .comment-list -->
		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
		<?php endif; ?>
	<?php endif; // have_comments() ?>
	<?php comment_form(); ?>
</div>