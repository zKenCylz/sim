<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".message-div").hide();
        var ngay = $("select#SearchModel_NgayStr").val();
        var thang = $("select#SearchModel_ThangStr").val();
        var nam = $("select#SearchModel_NamStr").val();
        if (ngay == "" || thang == "" || nam == "") {
            $(".message-validate-empty").text("Nhập đầy đủ ngày/tháng/năm.");
            $(".message-div").show();
        }
        $("button[name=submitsearch]").on("click", function () {
            var form = $(this).closest("form");
            var ngay = form.find("select#SearchModel_NgayStr").val();
            var thang = form.find("select#SearchModel_ThangStr").val();
            var nam = form.find("select#SearchModel_NamStr").val();
            var sdt = form.find("#SearchModel_SimNumber").val();
            if (sdt == "") {
                $(".message-validate-empty").text("Chưa nhập số điện thoại.");
                $(".message-div").show();
                return;
            }
            if (ngay == "" || thang == "" || nam == "") {
                $(".message-validate-empty").text("Nhập đầy đủ ngày/tháng/năm.");
                $(".message-div").show();
                return;
            }
            form.submit();
        });
        $(".validateday").on("change", function () {
            cboOnSelectedIndexChanged();
        });
    });

    function cboOnSelectedIndexChanged() {
        var i_month = jQuery("#SearchModel_ThangStr").val();
        var i_year = jQuery("#SearchModel_NamStr").val();
        var i_maxday = GetMaxDayOfMonth(i_month, i_year);
        var i_day = jQuery("#SearchModel_NgayStr").val();
        if (i_day > i_maxday && i_maxday > 0) {
            $("#SearchModel_NgayStr").val(i_maxday);
        }
    };

    function GetMaxDayOfMonth(month, year) {
        var i_month = parseInt(month);
        var i_year = parseInt(year);
        var i_maxday = 0;
        switch (i_month) {
            case 1: case 3: case 5: case 7: case 8: case 10: case 12: i_maxday = 31; break;
            case 2: if ((i_year % 4 == 0 && i_year % 100 != 0) || (i_year % 400 == 0)) i_maxday = 29; else i_maxday = 28; break;
            case 4: case 6: case 9: case 11: i_maxday = 30; break;
        }
        return i_maxday;
    };
