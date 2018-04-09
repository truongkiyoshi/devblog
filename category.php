<?php require_once 'inc/connect.php'; ?>
<?php require_once 'inc/func.php'; ?>
<?php 
                    if(isset($_GET['cid'],$_GET['cname']) && filter_var($_GET['cid'],FILTER_VALIDATE_INT,array('min_range'=>1))){
                        $cid = $_GET['cid'];
                        $cname = $_GET['cname'];
                        $title = $cname;
                    }else{
                        chuyenhuong('404.html');
                    }
                 ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
                
                <!-- Blog Post (Right Sidebar) Start -->
                <div class="col-md-9 col-lg-9">
                    <div class="col-md-12 page-body">
                        <div class="row">
                            <div class="sub-title">
                                <h2><?php if(isset($cname)) echo $cname; ?></h2>
                                <a href="http://fb.com/truongvp97"><i class="icon-envelope"></i></a>
                            </div>
                            <div class="col-md-12 content-page">
                                <!-- Blog Post Start -->
                                <?php
                                    $sr = getStartAndLimit();
                                    $get = getPageByCatId($cid,$sr['start'],$sr['limit']);
                                    if(mysqli_affected_rows($dbc) >0){
                                        while ($data = mysqli_fetch_array($get)) {
                                        echo "<div class='col-md-12 blog-post'>
                                                    <div class='single.php?pid={$data['page_id']}&pname={$data['page_name']}'>
                                                        <a href='single.php?pid={$data['page_id']}&pname={$data['page_name']}'><h1>{$data['page_name']}</h1></a>
                                                    </div>
                                                    <div class='post-info'>
                                                        <span>{$data['post_on']} / by <a href='author.php?author_id={$data['user_id']}&author_name={$data['user_name']}' target='_blank'>{$data['user_name']}</a></span>
                                                    </div>
                                                    <p>".the_excerpt($data['content'])."..."."</p>
                                                    <a href='single.php?pid={$data['page_id']}&pname={$data['page_name']}' class='button button-style button-anim fa fa-long-arrow-right'><span>Read More</span></a>
                                            </div>";
                                        }
                                        echo "<ul class='pagination modal-2'>";
                                            if($sr['page']>1){
                                                echo "<li><a href='category.php?cid=$cid&cname=$cname&page=".($sr['page']-1)."' class='prev'>Trang Trước</a></li>";
                                            }
                                            for($i=1;$i<=$sr['total_page'];$i++){
                                                if($i == $sr['page']){
                                                    echo "<li><span>".$i."</span></li>";
                                                }else{
                                                    echo "<li><a href='category.php?cid=$cid&cname=$cname&page=".$i."'>$i</a></li>";
                                                }
                                            }
                                            if($sr['page']<$sr['total_page'] && $sr['total_page']>1){
                                                echo "<li><a href='category.php?cid=$cid&cname=$cname&page=".($sr['page']+1)."' class='next'>Trang Sau</a></li>";
                                            }
                                            echo "</ul>";
                                    }else{
                                            echo "<h3>Không có bài viết</h3>";
                                        }

                                 ?>
                                <!-- Blog Post End -->
                                
                            </div>
                        </div>
<?php include 'inc/footer.php'; ?>