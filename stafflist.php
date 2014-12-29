<?   include_once './include/common.php'; 

    $cur =  empty ( $_REQUEST["cur"] ) ?  1 : $_REQUEST["cur"] ;
    $max =  empty ( $_REQUEST["max"] ) ?  10 : $_REQUEST["max"] ;
    //$company =  empty ( $_REQUEST["company"] ) ?  ""10"" : $_REQUEST["company"] ;
    
    $company = trim($_REQUEST["company"]);
    $status = trim($_REQUEST["status"]) == "" ? "1" : trim($_REQUEST["status"]) ;
    $turnon = trim($_REQUEST["turnon"]);
    $sataffname = trim($_REQUEST["sataffname"]);

    $where = " 1=1 ";
    
    if( !empty( $company ) )
        $where .= " and company = '".$company."' ";
    if( $status != "all" )
        $where .= " and status = ".$status." ";
    if( $turnon != "" )
        $where .= " and testpass = ".$turnon." ";
    if( !empty( $sataffname ) )
        $where .= " and staffname like '%".$sataffname."%' ";

    $mysql = new Mysql;
    $mysql -> connect();
    $startPage = ($cur - 1) * $max ; 
    $limit = " limit $startPage ,  $max  ";
    $sql = "select (select count(*) from ym_event where  ym_event.staffid = ym_staff.id ) totaleven , ym_staff.* from ym_staff  
    where $where  order by  sequence desc ,company asc , id desc ";
    $sql .= $limit;
    $resultStaff = $mysql->select($sql); 
 
    //echo $sql;

    $totalResult = $mysql -> select ( "select count(*) from ym_staff where $where " );
?>
<!DOCTYPE html>
<html>
  <head>
    <title>YMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    
    <!-- basic style -->
    <?php  include_once 'include/com_basicStyle.php';  ?>
    <style type="text/css">
    #page-body{ background: #fff; }
    </style>
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
        <li><a href="#">员工管理</a> </li>
      </ul> 
 

      <!-- webside -->


              
  <form name="ActionForm" id="ActionForm" method="post" action="">   

<div class="form-search">

    <span class="label_title">姓名：</span> 
    <input name="sataffname" type="text" class="text" value="<?=$sataffname?>" />
    
    <span  class="label_title">公司：</span>
    <select name="company" >
    <option value="">全部</option>
    <option value="中山弘丰置业有限公司"   <? if($company=="中山弘丰置业有限公司") echo 'selected';?> >中山弘丰置业有限公司</option>
    <option value="中山骏贤物业管理有限公司"   <? if($company=="中山骏贤物业管理有限公司") echo 'selected';?> >中山骏贤物业管理有限公司</option>
    <option value="中山市巴克斯红酒雪茄有限公司"   <? if($company=="中山市巴克斯红酒雪茄有限公司") echo 'selected';?> >中山市巴克斯红酒雪茄有限公司</option> 
    </select>
            
                   
    <span class="label_title">状态：</span>
    <select class="span1" name="status" >
    <option value="all"  <? if($status=="all") echo 'selected';?> >全部</option>   
    <option value="1" <? if($status=="1") echo 'selected';?> >在职</option> 
    <option value="0" <? if($status=="0") echo 'selected';?> >离职</option>    
   
    </select>

    <span  class="label_title">转正：</span>
    <select class="span1" name="turnon">
    <option value="">全部</option>
    <option value="1"  <? if($turnon=="1") echo 'selected';?> >是</option>
    <option value="0"  <? if($turnon=="0") echo 'selected';?> >否</option> 
    </select>

    <button type="button" class="btn"  id="search">查询</button> 
    <button type="button" class="btn btn-inverse" id="excel">导出EXCEL</button> 

    <p class="pull-right">
        <a href="staffdetails.php" style="padding-left: 20px; " title="新员工入职"  >
        <img src="/images/icon/user-option-add.png" alt="添加新员工"/> 新入职</a>
        <img src="/images/icon/user_suit.png" /> <? echo $totalResult[0][0]; ?>
    </p>

</div>
   
                   
<div class="space-10" ></div> 
 

