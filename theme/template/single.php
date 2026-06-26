<?php
/**
 * gui·olsen — Single Post Template
 * theme/templates/single.php
 */

get_header(); ?>

<main>
    <?php while ( have_posts() ) : the_post(); ?>

    <article class="post-single">

        <a href="/blog" class="post-back">← Back to blog</a>

        <span class="post-eyebrow">
            <?php
            $categories = get_the_category();
            if ( $categories ) {
                echo esc_html( $categories[0]->name );
            }
            ?>
        </span>

        <h1><?php the_title(); ?></h1>

        <div class="post-meta">
            <?php echo get_the_date( 'F j, Y' ); ?>
            &nbsp;·&nbsp;
            <?php
            $content = get_the_content();
            $word_count = str_word_count( strip_tags( $content ) );
            $reading_time = ceil( $word_count / 200 );
            echo $reading_time . ' min read';
            ?>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-featured-image">
            <?php the_post_thumbnail( 'full' ); ?>
        </div>
        <?php endif; ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>

        <div class="post-footer">
            <div class="post-tags">
                <?php the_tags( '<span class="tag">', '</span><span class="tag">', '</span>' ); ?>
            </div>
            <a href="/blog" class="post-back">← Back to blog</a>
        </div>

    </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
