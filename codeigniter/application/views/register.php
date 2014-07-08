<html>
<head>
<title>会員登録画面</title>
<style>
body{ 
  background-image: url(<?php echo(base_url());?>images/hanabi.jpg);
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
  <?php echo form_open('twitterregister'); ?>　
  <p>
    <b>会員登録をしてください</b>
  <p>
  <h1>ユーザ名<br>
  <?php echo form_error('name');?>
    <input type="text" name="name" value="<?php echo set_value('name'); ?>" size="50" /> 
  </h1>  
  <h1>パスワード<br>
    <?php echo form_error('password');?>
    <input type="password" name="password" value="" size="50" />
  </h1>  
  <h1>メールアドレス<br>
    <?php echo form_error('email');?>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" /><br>
    <input type="submit" value="送信" />
  </h1>
  </form>
</body>
</html>