<div class="row-fluid">
    <div class="span12">

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="hidden-phone center">
                    <label><input type="checkbox" /><span class="lbl"></span></label>
                    </th>
                    <th class="hidden-phone">公司</th>
                    <th>姓名</th>
                    <th class="hidden-480">工号</th>
                    <th class="hidden-480">电话</th>
                    <th class="hidden-480">年资</th>
                    <th class="hidden-phone">年假</th>
                    <th class="hidden-phone">奖罚</th>
                    <th class="hidden-phone"><i class="icon-time hidden-phone"></i>转正日期</th>
                    <th class="hidden-phone"><i class="icon-time hidden-phone"></i>下次续约</th>                   
                    <th class="hidden-phone">状态</th>
                    <th class='hidden-phone'>操作</th>
                </tr>
            </thead>
                                    
            <tbody>
            
            <?  

           for ($i=0; $i < count($resultStaff); $i++) { 
                
                $dataid = $resultStaff[$i]['id']; 
                $staffname = $resultStaff[$i]['staffname']; 
                $company = $resultStaff[$i]['company'];
                $department = $resultStaff[$i]['department'];
                $staffno = $resultStaff[$i]['staffno'];
                $phone = $resultStaff[$i]['phone'];
                $jobdate = $resultStaff[$i]['jobdate'];
                $truejobdate = $resultStaff[$i]['truejobdate'];
                $contractend = $resultStaff[$i]['contractend'];
                $totalevent = $resultStaff[$i]['totalevent'];
                $status = $resultStaff[$i]['status']=="1"?"在职":"离职";

             ?> 

                <tr>
                    <td class='hidden-phone center'>
                    <label><input type='checkbox' /><span class="lbl"></span></label>
                    </td>

                    <td class="hidden-phone" title="<? echo $department; ?>"><? echo $company; ?></td>
                    <td>
                    <a href="staffdetails.php?dataid=<?=$dataid?>" class="tooltip-success" data-rel="tooltip" title="详细资料" data-placement="left"><? echo $staffname; ?></a>
                    </td>


                    <td class="hidden-480">
                        <? echo $staffno; ?>
                    </td>
                    <td class="hidden-480"><? echo $phone; ?></td>
                    <td class="hidden-480"><span class="badge badge-info"><? echo JobYear($jobdate); ?></span></td>
                    <td class="hidden-phone"><span class="badge badge-info"><? echo JobVacation($jobdate); ?></span></td>
                    <td class="hidden-phone"><? echo $totalevent; ?></td>
                    <td class="hidden-phone"><? echo $truejobdate; ?></td>
                    <td class="hidden-phone"><? echo $contractend; ?></td>     
 
                    <td class='hidden-phone'><span class='label <?if ($status=="在职") echo 'label-success'; else echo 'label-warning'; ?>  '><? echo $status; ?></span></td>
                    <td class='hidden-phone'><a href="staffeventdetails.php?dataid=<?=$dataid?>" class="tooltip-success" data-rel="tooltip" title="奖罚" data-placement="left"><i class="icon-edit"></i></a>                                                          
                         
                    </td>
                </tr>
                <?}?>               
            </tbody>
        </table>
    </div><!--/span-->
</div><!--/row-->

<div class="pagination" id="pagination"> 
             <?
                include_once 'include/page.php';  
                $pager = new Pager ;
                $pager -> InitPage( $totalResult[0][0] ,$cur , $max);
                $pager -> pr(); 
            ?> 
</div>



</form>



      <!-- webside end //-->  


        </div><!--/row-->
      </div><!--/span--> 

        <!--content//--> 

      </div><!--/row-->
      
      <!-- FOOT -->
      <?php  include 'include/com_footer.php';  ?>
</div> <!-- body end -->

      <!-- basic script -->
      <?php  include 'include/com_basicScript.php';  ?>
     <script>
      
        $("#pagination").find('a').bind('click', function() { 
           var a = $(this).attr("alt");
           if(a=="") return false; 
           $("#cur").val(a);
           $('#ActionForm').attr('action','stafflist.php'); 
           ActionForm.submit();
        });

        $("[title=Delete]").click( function() { 
                //alert("delete");
            if(confirm("are you sure datele date")){
                var dataid = $(this).attr("alt");
                $("#lianshowdiv").load("../handler/staffdelete.php?dataid="+dataid); 
            }
        });

        $("#search").click( function() {   
                ActionForm.submit(); 
        }); 
         $("#excel").click( function() {  
                $('#ActionForm').attr('action','../handler/excelStaff.php');                 
                ActionForm.submit();
                $('#ActionForm').attr('action','');             
        });
    </script>
  </body>
</html>