</script>
<style>
    .ifame-h3 { padding: 4px 0 5px 29px; font-size: 14pt; color: #C51232; margin-top: 0px; margin-bottom: 13px; font-weight: bold; text-align: center; }
    .form-search-iframe { margin-left: 10px; margin-right: 10px; }
</style>

<h3 class="ifame-h3">Tra cứu sim hợp mệnh, hợp tuổi, hợp phong thủy</h3>
<form action="<?php get_permalink(); ?>" class="form-search form-search-iframe form-horizontal" method="post" role="form">
    <div class="row form-group">
        <div class="col-xs-12 col-sm-12 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <label>Nhập số điện thoại</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9" style="padding-left: 5px; padding-right: 5px">
            <input class="form-control" data-val="true" data-val-length="Bắt buộc nhập từ 3 chữ số trở lên" data-val-length-max="20" data-val-length-min="3" data-val-regex="Chỉ được nhập số và dấu ." data-val-regex-pattern="^[0-9.*\s\t\r\n\f]+$" id="SearchModel_SimNumber" name="SimNumber" placeholder="nhập số bạn muốn tra cứu" type="tel" value="">
            <span class="field-validation-valid" data-valmsg-for="SimNumber" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="clear"></div>
    <div class="row form-group">
        <div class="col-xs-12 col-sm-12 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <label>Ngày sinh (dương lịch)</label>
        </div>
        <div class="col-xs-4 col-sm-2 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <select class="form-control validateday" id="SearchModel_NgayStr" name="NgayStr">
                <option value="">ngày</option>
                <?php for ($i=1; $i < 32; $i++) {
                    echo "<option value=".$i.">".$i."</option>";
                } ?>
            </select>
        </div>
        <div class="col-xs-4 col-sm-2 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <select class="form-control validateday" id="SearchModel_ThangStr" name="ThangStr">
                <option value="">tháng</option>
                <?php for ($i=1; $i < 13; $i++) {
                    echo "<option value=".$i.">".$i."</option>";
                } ?>
            </select>
        </div>
        <div class="col-xs-4 col-sm-2 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <select class="form-control validateday" id="SearchModel_NamStr" name="NamStr">
                <option value="">năm</option>
                <?php for ($i = 2017; $i >= 1900; $i-- ) {
                    echo "<option value=".$i.">".$i."</option>";
                } ?>
            </select>
        </div>
    </div>
    <div class="clear"></div>
    <div class="row form-group message-div" style="display: none;">
        <div class="col-xs-12 col-sm-12 col-md-3"></div>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <span class="message-validate-empty" style="color: red; padding-left: 15px;"></span>
        </div>
    </div>
    <div class="clear"></div>
    <div class="row form-group">
        <div class="col-xs-12 col-sm-12 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <label>Giờ sinh</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <select class="form-control" id="SearchModel_GioStr" name="GioStr">
                <option value="">-- giờ --</option>
                <option value="1">23 giờ đến 1 giờ</option><option value="2">1 giờ đến 3 giờ</option>
                <option value="3">3 giờ đến 5 giờ</option><option value="4">5 giờ đến 7 giờ</option>
                <option value="5">7 giờ đến 9 giờ</option><option value="6">9 giờ đến 11 giờ</option>
                <option value="7">11 giờ đến 13 giờ</option><option value="8">13 giờ đến 15 giờ</option>
                <option value="9">15 giờ đến 17 giờ</option><option value="10">17 giờ đến 19 giờ</option>
                <option value="11">19 giờ đến 21 giờ</option><option value="12">21 giờ đến 23 giờ</option>
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6"></div>
    </div>
    <div class="clear"></div>
    <div class="row form-group">
        <div class="col-xs-12 col-sm-12 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <label>Giới tính</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3" style="padding-left: 5px; padding-right: 5px">
            <select class="form-control" id="SearchModel_GioiTinh" name="GioiTinh">
                <option selected="selected" value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6"></div>
    </div>
    <div class="clear"></div>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-3"></div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="text-center">
                <button type="submit" name="submitBPT" value="submitBPT" style="cursor:pointer" class="btn btn-primary btn-red">Tra cứu</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6"></div>
    </div>
    <div class="clear"></div>
</form>
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Số Sim</th>
            <th>Giá bán</th>
            <th>Mạng di động</th>
            <th>Loại sim</th>
            <th>Mua sim</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $args = array(
            'post_type' => 'simso',
            'post_status' => 'publish',
            );
        $query = new WP_Query( $args );
        $paged = get_query_var('page') ? get_query_var('page') : 1;
        $post_per_page = get_query_var('posts_per_page');
        if ($query->have_posts()):
            if ($paged == 1) {
                $i = 1;
            } else {
                $i = ($paged-1)*$post_per_page + 1;
            }
            while ($query->have_posts()):
                $query->the_post();
            include( locate_template( 'content-sim-archive.php', false, false ) );
            $i++;
            endwhile;
            foxtail_pagination();
            else:
                echo '<tr><td colspan="6"><p>Không tìm thấy sim nào!!</p></td></tr>';
            echo "</tbody></table>";
            endif;
            ?>
        </tbody>
    </table>
    <?php
    include("/simplehtmldom/simple_html_dom.php");

    if (isset($_POST['submitBPT'])) {
        if (isset($_POST['SimNumber'])) {
            $SimNumber = $_POST['SimNumber'];
        }
        if (isset($_POST['NgayStr'])) {
            $NgayStr = $_POST['NgayStr'];
        }
        if (isset($_POST['ThangStr'])) {
            $ThangStr = $_POST['ThangStr'];
        }
        if (isset($_POST['NamStr'])) {
            $NamStr = $_POST['NamStr'];
        }
        if (isset($_POST['GioStr'])) {
            $GioStr = $_POST['GioStr'];
        }
        if (isset($_POST['GioiTinh'])) {
            $GioiTinh = $_POST['GioiTinh'];
        }

        $request = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query(array(
                    'SearchModel.SimNumber' => $SimNumber,
                    'SearchModel.NgayStr' => $NgayStr,
                    'SearchModel.ThangStr' => $ThangStr,
                    'SearchModel.NamStr' => $NamStr,
                    'SearchModel.GioStr' => $GioStr,
                    'SearchModel.GioiTinh' => $GioiTinh,
                    )),
                )
            );

        $context = stream_context_create($request);
    // Create DOM from URL or file
        $html = file_get_html('http://simphongthuyuytin.com/Xem-sim-phong-thuy.html', false, $context);
        $html->find('a', 0)->href = '#';
        $html->find('a', 0)->innertext = '';

    //fix img link
        foreach($html->find('img') as $img) {
         $src_val = $img->src;
         $img->src = 'http://simphongthuyuytin.com'.$src_val;
     }

     $rs = $html->find('div.chitietphongthuy', 0);
     echo $rs;


 }
 ?>

