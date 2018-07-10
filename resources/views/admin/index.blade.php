@include('tool/tools')
<?php

$type_id = get('type_id');

$db=conn();


$stmt = $db->prepare('select * from qy_type  ');
$stmt ->execute();

$types = $stmt->fetchAll();

$stmt = $db->prepare('select * from qy_article  order by id desc  ');
$stmt ->execute();

$articles = $stmt->fetchAll();

?>
@extends('admin.particles.nav')
@include('admin.particles.index_top')


    <header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url({{asset('adminlte/')}}/img/11.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <span class="date-post"></span>
                            <h1 class="mb30"><a href="#">爆裂螺旋枪杀之疾风乱舞德意志骑士团团长</a></h1>
                            <p><a href="#" class="text-link">Yszm</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="gtco-main">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-12">
                    <ul id="gtco-post-list">
                        <?php
                        foreach ($articles as $article) {
                        //$o ++;

                        ?>
                        <li class="full entry animate-box" data-animate-effect="fadeIn">
                            <a href="/article/<?=$article['id']?>" target="_blank">
                                <!--                                    --><?php
                                //                                    foreach ($articl as $type) {
                                //                                    ?>
                                <div class="entry-img" style="background-image: url({{asset('adminlte/')}}/<?=$article['img']?>)"></div>
                                <!--                                        --><?php
                                //                                    }
                                //                                    ?>
                                <div class="entry-desc">
                                    <h3><?=$article['title']?></h3>
                                    <p><?php
                                        $contents = $article['content'];
                                        $contents = preg_replace('#<.+?>#','',$contents);
                                        echo (mb_substr($contents,0,70))?>

                                        ...</p>
                                </div>
                            </a>
                            <a href="#" class="post-meta">Yszm <span class="date-posted"><?=$article['created_at']?></span></a>

                        </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@include('admin.particles.index_footer')
</body>
</html>