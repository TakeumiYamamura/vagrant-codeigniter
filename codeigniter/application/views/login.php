<html>

<?php echo form_open('twitterlogin'); ?>　

<head>
<title>ログイン画面</title>
</head>
<body>
<p>
<b>ログイン画面です</b>
</p>
<h5>パスワード</h5>
<?php echo form_error('password');?>
<input type="password" name="password" value="" size="50" />

<h5>メールアドレス</h5>
<?php echo form_error('email');?>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<div><input type="submit" value="送信" /></div>
<a href= "twitterregister">ユーザー登録はこちら</A>
</form>

</body>
</html>