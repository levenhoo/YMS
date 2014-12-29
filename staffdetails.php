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
        <li><a href="#">员工资料</a> </li>
      </ul> 
 

      <!-- webside -->

              
       
  <form class="form-horizontal" id="myform" name="myform">
   
    <!--  -->
    <?


      $dataid =    trim ( $_GET["dataid"] ) == "" ? ""  : trim ( $_GET["dataid"] );


      if( !empty( $dataid ) )
      {
        $mysql = new MYsql;
        $mysql -> connect();
        $sql = "select * from ym_staff where id = $dataid ";

        $result = $mysql -> select ($sql);

        $address = $result[0]["address"];
        $birthplace = $result[0]["birthplace"];
        $birthday = CommonSystem::DateFormat( $result[0]["birthday"] )  == "1970-01-01" ? "" : CommonSystem::DateFormat( $result[0]["birthday"] ); 
        $contract_start =CommonSystem::DateFormat( $result[0]["contract"] )  == "1970-01-01" ? "" :  $result[0]["contract"] ; 
        $contract_end =CommonSystem::DateFormat( $result[0]["contractend"] )  == "1970-01-01" ? "" :  $result[0]["contractend"] ; 
        $memo = $result[0]["memo"];
        $degree = $result[0]["degree"];
        $idnumber = $result[0]["idnumber"];
        $jobdate = CommonSystem::DateFormat($result[0]["jobdate"])  == "1970-01-01" ? "" :  $result[0]["jobdate"] ; 
        $jobtype = $result[0]["jobtype"];
        $phone = $result[0]["phone"];
        $school = $result[0]["school"];
        $sex = $result[0]["sex"];
        $staffno = $result[0]["staffno"];
        $staffname = $result[0]["staffname"];
        $dataid = $result[0]["id"];
        $status = $result[0]["status"];
        $department = $result[0]["department"];
        $company = $result[0]["company"];
        $testtime = $result[0]["testtime"];
        $testpass = $result[0]["testpass"];
        $position = $result[0]["s_position"];
        $sequence = $result[0]["sequence"];
        $leavedate =  $result[0]["leavedate"] == "1970-01-01" ? "" :  $result[0]["leavedate"] ; 


        //echo $result[0]["truejobdate"];
    }
    ?>




    <div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">个人信息</a></li>
    <li><a href="#tab2" data-toggle="tab">公司信息</a></li>
  </ul>


  
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">

      <!-- employee infomation -->
  <input type="hidden" name="dataid" value="<?=$dataid?>" />


    <!-- 个人信息 -->
    <div class="control-group">
      <label class="control-label" for="form-field-1">姓名</label>
      <div class="controls">
        <input type="text" id="staffname" name="staffname" placeholder="员工姓名" value="<?=$staffname?>" >
        <span class="help-inline">必须填写</span>
      </div>
    </div>


  <div class="control-group">
      <label class="control-label" for="form-field-1">性别</label>
      <div class="controls">
        <select id="sex" name="sex" >
        <option value="男" <? if ($sex=='男') echo 'selected'; ?>>男</option>
        <option value="女" <? if ($sex=='女') echo 'selected'; ?>>女</option></select>
      </div>
    </div>
 
      <div class="control-group">
      <label class="control-label" for="form-field-1">生日</label>
      <div class="controls">
          <div class="input-append date">
          <input onclick="WdatePicker();"  class="span10 date-picker" id="birthday"  name="birthday" type="text"  placeholder="生日" data-date-format="yyyy-mm-dd" value="<?=$birthday?>" >
          <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
      
      </div>
    </div>       
          
               
    <div class="control-group">
      <label class="control-label" for="form-field-1">籍贯</label>
      <div class="controls">
        <input type="text" id="birthplace"  name="birthplace" placeholder="籍贯" value="<?=$birthplace?>" >
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="form-field-1">户口所在地</label>
      <div class="controls">
        <input class="span6" type="text" id="address"  name="address" placeholder="户口所在地" value="<?=$address?>" >
      </div>
    </div>
     
    <div class="control-group">
      <label class="control-label" for="form-field-1">身份证号码</label>
      <div class="controls">
        <input type="text" id="idnumber"  name="idnumber" placeholder="身份证号码" value="<?=$idnumber?>" >
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="form-field-1">联系电话</label>
      <div class="controls">
        <input type="text" id="phone"  name="phone" placeholder="联系电话" value="<?=$phone?>" >
      </div>
    </div>


    <div class="control-group">
      <label class="control-label" for="form-field-1">学历</label>
      <div class="controls">
      <select   id="degree"  name="degree" data-placeholder="选择学历...">
            <option value=""></option>
            <option value="小学" <? if ($degree=='小学') echo 'selected'; ?>>小学</option>
            <option value="初中" <? if ($degree=='初中') echo 'selected'; ?>>初中</option>
            <option value="高中" <? if ($degree=='高中') echo 'selected'; ?>>高中</option> 
            <option value="大专" <? if ($degree=='大专') echo 'selected'; ?>>大专</option>
            <option value="本科" <? if ($degree=='本科') echo 'selected'; ?>>本科</option>
            </select>
  
      </div>
    </div>
      


        <div class="control-group">
      <label class="control-label" for="form-field-1">毕业学院</label>
      <div class="controls">
        <input type="text" id="school"  name="school" placeholder="毕业学院" value="<?=$school?>" >
      </div>
    </div>




     
    </div>
    <div class="tab-pane" id="tab2">

      <!-- company infomation -->
     <!-- 公司信息 -->

  <div class="control-group">
      <label class="control-label" for="form-field-1">公司</label>
      <div class="controls">
        <select id="company" name="company" >
        <option value="中山弘丰置业有限公司" <? if ($company=='中山弘丰置业有限公司') echo 'selected'; ?>>中山弘丰置业有限公司</option>
        <option value="中山骏贤物业管理有限公司" <? if ($company=='中山骏贤物业管理有限公司') echo 'selected'; ?>>中山骏贤物业管理有限公司</option>
        <option value="中山市巴克斯红酒雪茄有限公司" <? if ($company=='中山市巴克斯红酒雪茄有限公司') echo 'selected'; ?>>中山市巴克斯红酒雪茄有限公司</option></select>
      </div>
    </div>




         
       




      <div class="control-group">
      <label class="control-label" for="form-field-1">入职日期</label>
      <div class="controls">
        <div class="input-append date">
          <input onclick="WdatePicker();"  class="span10 date-picker"   name="jobdate" value="<?=$jobdate?>"  placeholder="入职日期" id="jobdate" type="text" data-date-format="yyyy-mm-dd">
          <span class="add-on"><i class="icon-calendar"></i></span>    </div>  
          <input class="span1"  name="testtime"  type="text"  placeholder="试用期" value="<?=$testtime?>" >
          <input <? if($testpass==1) echo 'checked';?> name="testpass" class="ace-switch ace-switch-6" type="checkbox"><span class="lbl"></span>
          <span class="help-inline">是否通过</span>
           
      </div>
    </div>       

    <div class="control-group">
      <label class="control-label" for="form-field-1">用工形式</label>
      <div class="controls">
      <select   id="jobtype"  name="jobtype" data-placeholder="用工形式..."> 
            <option value="全职"  <? if ($jobtype=='全职') echo 'selected'; ?> >全职</option>
            <option value="时薪"  <? if ($jobtype=='时薪') echo 'selected'; ?> >时薪</option>
            </select>
  
      </div>
    </div>

  <div class="control-group">
      <label class="control-label" for="form-field-1">劳动合同期限</label>
      <div class="controls">
          <div class="input-append date">
          <input onclick="WdatePicker();"  class="span10 date-picker" value="<?=$contract_start?>"  placeholder="开始"   name="contract" type="text" data-date-format="yyyy-mm-dd">
          <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
          <div class="input-append date">
          <input onclick="WdatePicker();"  class="span10 date-picker" value="<?=$contract_end?>"  placeholder="结束"   name="contractend" type="text" data-date-format="yyyy-mm-dd">
          <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
      </div>
    </div>       

    <div class="control-group">
      <label class="control-label" for="form-field-1">部门/职位</label> 
      <div class="controls">
        <select   id="department"  name="department" data-placeholder="部门..."> 
            <option value="总经办" <?if($department=="总经办") echo 'selected';?>>总经办</option>
            <option value="财务部" <?if($department=="财务部") echo 'selected';?>>财务部</option>
            <option value="工程部" <?if($department=="工程部") echo 'selected';?>>工程部</option>
            <option value="物业部" <?if($department=="物业部") echo 'selected';?>>物业部</option>
            <option value="保安部" <?if($department=="保安部") echo 'selected';?>>保安部</option>
            <option value="维修部" <?if($department=="维修部") echo 'selected';?>>维修部</option>
            <option value="销售部" <?if($department=="销售部") echo 'selected';?>>销售部</option>
            <option value="绿化部" <?if($department=="绿化部") echo 'selected';?>>绿化部</option>
            <option value="保洁部" <?if($department=="保洁部") echo 'selected';?>>保洁部</option>
            </select>
        <input value="<?=$position?>" class="span2" type="text" id="form-field-1"  name="position" placeholder="职位">
      </div>
    </div> 
     

     <div class="control-group">
      <label class="control-label" for="form-field-1">工作证编号</label>
      <div class="controls">
        <input value="<?=$staffno?>"  placeholder="工作证编号" id="staffno"  name="staffno" type="text"  > 
      </div>
    </div>      

     <div class="control-group">
      <label class="control-label" for="form-field-1">备注说明</label>
      <div class="controls">
        <textarea class="autosize-transition" id="memo"  name="memo" placeholder="备注说明" ><?=$memo?></textarea>
            
      </div>
    </div>      
    
    <div class="control-group">
      <label class="control-label" for="form-field-1">状态</label>
      <div class="controls">
      <select   id="status"  name="status" > 
            <option value="1" <? if(isset($status)) if($status==1) echo 'selected';?> >在职</option>
            <option value="0" <? if(isset($status)) if($status==0) echo 'selected';?> >离职</option>
            </select>
  
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="form-field-1">离职日期</label>
      <div class="controls">
          <div class="input-append date">
          <input onclick="WdatePicker();"  value="<?=$leavedate?>" class="span10 date-picker" id="leavedate"  name="leavedate" type="text"  placeholder="离职日期" data-date-format="yyyy-mm-dd">
          <span class="add-on"><i class="icon-calendar"></i></span>
          </div>   
      </div>
    </div>       


     <div class="control-group">
      <label class="control-label" for="form-field-1">排序</label>
      <div class="controls">
        <input value="<?=$sequence?>"  placeholder="排序"  name="sequence" type="text"  > 
      </div>
    </div>    

    <!-- //公司信息 -->

    </div>
  </div>
</div> 
  

    <div class="form-actions">
      <button id="lianSave" class="btn btn-info" type="button"><i class="icon-ok"></i> 保存</button>
      &nbsp; &nbsp; &nbsp;
      <button class="btn" type="button" onclick="history.go(-1)"><i class="icon-repeat"></i> 返回</button>
    </div>

  
    <div id="lianshowdiv"></div>

    <!-- －－－－－－－－－－－－－ end －－－－－－－－－－－－－－－－ -->
 
    </form> 

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

<script language="javascript" type="text/javascript" src="/js/My97DatePicker/WdatePicker.js"></script>
<script> 
 
$("#lianSave").click( function(){
$("#showdiv").load("handler/staffsave.php",$("#myform").serializeArray());
});
</script>
  </body>
</html>