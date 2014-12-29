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
   
    <!--  -->
    <?


      $dataid =    trim ( $_GET["dataid"] ) == "" ? ""  : trim ( $_GET["dataid"] );


      if( !empty( $dataid ) )
      {
        $mysql = new MYsql;
        $mysql -> connect();
        $sql = "select * from ym_remind where id = $dataid ";

        $result = $mysql -> select ($sql);


        $finishdate =CommonSystem::DateFormat( $result[0]["finishdate"] )  == "1970-01-01" ? "" : CommonSystem::DateFormat($result[0]["finishdate"] ); 
        $dataid = $result[0]['id']; 
                $title = $result[0]['title']; 
                $status = $result[0]['status'];
              $memo = $result[0]['memo']; 
    }
    ?>
    <input type="hidden" name="dataid" value="<?=$dataid?>" />


    <!-- 个人信息 -->
    <div class="control-group">
      <label class="control-label" for="form-field-1">提醒事项</label>
      <div class="controls">
        <input type="text" id="title" name="title" placeholder="事项" value="<?=$title?>" >
        <span class="help-inline">必须填写</span>
      </div>
    </div>


     <div class="control-group">
      <label class="control-label" for="form-field-1">备注说明</label>
      <div class="controls">
        <textarea class="span8" id="memo"  name="memo" placeholder="备注说明" ><?=$memo?></textarea> 
      </div>
    </div>       


    <div class="control-group">
    <label class="control-label" for="form-field-1">状态</label>
      <div class="controls"> 
    <select name="status">
    <option value="0" <? if($status==0) echo 'selected';?> >等待</option>
    <option value="1" <? if($status==1) echo 'selected';?> >完成</option></select>   
      </div>
    </div>
 
    <div class="control-group">
    <label class="control-label" for="form-field-1">提醒日期</label>
      <div class="controls">
      <div class="input-append date">
      <input onclick="WdatePicker();"  class="span10 date-picker" name="finishdate" type="text"  placeholder="提醒日期" data-date-format="yyyy-mm-dd" value="<?=$finishdate?>" >
      <span class="add-on"><i class="icon-calendar"></i></span>
      </div> 
      </div>
    </div>       
            

    <div class="form-actions">
      <button id="lianSave" class="btn btn-info" type="button"><i class="icon-ok"></i> 保存</button>
      &nbsp; &nbsp; &nbsp;
      <button class="btn" type="button" onclick="history.go(-1);"><i class="icon-repeat"></i> 返回</button>
    </div>

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
  <script language="javascript" type="text/javascript" src="js/My97DatePicker/WdatePicker.js"></script>

<script> 
$("#lianSave").click( function(){
$("#showdiv").load("../handler/remindsave.php",$("#myform").serializeArray());
});
</script>
  </body>
</html>