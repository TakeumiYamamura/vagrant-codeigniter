<html>
<head>
<title>twitter掲示板ver山村</title>
<style>
body{ 
  background-image: url(<?php echo(base_url());?>images/hanabi.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-attachment: fixed;
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
legend{
  color: white;
}
</style>
<script type ="text/javascript" src ="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type ="text/javascript">
var page = 1;
function tweet(t){
  $.ajax({
    url: '/index.php/twittermain/get_list',
    dataType: 'json',
    async: true,
    success: function(json){
      var html = '';
      for(i in json){
        var now =new Date();
        var tweettime = new Date(json[json.length-i-1].modified);
        difference = now.getTime()-tweettime.getTime();
        if (difference > 1000*60*60*24){
          var day = Math.floor(difference /(1000*60*60*24));
          html +='<fieldset><legend>'+ json[json.length-i-1].name +'</legend><dt><p>'+json[json.length-i-1].message+'</p><dt><p>'+day+'日前</p></fieldset>';
        } else if (difference > 1000*60*60){
          var hour = Math.floor(difference/(1000*60*60));
          html +='<fieldset><legend>'+ json[json.length-i-1].name +'</legend><dt><p>'+json[json.length-i-1].message+'</p><dt><p>'+hour+'時間前</p></fieldset>';
        } else if(difference > 1000*60){
          var minute =Math.floor(difference/(1000*60));
          html +='<fieldset><legend>'+ json[json.length-i-1].name +'</legend><dt><p>'+json[json.length-i-1].message+'</p><dt><p>'+minute+'分前</p></fieldset>';
        } else {
          var second =Math.floor(difference/(1000));
          html +='<fieldset><legend>'+ json[json.length-i-1].name +'</legend><dt><p>'+json[json.length-i-1].message+'</p><dt><p>'+second+'秒前</p></fieldset>';
        }
        if(i>=(10*t-1)) break; 
      }
      $('#message').html('<ul>'+html+'</ul>');
    },
    error: function(){
      alert('データの読み込みに失敗しました。');
    }  
  });
}
tweet(page);
</script>
</head>
<body>
  <dl id="tweet">
    <dt>こんにちは！<?php echo $this->session->userdata('name'); ?>さん！つぶやいてみよう<dt>
    <dd id="delete"> 
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
$("#send_button").click(function() {
  var m = $("#talk").val();
  if(m != ""){
    $.ajax({
      url: '/index.php/twittermain/register/',
      type : "POST",
      async: true,
      data : {message : m, <?php echo($this->security->get_csrf_token_name());?> : '<?php echo($this->security->get_csrf_hash());?>' },
      success: function(id) {
        console.log("insert id:" + id);
        tweet(page);
      }
    });
  }
  $('#delete').html('<textarea type="text" name="message" cols="60" rows="4"  maxlength="140" id="talk"></textarea>'); 
});

$("#count").click(function(){
  page++;
  tweet(page);
});

</script>
</body>
</html>