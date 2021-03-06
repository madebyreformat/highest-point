<?php
/* Template Name: Lineup */

get_header(); ?>

	<?php while ( have_posts() ) : the_post();   ?>

	<?php

	while( have_rows('modules') ): the_row();
        get_template_part('template-parts/module', get_row_layout() );
    endwhile;

	?>

	<div class="module module-lineup is-padded bg-yellow bg-module-lineup sr-fade">
		<div class="row">
			<div class="poster">
				<div class="poster-wrap">
					<?php
					$poster_img = get_field('poster_img');
					$poster_file = get_field('poster_file');

					?>
					<?php if( $poster_file ): ?>
					<a class="poster-download" href="<?php echo $poster_file['url']; ?>" aria-label="Download the poster">
					<?php else: ?>
					<div class="poster-download">
					<?php endif; ?>
						<img src="<?php echo $poster_img['sizes']['large']; ?>" alt="">
					<?php if( $poster_file ): ?>
					</a>
					<?php else: ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="lineup">
				<section class="listings">
					<header class="listings-header"><h2>All Artists</h2></header>

					<?php while( have_rows('lineup') ): the_row(); ?>

					<div class="listings-column">
						<div class="listings-column-header">
							<h3><?php the_sub_field('day'); ?></h3>
						</div>
						<?php while( have_rows('stage') ): the_row(); ?>
						<div class="listings-stage">
							<h4><?php the_sub_field('stage'); ?></h4>
							<?php if( get_sub_field('text_before') ): ?><p class="listings-before"><?php the_sub_field('text_before'); ?></p><?php endif; ?>
							<ul class="listings-list">
								<?php
								$posts = get_sub_field('artists');
								if( $posts ):
								foreach( $posts as $post ): setup_postdata($post); ?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php endforeach; wp_reset_postdata(); ?>
								<?php endif; ?>
							</ul>
							<?php if( get_sub_field('text_after') ): ?><p class="listings-after"><?php the_sub_field('text_after'); ?></p><?php endif; ?>
							<?php if( get_sub_field('freetype') ): ?><p class="listings-after"><?php the_sub_field('freetype'); ?></p><?php endif; ?>
						</div>
						<?php endwhile; ?>
					</div>

					<?php endwhile; ?>

				</section>
				<footer class="listings-footer">
					<a href="/tickets" class="button is-m">Buy tickets</a>
				</footer>
			</div>
		</div>
	</div>

	<?php

	$photo = get_field('photo');
	if( $photo ):

	?>
	<section class="module module-photo sr-fade">
		<figure class="animated">
			<img src="<?php echo $photo['sizes']['wide']; ?>" alt="<?php echo $photo['alt']; ?>">
		</figure>
	</section>
	<?php endif; ?>

	<?php endwhile; ?>

<?php get_footer(); ?>