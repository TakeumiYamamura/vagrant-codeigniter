
<html>
<head>
<title>twitter掲示板ver山村</title>
<style>
body{ 
  background-image: url(<?php echo(base_url());?>images/hanabi.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
#tweet{
  text-shadow: 3px 3px 5px black;
  text-align: center;
  color: white;
}
p{
  text-align: center;
  color: white;
}
</style>
<script type ="text/javascript" src ="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type ="text/javascript">
var page = 1;
$.ajax({
  url: '/index.php/twittermain/get_list',
  dataType: 'json',
  async: true,

  success: function(json){
    var html = '';
    for(i in json){
      html +='<li> '+ json[json.length-i-1].name +'</li><dt><p>'+json[json.length-i-1].message+'</p>';
      if(i>=9) break; 
    }
    $('#message').html('<ul>'+html+'</ul>');
  },
  error: function(){
    alert('データの読み込みに失敗しました。');
  }
});
</script>
</head>
<body>
  <dl id="tweet">
    <dt>こんにちは！<?php echo "$_COOKIE[name]"; ?>さん！つぶやいてみよう<dt>
    <dd> 
        <textarea type="text" name="message" cols="60" rows="4"  maxlength="140" id="talk"></textarea>
    </dd>
    <p>
      <input type="button" value="投稿する" id="send_button" />
    </p>
  <dl>
<h3>たくさんつぶやこう！！</h3>

<p>
  <button id="count">もっと見る</button><dt>
  <?php
    echo anchor('twitterlogin', 'ログアウトはこちら');
  ?>
</p>
  <div id="message">
    <p>ロード中です</p>
  </div>


<script type ="text/javascript">
$("#send_button").click(function(){
  alert(page);
  var m = $("#talk").val();
  if(m != ""){
    $.ajax({
      url: '/index.php/twittermain/register/',
      type : "POST",
      async: true,
      data : {message : m, <?php echo($this->security->get_csrf_token_name());?> : '<?php echo($this->security->get_csrf_hash());?>' },
    });
    $.ajax({
      url: '/index.php/twittermain/get_list',
      dataType: 'json',
      async: true,
      success: function(json){
        var html = '';
        for(i in json){
          html +='<li> '+ json[json.length-i-1].name +'</li><dt><p>'+json[json.length-i-1].message+'</p>';
          if(i>=10*page-1) break; 
        }
        $('#message').html('<ul>'+html+'</ul>');
      },
      error: function(){
        alert('データの読み込みに失敗しました。');
  　   }
    });
  } 
});

$("#count").click(function(){
  page++;
  alert(page);
  $.ajax({
    url: '/index.php/twittermain/get_list',
    dataType: 'json',
    async: true,
    success: function(json){
      var html = '';
      for(i in json){
        html +='<li> '+ json[json.length-i-1].name +'</li><dt><p>'+json[json.length-i-1].message+'</p>';
        if(i>=10*page-1) break; 
      }
      $('#message').html('<ul>'+html+'</ul>');
    },
    error: function(){
      alert('データの読み込みに失敗しました。');
  　}
 });
});

</script>
</body>
</html>