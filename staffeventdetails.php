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
        <li><a href="#">奖罚明细</a> </li>
      </ul> 
 

      <!-- webside -->
      

              
       
<div class="row-fluid">
<!-- PAGE CONTENT BEGINS HERE -->

  <form class="form-horizontal" id="myform" name="myform">
   
    <!--  -->
    <?


      $dataid = trim ( $_GET["dataid"] ) == "" ? ""  : trim ( $_GET["dataid"] );


      if( !empty( $dataid ) )
      {
        $mysql = new MYsql;
        $mysql -> connect();
        $sql = " select staffname from ym_staff where  id = $dataid ";

        $result = $mysql -> select ($sql);  
                $staffname = $result[0]['staffname']; 
          
    }
    ?>
    <input type="hidden" name="dataid" value="<?=$dataid?>" /> 

    <!-- 个人信息 -->
    <div class="control-group">
      <label class="control-label" for="form-field-1">姓名</label>
      <div class="controls">
        <input type="text" id="staffname" name="staffname" placeholder="姓名" value="<?=$staffname?>" >
        <!-- <span class="help-inline">必须填写</span> -->
      </div>
    </div>


     <div class="control-group">
      <label class="control-label" for="form-field-1">备注说明</label>
      <div class="controls">
        <textarea class="span8"  name="eventmemo" placeholder="备注说明" ><?=$memo?></textarea>
            
      </div>
    </div>      




  <div class="control-group">
      <label class="control-label" for="form-field-1">奖罚</label>
      <div class="controls"> 
      <select name="eventtype">
      <option value="书面嘉奖">书面嘉奖</option>
      <option value="记小功">记小功</option>
      <option value="记大功">记大功</option>
      <option value="晋薪">晋薪</option>
      <option value="晋职">晋职</option>
      <option value="书面警告">书面警告</option>
      <option value="记小过">记小过</option>
      <option value="记大过">记大过</option>
      <option value="降职">降职</option>
      <option value="解雇">解雇</option>
      </select>   
      </div>
    </div>
 
      <div class="control-group">
      <label class="control-label" for="form-field-1">日期</label>
      <div class="controls">
          <div class="input-append date">
          <input onclick="WdatePicker();"  class="span10 date-picker" name="eventdate" type="text"  placeholder="日期" data-date-format="yyyy-mm-dd" value="<?=$eventdate?>" >
          <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
      
      </div>
    </div>       
            

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
 <script language="javascript" type="text/javascript" src="js/My97DatePicker/WdatePicker.js"></script> 
<script> 
$("#lianSave").click( function(){
$("#showdiv").load("../handler/eventsave.php",$("#myform").serializeArray());
});
</script>
  </body>
</html>