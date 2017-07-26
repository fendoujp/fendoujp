<!DOCTYPE html>
<html lang="zh-cn">
  <?php include VIEWPATH.'mng_common/mng-head.php';?>
  <body style="overflow: hidden;background: #ccc">
      <div class="wrapper0" style="z-index: 100;">
        <div class="log-in">
              <form action="<?php echo base_url() ?>index.php/mng_login/do_login" method="post">
          <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-2">
              <div class="form-group">
                <input class="form-control block" name="admin_username" value="" type="text" placeholder="Account" />
              </div>
              <div class="form-group">
                <input type="password" class="form-control block" name="admin_password" value="" type="text" placeholder="Password" />
              </div>
            </div>
            <div class="col-sm-5">
              <button type="submit" data-action="submit" class="btn btn-default sign-in block">
                <i class="fa fa-sign-in"></i> LOGIN
              </button>
            </div>
            <input type="hidden" name="login_token" value="<?php echo $login_token ?>"/ >
          </div>
            </form>
        </div>
      </div>
      <div class="line-top2 block" style="background: #fcfcfc;z-index: -1"></div>
      <div class="login-text" style="z-index: ">正在登录...</div>
      <div class="log-in-icon">
        <i class="fa fa-exclamation"></i>
      </div>
  </body>

</html>
<script>
  $('form').on('submit', function(event){
    event.preventDefault();
    var acc = $('input[name="admin_username"]').val();
    var pwd = $('input[name="admin_password"]').val();
    var token = $('input[name="login_token"]').val();
    var _this = this;
    
    submitWaiting({
      text : ' ',
      form : _this
    });
    
    $(this).find('button').loading(1);
    
    $('.login-text').text('正在登录...');
    $('.login-text').display('block');
    
    $.ajax({
      type : 'post',
        url : base_url + 'mng_login/do_login',
        data : { 
          admin_username : acc,
          admin_password : pwd,
          login_token : token,
          },
        success : function(response) {
          later(function(){
            submitOver({
              html : '<i class="fa fa-sign-in"></i> LOGIN',
              form : _this
            });
            
            if('1' == $.trim(response)) {
              go(base_url + 'mng_home/index');
            } else {
              $('.login-text').text(response);
            }
          });
        }
    });
  });
</script>