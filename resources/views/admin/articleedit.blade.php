
@include("tool/tools")
<?php
/**
 * Created by PhpStorm.
 * User: 尽管如此世界依然美丽
 * Date: 2017/12/5/005
 * Time: 13:27
 */
//如果说是post请求，那么就执行添加操作。并且就结束。不再往下执行。
$db = conn();

$sql = "select * from qy_type";
$stmt = $db->prepare($sql);
$stmt->execute();
$types = $stmt->fetchAll();
//$id = get("id");

$sql = "select * from qy_article where id=$id";

$stmt = $db ->prepare($sql);

$stmt ->execute([':id'=>$id]);
$article = $stmt ->fetch();
?>

@extends("admin.layouts.app")
@section('content')
    <section class="content-header">
        <h1>
            编辑文章
            <small>it all starts here</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">添加文章</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form action="/updata/<?=$article['id']?>" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="<?=$article['id']?>"/>
                    <div class="form-group">
                        <label>文章标题</label>
                        <input type="text" class="form-control" name="title" value ="<?=$article['title']?>"/>
                    </div>
                    <div class="form-group">
                        <label>图片</label>
                        <input type="text" class="form-control" name="img" value ="<?=$article['img']?>"/>
                    </div>
                    <div class="form-group">
                        <label>选择分类</label>
                        <select name="type" class="form-control">
                            <option>选择分类</option>
                            <?php foreach ($types as $type){?>
                            <option <?php echo $article['type_id']==$type['id']?"selected":"";?> value="<?=$type['id']?>"><?=$type['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>文章内容</label>
                        <script id="container" name="content" type="text/plain">

                            <?=$article['content']?>

                        </script>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="编辑文章" />
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    @endsection
@section('js')
    <script type="text/javascript" src="{{asset('adminlte/editor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('adminlte/editor/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    {{--<script type="text/javascript" src="{{asset('adminlte/wangeditor/release/wangEditor.min.js')}}"></script>--}}

    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
    {{--<script type="text/javascript">--}}
        {{--var E = window.wangEditor--}}
        {{--var editor = new E('#editor')--}}
        {{--// 或者 var editor = new E( document.getElementById('editor') )--}}
        {{--editor.create()--}}
    {{--</script>--}}
@endsection