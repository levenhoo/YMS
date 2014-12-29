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


      <div class="row-fluid" id="page_content">

   

      <!-- content -->
      <div class="span12">
        <div class="row-fluid">
           

      <ul class="breadcrumb">
        <li><a href="#">系统管理</a> <span class="divider">/</span></li>
        <li><a href="#">我的工作</a> </li>
      </ul> 
 

      <!-- webside -->
      

              
       
<div class="row-fluid">
<!-- PAGE CONTENT BEGINS HERE -->

   <div class="row-fluid">

   <? 
    $tip = 14;
    $contractTip = 30;
    $last = 7;//最后三天提示紧急
    
    $today = date("Y-m-d");
    $tipDay = date("Y-m-d", strtotime("+$tip day") );
    $contractTipDay = date("Y-m-d", strtotime("+$contractTip day") );
    $lastDay = date("Y-m-d", strtotime("+$last day") );
  
 
    //echo $contractTipDay; 
   
    $sql = "select * from ym_staff where contractend is not null  and testpass = 1 and contractend <>  '' and  contractend > '1999-12-31' and
    ( '".$today."' <=   contractend  and   '".$contractTipDay."' > contractend ) and status = 1 order by  contractend asc";
    $mysql = new Mysql;
    $mysql -> connect(); 
    $result = $mysql -> select($sql) ; 
    //过期续约的
    $sql = " select * from ym_staff where contractend is not null  and testpass = 1 and contractend <>  '' and  contractend > '1999-12-31' and
    ( '".$today."' >   contractend   ) and status = 1 order by  contractend asc ";
    $overResult = $mysql -> select($sql) ; 

    if( count($result) > 0 ||  count($overResult) > 0 ){ 
   ?> 

  <div class="span3">
    <div class="widget-box">
      <div class="widget-header">
        <h5>续约名单</h5>
      <!--  <div class="widget-toolbar">
          <a href="#" data-action="settings"><i class="icon-cog"></i></a>
          <a href="#" data-action="reload"><i class="icon-refresh"></i></a>
          <a href="#" data-action="collapse"><i class="icon-chevron-up"></i></a>
          <a href="#" data-action="close"><i class="icon-remove"></i></a>
        </div> -->
      </div>
      
      <div class="widget-body">
       <div class="widget-main">

        <?
          for ($i=0; $i < count($result) ; $i++) { 
            $staffname = $result[$i]["staffname"];
            $contractend = $result[$i]["contractend"];
            $dataid = $result[$i]["id"];
            # code...
            echo "<p class=\"alert alert-info\"><a href=\"staffdetails.php?dataid=".$dataid."\">".$staffname.$contractend."</a></p>"; 
          }
        ?>

        <?
          for ($i=0; $i < count($overResult) ; $i++) { 
            $staffname = $overResult[$i]["staffname"];
            $contractend = $overResult[$i]["contractend"];
            $dataid = $overResult[$i]["id"];
            # code...
            echo "<p class=\"alert alert-error\"><a href=\"staffdetails.php?dataid=".$dataid."\">".$staffname.$contractend."</a></p>"; 
          }
        ?>
        
       
       </div>
      </div>
    </div>
  </div>
   <?  } ?>




    <!-- 转正式 -->
    <!-- 过期转正式 -->
   <?  
    $sql = "select * from ym_staff where truejobdate is not null and testpass = 0 and  truejobdate <>  '' and  
    ( '".$today."' <=   truejobdate  and   '".$tipDay."' >=  truejobdate ) and status = 1  order by  truejobdate asc";  
    $result = $mysql -> select($sql) ; 

    $sql = "select * from ym_staff where truejobdate is not null and testpass = 0  and truejobdate <>  '' and  
    ( '".$today."' >   truejobdate   ) and status = 1 order by  contractend asc ";
    $overResult = $mysql -> select($sql) ; 


    if( count($result) > 0 ||  count($overResult) > 0 ){ 
   ?> 



  <div class="span3">
    <div class="widget-box">
      <div class="widget-header">
        <h5>转正名单</h5>
      <!--  <div class="widget-toolbar">
          <a href="#" data-action="settings"><i class="icon-cog"></i></a>
          <a href="#" data-action="reload"><i class="icon-refresh"></i></a>
          <a href="#" data-action="collapse"><i class="icon-chevron-up"></i></a>
          <a href="#" data-action="close"><i class="icon-remove"></i></a>
        </div> -->
      </div>
      
      <div class="widget-body">
       <div class="widget-main">
        <!-- 准备转正的 -->
        <?
          for ($i=0; $i < count($result) ; $i++) { 
            $staffname = $result[$i]["staffname"];
            $truejobdate = $result[$i]["truejobdate"];
            $dataid = $result[$i]["id"];
            # code...
            echo "<p class=\"alert alert-info\"><a href=\"staffdetails.php?dataid=".$dataid."\">".$staffname.$truejobdate."</a></p>"; 
          }
        ?> 
        <!-- 过期的 -->
        <?
          for ($i=0; $i < count($overResult) ; $i++) { 
            $staffname = $overResult[$i]["staffname"];
            $truejobdate = $overResult[$i]["truejobdate"];
            $dataid = $overResult[$i]["id"];
            # code...
            echo "<p class=\"alert alert-error\"><a href=\"staffdetails.php?dataid=".$dataid."\">".$staffname.$truejobdate."</a></p>"; 
          }
        ?> 
       </div>
      </div>
    </div>
  </div>
    <?  } ?>
  
 
    <!-- day of birth -->
    <?

      $sql = "select * from ym_completedate where c_year = ".date("Y")." and c_month = ".date("n")."  ";
      $result = $mysql -> select($sql) ;

      if( count($result) == 0  ) { 
      $sql = "select * from ym_staff WHERE status = 1 and (birthday IS NOT NULL) AND (birthday <> '') and date_format(birthday,'%m') = ".date("m")."  ";
      $result = $mysql -> select($sql) ;  
      }else
      {
        unset($result);
      }
 

       if( count($result) > 0   ){ 

    ?>
    <div class="span3" id="dayofbirth">
    <div class="widget-box">
      <div class="widget-header">
        <h5>生日名单 <div class="widget-toolbar" style="float:right;">
        <!--   <a href="#" data-action="settings"><i class="icon-cog"></i></a>
          <a href="#" data-action="reload"><i class="icon-refresh"></i></a>
          <a href="#" data-action="collapse"><i class="icon-chevron-up"></i></a> -->
          <a href="#" id="donot" title="本月不再提醒" data-action="close"><i class="icon-remove"></i></a>
        </div></h5>
       
      </div>
        <div class="widget-body">
       <div class="widget-main">

        <?
          for ($i=0; $i < count($result) ; $i++) { 
            $staffname = $result[$i]["staffname"];
            $birthday = date("Y-m-d",strtotime( $result[$i]["birthday"] ) ); 

            echo "<p class=\"alert alert-info\">".$staffname.$birthday."</p>"; 
          }
        ?> 
       
       </div>
      </div>
     
    </div>
  </div>

     <?  } ?>
    
    <!-- 过期 -->

    <?
    $sql = "SELECT * FROM  ym_remind WHERE  '".$tipDay."' >=  finishdate  and status = 0  "; 
    $result = $mysql -> select($sql) ; 
    if( count($result) > 0   ){ 
    ?>
    <div class="span3">
    <div class="widget-box">
      <div class="widget-header">
        <h5>提醒事项</h5>
        <!-- <div class="widget-toolbar">
          <a href="#" data-action="settings"><i class="icon-cog"></i></a>
          <a href="#" data-action="reload"><i class="icon-refresh"></i></a>
          <a href="#" data-action="collapse"><i class="icon-chevron-up"></i></a>
          <a href="#" data-action="close"><i class="icon-remove"></i></a>
        </div> -->
      </div>
        <div class="widget-body">
       <div class="widget-main">

        <?
          for ($i=0; $i < count($result) ; $i++) { 
            $title = $result[$i]["title"];
            $rid = $result[$i]["id"];  
            echo "<p class=\"alert alert-info\"><a href=\"reminddetails.php?dataid=".$rid."\">".$title."</a></p>"; 
          }
        ?> 
       
       </div>
      </div>
     
    </div>
  </div>
     <?  } ?>



