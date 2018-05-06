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
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> 「如果有妹妹就好了.」</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="GetTemplates.co" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />
@include('admin.particles.index_top')
</head>
<body>

<div class="gtco-loader"></div>

<div id="page">
    <nav class="gtco-nav" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-xs-2 text-left">
                    <div id="gtco-logo"><a href="/">Yszm<span>.</span></a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="has-dropdown">
                            <a href="/">首页</a>
                            <ul class="dropdown">
                                <?php foreach ($types as $type){?>
                                <li><a href="/article_list/<?=$type['id']?>"><?=$type['name']?></a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <?php foreach ($types as $type){?>
                        <li><a href="/article_list/<?=$type['id']?>"><?=$type['name']?></a></li>
                        <?php }?>


                    </ul>
                </div>
            </div>

        </div>
    </nav>

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