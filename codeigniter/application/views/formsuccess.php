<html>
<head>
<title>twitter掲示板ver山村</title>
</head>
<body>
  <form action="twittermain" method="post">
    <dl>
    <dt>つぶやいてみよう<dt>
    <dd> 
        <textarea name ="message" cols="50" rows="5"></textarea>
    </dd>
    <p>
      <input type ="submit" value="投稿する" />
    </p>
  </form>
<h3>フォームは正しく送信されました!</h3>
<p><?php echo anchor('twitterlogin', 'ログアウトはこちら'); ?></p>
</body>
</html>