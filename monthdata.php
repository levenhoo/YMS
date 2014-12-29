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

 <form name="myform" id="myform" method="POST">
 <div class="row-fluid">

   <div class="form-search"> 
   <!--  <span  class="label_title">公司：</span>
    <select name="company">
    <option selected="selected" value="all">全部</option>
    <option value="中山弘丰置业有限公司">中山弘丰置业有限公司</option>
    <option value="中山骏贤物业管理有限公司">中山骏贤物业管理有限公司</option>
    <option value="中山市巴克斯红酒雪茄有限公司">中山市巴克斯红酒雪茄有限公司</option> 
    </select> -->
            
                   
    <span class="label_title">年份</span>
    <select class="span2" name="year">  <option value="">请选择</option>
    <option value="2012">2012</option>
    <option value="2013">2013</option>
    <option value="2014">2014</option>
    <option value="2015">2015</option>  
    </select>

    <span  class="label_title">月份：</span>
    <select class="span2" name="month"><option value="">请选择</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>   
    </select>

    <input class="btn" type="button" name="lianSave" value="查询" id="lianSave" />  
    </div>  
</div> 
<div class="space-10"></div>

<div class="row-fluid">
    <div class="span12">
        
        <table id="table_bug_report" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                   
                    <!-- <th>公司</th> -->
                    <th>姓名</th>
                    <th >事假</th>
                    <th >病假</th>
                    <th >迟到/早退</th>
                    <th >旷工</th>
                 
                 
                </tr>
            </thead>
                                    
            <tbody>
            
            <?  

            $mysql = new Mysql;
            $mysql -> connect();
            $sql = "select * from ym_staff where status = 1 and ( staffname <> '梁崇进' and staffname <> '柳志彬' )  order by company asc ,sequence desc  , department asc   ";
            $resultStaff = $mysql -> select($sql);

             for ($i=0; $i < count($resultStaff); $i++) { 
                
                $dataid = $resultStaff[$i]['id']; 
                $staffname = $resultStaff[$i]['staffname'];  
                $company = $resultStaff[$i]['company'];  
             ?> 

                <tr> 
                   <!--  <td class="hidden-480" title="<? echo $department; ?>"><? echo $company; ?></td> -->
                    <td><? echo $staffname; ?><input type="hidden" name="dataid[]" value="<?=$dataid?>"></td>
                    <td ><input name="sj[]"></td>
                    <td ><input name="bj[]"></td>
                    <td ><input name="cd[]"></td>
                    <td ><input name="kg[]"></td> 
                </tr>
                <?}?>               
            </tbody>
        </table>
         
    </div><!--/span-->
</div><!--/row-->
 
              

<!-- PAGE CONTENT ENDS HERE -->
                         </div><!--/row-->

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
   <script> 
$("#lianSave").click( function(){
$("#showdiv").load("../handler/monthsave.php",$("#myform").serializeArray());
});
</script>








  </body>
</html>