<?   include_once './include/common.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>YMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    
    <!-- basic style -->
    <?php  include_once 'include/com_basicStyle.php';  ?>
 
  </head>

  <body> 

    <!-- nav -->
    <?php  include_once 'include/com_nav.php';  ?>
    <!-- nav //-->

 
 <div class="container-fluid"><!-- body -->


      <div class="row-fluid">
 

      <!-- content -->
      <div class="span12">
        <div class="row-fluid">
           

      <ul class="breadcrumb">
        <li><a href="#">系统管理</a> <span class="divider">/</span></li>
        <li><a href="#"> </a> </li>
      </ul> 
 

      <!-- webside -->
      

              
       <div class="row-fluid">
<!-- PAGE CONTENT BEGINS HERE -->

  <form class="form-horizontal" id="myform" name="myform"> 
   
    <input type="hidden" name="dataid" value="<?=$dataid?>" />


    <!-- 个人信息 -->
    <div class="control-group">
      <label class="control-label" for="form-field-1">原始密码</label>
      <div class="controls">
        <input type="password" id="curpwd" name="curpwd" placeholder="原始密码" value="<?=$staffname?>" >
        <span class="help-inline">原始密码</span>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="form-field-1">新密码</label>
      <div class="controls">
        <input type="password" id="newpwd" name="newpwd" placeholder="新密码" value="<?=$staffname?>" >
        <span class="help-inline">大于5位的</span>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="form-field-1">再输入一次</label>
      <div class="controls">
        <input type="password" id="repwd" name="repwd" placeholder="再输入一次新密码" value="<?=$staffname?>" >
         
      </div>
    </div>
 

    <!-- //公司信息 -->


    <div class="form-actions">
      <button id="lianSave" class="btn btn-info" type="button"><i class="icon-ok"></i> Submit</button>
      &nbsp; &nbsp; &nbsp;
      <button class="btn" type="reset"><i class="icon-repeat"></i> Reset</button>
    </div>

  
    <div id="lianshowdiv"></div>

    <!-- －－－－－－－－－－－－－ end －－－－－－－－－－－－－－－－ -->
 
    </form></div>

 

      <!-- webside end //-->  


        </div><!--/row-->
      </div><!--/span--> 

        <!--content//--> 

      </div><!--/row-->
      
      <!-- FOOT -->
      <?php  include_once 'include/com_footer.php';  ?>
</div> <!-- body end -->

      <!-- basic script -->
      <?php  include_once 'include/com_basicScript.php';  ?>
  <script> 
$("#lianSave").click( function(){ 
  if( checkpwd() )
    $("#showdiv").load("../handler/passwordsave.php",$("#myform").serializeArray());
});

 function checkpwd()
    {
        var cp = $("#curpwd").val();
        var np = $("#newpwd").val();
        var rp = $("#repwd").val(); 
        
       if(cp.length < 6  || cp.lenght > 32)  
        {
            //alert (" Please specify the correct current password. "); 
            alert (" 请输入当前使用的密码. "); 
            $("#curpwd").focus();return false;
        }
        
        if(np.length < 6  || np.lenght > 32)
        {
            //alert("Your password must be 6 to 32 characters long");
            alert("新密码必须是大于5位的字母或者数字组合");
            $("#newpwd").focus();
            return false;
        }
         
        if( np != rp){
            //alert("The passwords you entered do not match. Please try again.");
            alert("两次输入的密码不相同.");
             $("#repwd").focus();return false;
        } 
         
        return true;
    }    

</script>
  </body>
</html>