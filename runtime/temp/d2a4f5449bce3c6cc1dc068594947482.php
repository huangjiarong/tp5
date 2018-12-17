<?php /*a:1:{s:54:"/home/jr/tp5/application/index/view/teacher/index.html";i:1544689184;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>教师管理</title>
    <link rel="stylesheet" type="text/css" href="/static/bootstrap-3.3.5-dist/css/bootstrap.min.css">
</head>
<body class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-bordered">
                <tr class="info">
                    <th>序号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>邮箱</th>
                    <th>用户名</th>
                </tr>
                <?php if(is_array($teachers) || $teachers instanceof \think\Collection || $teachers instanceof \think\Paginator): $key = 0; $__LIST__ = $teachers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$teacher): $mod = ($key % 2 );++$key;?>
                <tr>
                    <td><?php echo htmlentities($key); ?></td>
                    <td><?php echo htmlentities($teacher->getData('name')); ?></td>
                    <td><?php if($teacher->getData("sex") == '0'): ?>男<?php else: ?>女<?php endif; ?></td>
                    <td><?php echo htmlentities($teacher->getData('email')); ?></td>
                    <td><?php echo htmlentities($teacher->getData('username')); ?></td>
                    <td><a href="<?php echo Url('delete',array('id'=> $teacher->getData('id'))); ?>">删除</a></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
        </div>
    </div>
</body>
</html>
