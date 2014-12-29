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
        <li><a href="#">提醒事项</a> </li>
      </ul> 
 

      <!-- webside -->


              
<div class="form_search"> <a href="reminddetails.php" class="btn">增加项目</a></div>      
<div class="space-10"></div>
<div class="row-fluid"> 
 
    <div class="span12">

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:25px" class="center"><input type="checkbox" /></th>
                    <th style="width:150px">日期</th>
                    <th>提醒事项</th>
                    <th style="width:50px">状态</th>
                    <th style="width:50px">操作</th> 
                </tr>
            </thead>
            <? 

            $cur = empty ( $_REQUEST["cur"] ) ?  1 : $_REQUEST["cur"] ;
            $max =  empty ( $_REQUEST["max"] ) ?  10 : $_REQUEST["max"] ;


            $mysql = new Mysql;
            $mysql -> connect();
            $startPage = ($cur - 1) * $max ; 

            $limit = " limit $startPage ,  $max  ";
            $sql = "select * from ym_remind  order by  id desc ";
            $sql .= $limit;
            $resultStaff = $mysql->select($sql); 

            $totalResult = $mysql -> select ( "select count(*) from ym_remind " );
            //$cur = 1; $max = 10;

           

           for ($i=0; $i < count($resultStaff); $i++) { 
                
                $dataid = $resultStaff[$i]['id']; 
                $title = $resultStaff[$i]['title']; 
                $status = $resultStaff[$i]['status'] == 0 ? "等待" : "完成";
                $finishdate =  CommonSystem::DateFormat( $resultStaff[$i]['finishdate'] ); 

                
             ?> 
             <tbody>
                <tr>
                    <td class='center'><label><input type='checkbox' /><span class="lbl"></span></label></td> 
                    <td><? echo $finishdate; ?></td>
                    <td class="">
                      <a href="reminddetails.php?dataid=<?=$dataid?>"><? echo $title; ?></a>
                      </td> 
                    <td><? echo $status; ?></td>
                    <td>
                        <a href="#" title="Delete" alt="<?=$dataid?>">删除</a>
                    </td>
                    
                </tr>
              </tbody>
                <?}?>               
           
        </table>
   </div>
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

        $("[title=Delete]").click( function() { 
                //alert("delete");
            if(confirm("你系咪确定删除架？")){
                var dataid = $(this).attr("alt");
                //alert(dataid);
                $("#showdiv").load("../handler/reminddelete.php?dataid="+dataid); 
            }
        });
    </script>
  </body>
</html>