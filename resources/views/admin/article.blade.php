@include("tool/tools")
<?php
/**
 * Created by PhpStorm.
 * User:
 * Date: 2017/8/15
 * Time: 16:48
 */
//$id = get('id');
$db = conn();
$sql = "select * from qy_article WHERE id=$id";
$stmt = $db->prepare($sql);
$stmt->execute([':id'=>$id]);
$article = $stmt->fetch();
$stmt = $db->prepare('select * from qy_type  ');
$stmt ->execute();

$types = $stmt->fetchAll();

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$article['title']?></title>
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
<body>

<div class="gtco-loader"></div>

<div id="page">
    <nav class="gtco-nav" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-xs-2 text-left">
                    <div id="gtco-logo"><a href="article_list.php">Yszm<span>.</span></a></div>
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

    <header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url({{asset('adminlte/')}}/<?=$article['img']?>);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <span class="date-post"><?=$article['created_at']?></span>
                            <h1 class="mb30"><a href="#"><?=$article['title']?></a></h1>
                            <p>by <a href="#" class="text-link">Yszm</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="gtco-maine">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-12">
                    <article class="mt-negative">
                        <div class="text-left content-article">
                            <div class="row">
                                <div class="col-lg-8 cp-r animate-box" id="content">
                                    <p><?=$article['content']?></p>
                                </div>

                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
    @include('admin.particles.index_footer')
</body>
</html>


