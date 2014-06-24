<html>
<head>
<title>ログイン画面</title>
</head>
<body>
  <?php echo form_open('twitterlogin'); ?>
  <p>
    <b>ログイン画面です</b>
  </p>
  <h5>パスワード</h5>
    <?php echo form_error('password');?>
    <input type="password" name="password" value="" size="50" />
  <h5>メールアドレス</h5>
    <?php echo form_error('email');?>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />
    <input type="submit" value="送信" />
    <div><a href= "twitterregister">ユーザー登録はこちら</a></div>
  </form>
</body>
</html>