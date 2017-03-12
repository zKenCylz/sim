<?php
/**
 * Content For Sim Archive
 */
?>
<?php
    $sim_meta = get_post_meta( get_the_ID() );
    $sim_so = $sim_meta['sim_so'][0];
    $gia_ban = number_format($sim_meta['gia_ban'][0], 0,'.', ' ').' đ';
    $terms = wp_get_post_terms( get_the_ID(), 'mang_sim' );
    $mang_di_dong = "";
    foreach ($terms as $term) {
        $mang_di_dong .= '<a href="'.get_term_link( $term->term_id,'mang_sim' ).'">'.$term->name.'</a><br>';
    }
?>
<tr>
    <td><?php echo $i; ?></td>
    <td><span class="simso"><a href="<?php the_permalink(); ?>"><?php echo $sim_so; ?></a></span></td>
    <td><?php echo $gia_ban; ?></td>
    <td><?php echo $mang_di_dong; ?></td>
    <td><?php $terms = wp_get_post_terms( get_the_ID(), 'loai_sim' );
        foreach ($terms as $term) {
            echo '<a href="'.get_term_link( $term->term_id,'loai_sim' ).'">'.$term->name.'</a><br>';
        } ?></td>
    <td><a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/buy.png" alt="">Mua sim</a></td>
</tr>