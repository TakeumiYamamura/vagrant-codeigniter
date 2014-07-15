<html>
<head>
  <title>ログイン画面</title>
  <style>
  body{ 
    background-image: url(<?php echo(base_url("images/hanabi.jpg"));?>);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
  }
  h1{
    text-shadow: 3px 3px 5px black;
    text-align: center;
    color: white;
  }
  p{
    text-align: center;
    color: white;
  }
  </style>
</head>
<body>
  <?php echo form_open('twitterlogin'); ?>
  <p>
    <b>ログイン画面です</b>
  </p>
  <h1>パスワード<br>
    <?php echo form_error('password');?>
    <input type="password" name="password" value="" size="50" />
  </h1>
  <h1>メールアドレス<br>
    <?php echo form_error('email');?>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" /><br>
    <input type="submit" value="送信" /><br>
    <a href= "<?php echo(base_url("index.php/twitterregister"));?>">ユーザー登録はこちら</a>
  </h1>
  </form>
  <p>
    <small>Twitter ver　やまむら</small>
  </p>
</body>
</html>