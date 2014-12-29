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
        <li><a href="#">奖罚</a> </li>
      </ul> 
 

      <!-- webside -->
      

              
       
<div class="row-fluid">
    
    <div class="span12">

        <table id="table_bug_report" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:20px">
                        <label><input type="checkbox" /><span class="lbl"></span></label>
                    </th>
                    <th style="width:150px">日期</th>
                    <th>姓名</th>
                    <th style="width:150px">奖罚</th>
                    <th style="width:50px">得分</th> 
                </tr>
            </thead>
                                    
            <tbody>
            
            <? 

            $cur = empty ( $_REQUEST["cur"] ) ?  1 : $_REQUEST["cur"] ;
            $max =  empty ( $_REQUEST["max"] ) ?  10 : $_REQUEST["max"] ;


            $mysql = new Mysql;
            $mysql -> connect();
            $startPage = ($cur - 1) * $max ; 

            $sql = "select (select staffname from ym_staff where ym_staff.id = ym_event.staffid) sn, ym_event.* from ym_event order by id desc ";
            $sql .= $limit;
            $resultStaff = $mysql->select($sql); 

            $totalResult = $mysql -> select ( "select count(*) from ym_event " );
            //$cur = 1; $max = 10;

         

           for ($i=0; $i < count($resultStaff); $i++) { 
                
                $dataid = $resultStaff[$i]['id']; 
                $staffname = $resultStaff[$i]['sn']; 
                $eventtype = $resultStaff[$i]['eventtype'];
                $eventnumber = $resultStaff[$i]['eventnumber'];
                $eventdate =  CommonSystem::DateFormat( $resultStaff[$i]['eventdate'] ); 

             ?> 

                <tr>
                    <td><label><input type='checkbox' /><span class="lbl"></span></label></td> 
                    <td><? echo $eventdate; ?></td>
                    <td><? echo $staffname; ?></td> 
                    <td><? echo $eventtype; ?></td>
                    <td><? echo $eventnumber; ?></td>
                    
                </tr>
                <?}?>               
            </tbody>
        </table>
    </div><!--/span-->
</div><!--/row-->

<div class="pagination">
              <form name="ActionForm" method="get">

             <?
                include_once 'include/page.php';  
                $pager = new Pager ;
                $pager -> InitPage( $totalResult[0][0] ,$cur , $max);
                $pager -> pr(); 
            ?>
 
              </form>
</div>







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
      
        $(".pagination").find('a').bind('click', function() { 
           var a = $(this).attr("alt");
           if(a=="") return false; 
            $("#cur").val(a);
          ActionForm.submit();
        });

       
    </script>
  
  </body>
</html>