</div>


<div class="space-10"></div>

   <div class="row-fluid">
 
    <!-- 留空备用 -->
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

</div>
<div class="space-10"></div>
<div id="showdiv"></div>






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

 <?
     // $arrayName = array('' => , );
    //  $dates = array();
      $dates = array();
      $counts = array(); $leaves = array(); $bs = array();

      for ($i= 11 ; $i >= 0  ; $i-- ) { 
          //echo $i;

          $nextyear  = mktime(0, 0, 0, (date("m")-$i),   date("d"),   date("Y"));
          //echo(  date("Y-m",$nextyear)   );

          $sql = "select count(*) tc from ym_staff WHERE status = 1 and (jobdate IS NOT NULL) AND (jobdate <> '') 
              and date_format(jobdate,'%m') = ".date("m",$nextyear)."  and date_format(jobdate,'%Y') = ".date("Y",$nextyear)."  ";
          $result = $mysql -> select($sql) ;

          //$dates[] =  $nextyear ;
          $dates[] =  date("'Y-m'",$nextyear)  ;
          $counts[] = $result[0]["tc"] ;


          $sql = "select count(*) leaves from ym_staff WHERE status = 0 and (leavedate IS NOT NULL) AND (leavedate <> '') 
          and date_format(leavedate,'%m') = ".date("m",$nextyear)."  and date_format(leavedate,'%Y') = ".date("Y",$nextyear)."  ";
          $result = $mysql -> select($sql) ; 
          $leaves[] = $result[0]["leaves"] ;


          $sql = "select count(*) bs from ym_staff WHERE status = 1 and (birthday IS NOT NULL) AND (birthday <> '') 
          and date_format(birthday,'%m') = ".date("m",$nextyear)."  ";
          $result = $mysql -> select($sql) ;
          $bs[] = $result[0]["bs"] ;

      }

      // print_r($dates); 
?>

<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>      
<script> 
$("#donot").click( function(){

  if (  confirm("本月不再提醒生日名单?") ){
       
      $("#dayofbirth").hide("slow");
      $("#showdiv").load("handler/donot.php");
  }
  
});
 

  
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: '公司人事资料报表'
            },
            subtitle: {
                text: ''
            },
            xAxis: {

              
                //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

                categories: [<?=implode(",", $dates);?>]

            },
            yAxis: {
                title: {
                    text: 'YMS REPORT'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +'°C';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: '入职人数',
                data: [<?=implode(",", $counts);?>]
            }, 
            {  name: '离职人数',
               data: [<?=implode(",", $leaves);?>]
           }, 
            {  name: '生日人数',
               data: [<?=implode(",", $bs);?>]
           }
            ]
        });
    });
     

</script>

  </body>
</html>