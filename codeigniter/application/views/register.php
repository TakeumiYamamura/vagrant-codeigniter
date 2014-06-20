<html>
<head>
<title>会員登録画面</title>
</head>
<body background="pages/hanabi.jpg">

<?php echo form_open('twitterregister'); ?>　
<p>
<b>会員登録をしてください</b>
<p>
<h5>ユーザ名</h5>
<?php echo form_error('name');?>
<input type="text" name="name" value="<?php echo set_value('name'); ?>" size="50" /> 

<h5>パスワード</h5>
<?php echo form_error('password');?>
<input type="password" name="password" value="" size="50" />

<h5>メールアドレス</h5>
<?php echo form_error('email');?>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<div><input type="submit" value="送信" /></div>

</form>

</body>
</html>

