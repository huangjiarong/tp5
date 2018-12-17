<?php /*a:1:{s:56:"/home/jr/PHP/tp5/application/index/view/login/index.html";i:1544773669;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
    <form action="<?php echo url('login'); ?>" method="post">
        <label for="username">username:</label><input type="text" name="username" id="username" />
        <label for="password">password:</label><input type="password" name="password" id="password" />
        <button type="submit">submit</button>
    </form>
</body>
</html>
