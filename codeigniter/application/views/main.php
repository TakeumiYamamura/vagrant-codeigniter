<html>
<head>
  <title>twitter掲示板ver山村</title>
  <style>
  body { 
    background-image: url(<?php echo(base_url("images/hanabi.jpg"));?>);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
  }
  #tweet {
    text-shadow: 3px 3px 5px black;
    text-align: center;
    color: white;
  }
  p {
    text-align: center;
    color: white;
  }
  legend{
    color: white;
  }
  </style>
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
<div id="message">
  <p>ロード中です</p>
</div>
<button id="count">もっと見る</button><dt>
<p>
  <a href="<?php echo(base_url("index.php/twittermain/logout"));?>">ログアウト</a>
</p>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
const base_page = 1;
const base_add = 0;
var page = base_page;
var add = base_add;
var html = '';

function tweet(t, a){
  $.ajax({
    url: '/index.php/twittermain/get_list/',
    dataType: 'json',
    type: "POST",
    data: {page : t, add : a, <?php echo($this->security->get_csrf_token_name());?> : '<?php echo($this->security->get_csrf_hash());?>' },
    async: true,
    success: function(json){
      for(i in json){
        var now = new Date();
        var tweettime = new Date(json[i].created);
        difference = now.getTime()-tweettime.getTime();
        if (difference > 1000*60*60*24){
          var day = Math.floor(difference /(1000*60*60*24));
          html += '<fieldset><legend>' + json[i].name + '</legend><dt><p>' + json[i].message + '</p><dt><p>' + day + '日前</p></fieldset>';
        } else if (difference > 1000*60*60){
          var hour = Math.floor(difference/(1000*60*60));
          html += '<fieldset><legend>' + json[i].name + '</legend><dt><p>' + json[i].message + '</p><dt><p>' + hour + '時間前</p></fieldset>';
        } else if(difference > 1000*60){
          var minute =Math.floor(difference/(1000*60));
          html += '<fieldset><legend>' + json[i].name + '</legend><dt><p>' + json[i].message + '</p><dt><p>' + minute + '分前</p></fieldset>';
        } else {
          var second =Math.floor(difference/(1000));
          html += '<fieldset><legend>' + json[i].name + '</legend><dt><p>' + json[i].message + '</p><dt><p>' + second + '秒前</p></fieldset>';
        }
      }
      $('#message').html('<ul>'+ html +'</ul>');
    },
    error: function(){
      alert('データの読み込みに失敗しました。');
    }  
  });
}
tweet(page, add);

$("#send_button").click(function() {
  add++;
  var m = $("#talk").val();
  if(m != ""){
    $.ajax({
      url: '/index.php/twittermain/register/',
      type : "POST",
      async: true, 
      data : {message : m, <?php echo($this->security->get_csrf_token_name());?> : '<?php echo($this->security->get_csrf_hash());?>' },
      success: function(id) {
        $.ajax({
          url:'/index.php/twittermain/get_simple/',
          dataType: 'json',
          async: true,
          success: function(json){
            var now = new Date();
            var tweettime = new Date(json[0].created);
            difference = now.getTime()-tweettime.getTime();
            if (difference > 1000*60*60*24){
              var day = Math.floor(difference /(1000*60*60*24));
              html = '<fieldset><legend>' + json[0].name + '</legend><dt><p>' + json[0].message + '</p><dt><p>' + day + '日前</p></fieldset>' + html;
            } else if (difference > 1000*60*60){
              var hour = Math.floor(difference/(1000*60*60));
              html = '<fieldset><legend>' + json[0].name + '</legend><dt><p>' + json[0].message + '</p><dt><p>' + hour + '時間前</p></fieldset>' + html;
            } else if(difference > 1000*60){
              var minute =Math.floor(difference/(1000*60));
              html = '<fieldset><legend>' + json[0].name + '</legend><dt><p>' + json[0].message + '</p><dt><p>' + minute + '分前</p></fieldset>' + html;
            } else {
              var second =Math.floor(difference/(1000)); 
              html = '<fieldset><legend>' + json[0].name + '</legend><dt><p>' + json[0].message + '</p><dt><p>' + second + '秒前</p></fieldset>' + html;
            }
           $('#message').html('<ul>'+ html +'</ul>');
           $('#delete').html('<textarea type="text" name="message" cols="60" rows="4"  maxlength="140" id="talk"></textarea>');
          }
        });
      }
    });
  }
});  

$("#count").click(function(){
  page++;
  tweet(page, add);
});

</script>
</body>
</html>