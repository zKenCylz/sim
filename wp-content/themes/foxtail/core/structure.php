<?php
/**
 * Template functions used for the website
 */

/**
 * Display image by theme options
 */
if (!function_exists('foxtail_img_from_option')) {
    function foxtail_img_from_option($option)
    {
        if ($option['id']) {
            echo wp_get_attachment_image($option['id'], 'full');
        } else {
            if ($option['url']) echo '<img src="' . $option['url'] . '" alt="' . get_bloginfo('name') . '" />';
        }
    }
}

/**
 * Display Logo
 */
if (!function_exists('foxtail_logo')) {
    function foxtail_logo()
    {
        global $foxtail_options;
        ?>

        <div class="logo">

		<?php if (is_front_page()): ?>

			<h1 style="width: 150px; height: 100px; margin: 0 0 -100px 0; position: relative; top: -300px; font-size: 18px" class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>

		<?php endif; ?>

        <a href="<?php echo home_url('/') ?>">
            <img src="<?php echo $foxtail_options['header-logo']['url'] ?>" alt="<?php bloginfo('name') ?>" />
        </a>
        </div>

	<?php
	}
}

/**
 * Display post thumbnail
 */
if (!function_exists('foxtail_thumbnail')) {
    function foxtail_thumbnail($size = 'thumbnail', $is_link = true, $args = array())
    {
        if (has_post_thumbnail() && !post_password_required() || has_post_format('image')):
            ?>
            <?php if ($is_link): ?>
            <a class="post-thumbnail" href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
                <figure><?php the_post_thumbnail($size, $args); ?></figure>
            </a>
        <?php else: ?>
            <figure class="post-thumbnail"><?php the_post_thumbnail($size, $args); ?></figure>
        <?php endif;
        endif;
    }
}

/**
 * Display post entry meta
 */
if (!function_exists('foxtail_entry_meta')) {
    function foxtail_entry_meta($is_page = false)
    {
        ?>
        <div class="post-meta">
            <span class="author">Posted by <?php the_author_posts_link(); ?></span> | <span itemprop="datePublished"><?php the_time('d-m-Y') ?></span>

            <?php if (!$is_page): ?>
                | <span class="list-categories"><?php echo get_the_category_list(', ') ?></span>
            <?php endif; ?>

        </div>
        <?php
    }
}

/**
 * Like Share Facebook
 */
if (!function_exists('foxtail_like_share')) {
    function foxtail_like_share()
    {
        $image = esc_url(wp_get_attachment_url( get_post_thumbnail_id() ));
        $permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
        $title = esc_attr(get_the_title());
        ?>
        <div class="share-links clearfix">
            <a href="http://www.facebook.com/sharer.php?m2w&amp;s=100&amp;p&#091;url&#093;=<?php echo $permalink ?>&amp;p&#091;images&#093;&#091;0&#093;=<?php echo $image ?>&amp;p&#091;title&#093;=<?php echo $title ?>" target="_blank" rel="nofollow" title="Facebook" class="share-facebook"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?text=<?php echo $title ?>&amp;url=<?php echo $permalink ?>" target="_blank" rel="nofollow" title="Twitter" class="share-twitter"><i class="fa fa-twitter"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" target="_blank" rel="nofollow" title="LinkedIn" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
            <a href="https://plus.google.com/share?url=<?php echo $permalink ?>" target="_blank" rel="nofollow" title="Google +" class="share-googleplus"><i class="fa fa-google-plus"></i></a>
            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $permalink ?>&amp;media=<?php echo $image ?>" target="_blank" rel="nofollow" title="Pinterest" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
            <a href="mailto:?subject=<?php echo $title ?>&amp;body=<?php echo $permalink ?>" target="_blank" rel="nofollow" title="Email" class="share-email"><i class="fa fa-envelope"></i></a>
        </div>
        <?php
    }
}

/**
 * Comment Facebook
 */
if (!function_exists('foxtail_comment_facebook')) {
    function foxtail_comment_facebook($link = '')
    {
        if ($link == '') $link = home_url('/');
        ?>

        <div class="facebook-comment responsive">
            <h4 class="title">Bình luận của bạn</h4>

            <div class="fb-comments" data-href="<?php echo $link ?>" data-width="817px" data-numposts="20"></div>
        </div>

        <?php
    }
}

if (!function_exists('foxtail_maps')) {
    function foxtail_maps($options = array())
    {
        ?>

        <div id="foxtail-maps" style="height: <?php echo $options['height'] ?>px"></div>
        <script>
            var map;

            function initMap() {
                var myLatLng = {lat: <?php echo $options['lat'] ?>, lng: <?php echo $options['lng'] ?>};

                map = new google.maps.Map(document.getElementById('foxtail-maps'), {
                    center: myLatLng,
                    zoom: <?php echo $options['zoom'] ?>,
                    scrollwheel: <?php echo $options['scroll-wheel'] ?>
                });

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map
                });
                marker.setAnimation(google.maps.Animation.BOUNCE);

                var contentStr = '<?php echo $options['content'] ?>';
                var infoWindow = new google.maps.InfoWindow({
                    content: contentStr
                });
                infoWindow.open(map, marker);
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.23&language=vi&key=<?php echo $options['api-key'] ?>&callback=initMap" async defer></script>

        <?php
    }
}

/**
 * Show Related Posts
 */

function foxtail_get_related_posts($ID = '', $post_type = 'post')
{
    if ($ID == '' || !is_numeric($ID)) return array();
    $terms = wp_get_post_tags($ID);

    if ($terms) {
        $term_ids = array();
        foreach ($terms as $item) $term_ids[] = $item->term_id;
        $args = array(
            'post_type' => $post_type,
            'tag__in' => $term_ids,
            'post__not_in' => array($ID),
            'posts_per_page' => 8,
            'ignore_sticky_posts' => 1
        );
        return new WP_Query($args);
    }
    return array();
}

function foxtail_related_posts($ID, $content_template = '', $post_type = 'post', $cols = '')
{
    $terms = wp_get_post_tags($ID);

    if ($terms) {
        $term_ids = array();
        foreach ($terms as $item) $term_ids[] = $item->term_id;
        $args = array(
            'post_type' => $post_type,
            'tag__in' => $term_ids,
            'post__not_in' => array($ID),
            'posts_per_page' => 8,
            'ignore_sticky_posts' => 1
        );
        query_posts($args);
        if (have_posts()) {
            $i = 0;
            while (have_posts()) {
                the_post();
                $i++;
                get_template_part('content', $content_template);
                if (is_numeric($cols) && $i == $cols) echo '<div class="col-xs-12 hidden-xs"></div>';
            }
        }
        wp_reset_query();
    }
}

/**
 * @param $limit
 * @return array|mixed|string
 * Custom post excerpt
 */
function foxtail_get_the_excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . ' ...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
//    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}

function foxtail_the_excerpt($limit)
{
    echo foxtail_get_the_excerpt($limit);
}

function foxtail_pagination()
{
    if (function_exists('wp_pagenavi')) {
        echo '<div class="col-md-12">';
        wp_pagenavi();
        echo '</div>';
    }
}