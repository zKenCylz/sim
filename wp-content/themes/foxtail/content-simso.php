<?php
/**
 * Content For Single Sim
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope="" itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
    <h1 class="post-title title page-title" itemprop="name">
        <?php the_title(); ?>
    </h1>
    <div class="post-content"><?php the_content() ?></div>
    <?php
    $sim_meta = get_post_meta( get_the_ID() );
    $sim_so = $sim_meta['sim_so'][0];
    $gia_ban = number_format($sim_meta['gia_ban'][0], 0,'.', ' ').' đ';
    $terms = wp_get_post_terms( get_the_ID(), 'mang_sim' );
    $mang_di_dong = '';
    foreach ($terms as $term) {
        $mang_di_dong .= $term->name;
    }
    ?>
    <table id="simso-info" class="table table-hover">
        <tbody>
            <tr>
                <td width="25%" style="text-align: right;">Số sim:</td>
                <td width="75%" style="text-align: left;"><h1 style="color: red"><?php echo $sim_so; ?></h1></td>
            </tr>
            <tr>
                <td width="25%" style="text-align: right;">Giá bán:</td>
                <td width="75%" style="text-align: left;"><?php echo $gia_ban; ?></td>
            </tr>
            <tr>
                <td width="25%" style="text-align: right;">Mạng:</td>
                <td width="75%" style="text-align: left;"><?php echo $mang_di_dong; ?></td>
            </tr>
        </tbody>
    </table>
    <div id="dat_sim">
        <strong>ĐẶT MUA SIM</strong><br>
        Quý khách vui lòng điền nội dung vào các ô dưới đây,<br>
          Chúng tôi sẽ gọi lại sau khi nhận được thông tin của Quý khách!<br>
          Hoặc để đặt hàng nhanh nhất hãy gọi đến số Hotline <strong><font color="#006cc7">0911.82.6699</font></strong>
    </div>
    <?php echo do_shortcode('[contact-form-7 id="93" title="CF Đặt mua Sim"]'); ?>

    <div class="tags">
        <i class="fa fa-tags"></i> Tags: <?php echo get_the_tag_list('', ', ', '') ?>
    </div>

    <?php foxtail_comment_facebook(get_the_permalink()) ?>

</article><!-- #post-## -->