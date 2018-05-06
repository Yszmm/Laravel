<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class ArticleController extends Controller
{
    function store(Request $request)
    {
        require_once "tools.php";
        $db = conn();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //print_r($_POST);
            $type_id = post("type");
            $title = post("title");
            $content = post("content");

            $sql = 'insert into qy_article(type_id, `title`, content) values(:type_id,:title,:content)';
            $stmt = $db->prepare($sql);
            $stmt->execute([':type_id' => $type_id, ':title' => $title, ':content' => $content]);
            $row = $stmt->rowCount();
            if ($row > 0) {
                return redirect('articlelist');

            }
        }
    }

    function del($id)
    {
        require_once "tools.php";

        $db = conn();
        //$id = get("id");

        $sql = "delete from qy_article where id=$id";

        $stmt = $db->prepare($sql);

        $stmt->execute([':id' => $id]);
        return redirect('articlelist');
    }

    function updata(Request $request)
    {
        require_once "tools.php";
        $db = conn();

        $id = post("id");
        $type_id = post("type");
        $title = post("title");
        $content = post("content");
        $img = post("img");
        $sql = "update qy_article set type_id=:type_id,title=:title,content=:content,img=:img where id=:id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':type_id' => $type_id, ':title' => $title, ':content' => $content, ':img' => $img]);
        $row = $stmt->rowCount();
        if ($row > 0) {
            return redirect('articlelist');
        }
    }

    function edit($id)
    {

        return view("admin.articleedit", ['id' => $id]);

    }

    function click()
    {
        require_once "tools.php";

        $db = conn();
        $name = $_POST['username'];
        $pass = md5($_POST['password']);
        $sql = "select id from qy_users where name=:name and pass=:pass";
        $stmt = $db->prepare($sql);
        $stmt->execute([':name'=>$name,':pass'=>$pass]);
        $row = $stmt->rowCount();
        if(!$row)
        {
            echo "<script>alert('登陆失败');</script>";
        }
        if ($row > 0) {
            return redirect('articlelist');
        }
    }

    function loginl()
    {
        return view("admin.login");
    }

}

