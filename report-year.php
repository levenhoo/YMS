<?  
	include_once "include/common.php" ;

	
	$year = $_REQUEST["year"] == "" ? date("Y") : $_REQUEST["year"] ;
	$com = $_REQUEST["company"] == "" ? "" : $_REQUEST["company"] ;

	$mysql = new Mysql;
		$mysql -> connect();  

		$where = "";

		if(!empty($com)){
			$where .= "and company = '".$com."'";
		}

		$sql = "select * from ym_staff where   status = 1  $where and ( staffname <> '梁崇进' and staffname <> '柳志彬' ) order by company asc , sequence  desc  , department asc ";
		$resultStaff = $mysql->select($sql);   

		$head = "
		<table class=\"table\"><thead><tr>
		<th rowspan=\"2\" class=\"\">姓名</th>
		<th rowspan=\"2\" class=\"hide sname\">公司</th>
		<th rowspan=\"2\" class=\"hide sname\">部门</th>
		<th rowspan=\"2\" class=\"hide sname\">职位</th>
		<th rowspan=\"2\" class=\"jdate\">入职日期</th>
		<th class=\"one\" colspan=\"4\">1月</th>
		<th colspan=\"4\">2月</th>
		<th colspan=\"4\">3月</th>
		<th colspan=\"4\">4月</th>
		<th colspan=\"4\">5月</th>
		<th colspan=\"4\">6月</th>
		<th colspan=\"4\">7月</th>
		<th colspan=\"4\">8月</th>
		<th colspan=\"4\">9月</th>
		<th colspan=\"4\">10月</th>
		<th colspan=\"4\">11月</th>
		<th colspan=\"4\">12月</th>
		<th colspan=\"4\">合计</th>
		<th colspan=\"10\"  class=\"totalxx\">最终系数</th>
		</tr>

		<tr>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th>病</th><th>事</th><th>迟/早</th><th>旷</th>
		<th class=\"totalxx\">基础系数</th>
		<th class=\"totalxx\">考勤系数</th>
		<th class=\"totalxx\">年资系数</th>
		<th class=\"totalxx\">奖罚系数</th>
		<th class=\"hide totalxx\">工作表现系数</th>
		<th class=\"hide totalxx\">合计系数</th>
		<th class=\"hide totalxx\">公司系数</th>
		<th class=\"hide totalxx\">综合系数</th>
		<th class=\"hide totalxx\">基本工资</th>
		<th class=\"hide totalxx\">年终奖金</th>
		</tr></thead><tbody>
		";

	

		for ($i=0; $i < count($resultStaff); $i++) { 
			
		$dataid = $resultStaff[$i]['id']; 
		$staffname = $resultStaff[$i]['staffname']; 
		$company = $resultStaff[$i]['company'];
		$department = $resultStaff[$i]['department'];
		$staffno = $resultStaff[$i]['staffno'];
		$phone = $resultStaff[$i]['phone'];
		$jobdate = $resultStaff[$i]['jobdate'];
		$truejobdate = $resultStaff[$i]['truejobdate'];
		$s_position = $resultStaff[$i]['s_position'];
		$totalevent = $resultStaff[$i]['totalevent'];
		$status = $resultStaff[$i]['status']=="1"?"在职":"离职";


			/* 第二重 */

		//$HTML_ROW = "";

		$HTML_ROW .= "<tr >";	
		$HTML_ROW .= "<td class=\"sname\">".$staffname."</td>";
		$HTML_ROW .= "<td class=\"hide sname\">".$company."</td>";
		$HTML_ROW .= "<td class=\"hide sname\">".$department."</td>";
		$HTML_ROW .= "<td class=\"hide sname\">".$s_position."</td>";
		$HTML_ROW .= "<td>".$jobdate."</td>";



		$etResult = $mysql -> select("select sum(eventnumber) as ev  from ym_event where date_format(eventdate,'%Y') = ".$year." and staffid = $dataid " );
		$eventTotal = 0;
		$eventTotal = $etResult[0][0] == "" ? 0 : $etResult[0][0];
		 


		//$year = 2012;
		/* 十二个月 */

		$totalBj = 0; $totalSj = 0; $totalKg = 0;  $totalCd = 0; $totalZt = 0;

	
	  	for ($j = 1; $j <= 12; $j++)
        {      
        	 	$staffmonthSql = "SELECT * FROM ym_monthdata where  dy = ".$year." and  staffid = ".$dataid." order by dm asc ";
				$monthResult = $mysql -> select($staffmonthSql);  
	 
        		$hasdata = False; 

	         	  for ($ii = 0; $ii < count($monthResult); $ii++)
				{
					
					$dm = trim($monthResult[$ii]["dm"]);
					//print_r($monthResult);
					//echo $dm ."-".$j ."<br>";
					if ( $dm==$j )
					{
						$hasdata = Ture;
  
						$bj = $monthResult[$ii]["bj"]==0?"":$monthResult[$ii]["bj"];
						$sj = $monthResult[$ii]["sj"]==0?"":$monthResult[$ii]["sj"];
						$cd = $monthResult[$ii]["cd"]==0?"":$monthResult[$ii]["cd"];
						$zt = $monthResult[$ii]["zt"]==0?"":$monthResult[$ii]["zt"];
						$kg = $monthResult[$ii]["kg"]==0?"":$monthResult[$ii]["kg"];

						$totalBj += $bj;
                        $totalSj += $sj;
                        $totalCd += $cd;
                        $totalZt += $zt;
                        $totalKg += $kg;


						$HTML_ROW .= "<td class=\"\">".$bj."</td>";
						$HTML_ROW .= "<td class=\"\">".$sj."</td>";
						$HTML_ROW .= "<td class=\"\">".$cd."</td>";
						/*$HTML_ROW .= "<td class=\"\">".$zt."</td>";*/
						$HTML_ROW .= "<td class=\"\">".$kg."</td>";


						$monthResult = array_splice($monthResult, $ii, 1); 
						break;
					}  
					
				}  
 
					if(  $hasdata === False )
					{
						$HTML_ROW .= "<td class=\"\">&nbsp;</td>";
						$HTML_ROW .= "<td class=\"\">&nbsp;</td>";
						$HTML_ROW .= "<td class=\"\">&nbsp;</td>";
						/*$HTML_ROW .= "<td class=\"\">&nbsp;</td>";*/
						$HTML_ROW .= "<td class=\"\">&nbsp;</td>";
					}  

					

		}



		   /***************************
             * 
             *  合计 病、事、迟、旷
             *              
             **************************/
            #region 合计 病、事、迟、旷


            //total bj and sj 
            if ($totalBj == 0) $HTML_ROW .= "<td class=\"\">0</td>";
            else $HTML_ROW .= "<td class=\"hsdata\">" . $totalBj . "</td>";


            if ($totalSj == 0) $HTML_ROW .= "<td class=\"\">0</td>";
            else $HTML_ROW .= "<td class=\"hsdata\">" . $totalSj . "</td>";


            if ($totalCd == 0) $HTML_ROW .= "<td class=\"\">0</td>";
            else $HTML_ROW .= "<td class=\"hsdata\">" . $totalCd . "</td>";


            if ($totalKg == 0) $HTML_ROW .= "<td class=\"\">0</td>";
            else $HTML_ROW .= "<td class=\"hsdata\">" . $totalKg . "</td>";




            /***************************
             * 
             *  总结系数部分
             *              
             * *************************/



            #region 总结系数

            //------------------------
            
            $xs = floor($totalSj);
            $temp = $totalSj - $xs;
            $nz = 0;
            #region 事假
            //事假3天以内（含3天）不在年终考核范围之内
            if ($xs >= 3)
            {
                //有三天免扣
                $xs = ($xs - 3) * 0.1;

                if ($temp != 0)
                {
                    if ($temp <= 0.5)
                    {
                        //4小时以内，含4小时按半天计算为－0.05
                        $xs += 0.05;
                    }
                    else
                    {
                        //4小时以上不足8小时按一天计算为－0.1
                        $xs += 0.1;
                    }
                }
            }
            else { $xs = 0; }


            #endregion

             #region 迟到早退
            //迟到、早退
            //超三次扣0.1
            $tempCZ = ($totalCd / 3) * 0.1;
            $xs += $tempCZ;
            #endregion

            #region 旷工

            $xs +=  floor($totalKg) * 0.2;
            $tempKg = $totalKg -  Floor($totalKg);
            if ($tempKg != 0)
            {
                if ($tempKg <= 0.5)
                {
                    //4小时以内，含4小时按半天计算为－0.05
                    $xs += 0.1;
                }
                else
                {
                    //4小时以上不足8小时按一天计算为－0.1
                    $xs += 0.2;
                }
            }
            #endregion



            #string basic = basicData(int.Parse(y), jobdate);


            $basic = basicData($year,$jobdate);
            $HTML_ROW .= "<td title=\"基础系数\" class=\"sj\">".$basic."</td>"; 

            $HTML_ROW .= "<td title=\"考勤系数\" class=\"sj\">".$xs."</td>";
           

            //满6个月以上视为一年，计算为0.1
            $jd_m = date("m",strtotime($jobdate) ) ;
            $jd_d = date("d",strtotime($jobdate) ) ;
            if ($jd_m < 7) { $nz += 0.1; }
            else if ( $jd_m == 7 && $jd_d <= 15) { $nz += 0.1; }
            else { $nz += 0.05; }
 


            //工作超过1年的才有年资系数
         
            if ($basic == "1")
                  $HTML_ROW .= "<td title=\"年资系数\" class=\"sj\">". ($nz + JobYear($jobdate,$year) * 0.1)."</td>" ;
            else
                  $HTML_ROW .= "<td title=\"年资系数\" class=\"sj\">0</td>" ;

           

            $HTML_ROW .= "<td title=\"奖惩系数\" class=\"sj\">".$eventTotal."</td>";
           

            $HTML_ROW .= "<td class=\"hide\" title=\"工作表现系数\"></td>";
            $HTML_ROW .= "<td class=\"hide\" title=\"合计系数\"></td>";
            $HTML_ROW .= "<td class=\"hide\" title=\"公司系数\"></td>";
            $HTML_ROW .= "<td class=\"hide\" title=\"综合系数\"></td>";
            $HTML_ROW .= "<td class=\"hide\" title=\"基本工资\"></td>";
            $HTML_ROW .= "<td class=\"hide\" title=\"年终奖金\"></td>";

            #endregion



		$HTML_ROW .= "</tr>";


 			
		
		}	
		$HTML_ROW .= "</tbody></table>";
		




		if ( !empty( $_POST["Excel"]) )
		{ 
			//echo "导出";
			header("Content-type:application/vnd.ms-excel");
			header("Content-Disposition:filename=report.xls");
			echo $head;echo $HTML_ROW;
			exit;
		}
		 
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>YMS年报表</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<style>
tr,td,table,body{ padding: 0px; margin: 0px; border:0px;  border-collapse:collapse; border-spacing:0; }
div{ padding: 0px; margin: 0px; border:0px; }
.tips{ height:auto; font-size:10px; color:#333; padding:10px 5px; background-color:#fcfec5; border:1px solid #BBBBBB; line-height: 15px;  }
#content .box-content .table table tbody td{ font-size:8px; padding:2px 10px; height:20px;    }


body{  background-color:#F2F2F2; }
.table .hsdata {  background-color:#FFF58D;  color:red;}
.table th{  border:1px  double   #555; font-size:12px; background-color:#FF9999; color:#fff; }
.table .sname{ width:350px; background-color:#FFF58D; }
.table .jdate{ width:400px;}
.table .totalxx{ width:160px;}
.bj { background-color:#F2F2F2} 
.sj { background-color:#F2F2F2} 
.hbj { background-color:#F2F2F2; color:Red; } 
.hsj { background-color:#F2F2F2; color:Red;} 

.hide { display:none; }

.table tr{ height:26px; line-height:26px; }
.table td{  border:1px double  #555; width:30px; text-align:center;  font-size:12px;}
.table .rightline{  border-right:1px solid  #000;  }
.table .rightline th {  border-right:5px double  #333; }
</style>


	 </head>

	<body>
 
						
<div class="row-fluid">

<form name="ActionForm" method="post">
	<select name="year" onchange="ActionForm.submit()">
	<option value="">--------请选择----------</option>
	<option <? if($year == '2012') echo'selected'; ?>  value="2012">2012</option>
	<option <? if($year == '2013') echo'selected'; ?>  value="2013">2013</option>
	<option <? if($year == '2014') echo'selected'; ?>  value="2014">2014</option>
	<option <? if($year == '2015') echo'selected'; ?>  value="2015">2015</option>
    </select> 

    <select name="company" onchange="ActionForm.submit()">
	<option value="">------------------ 全部 ------------------</option>
	<option <? if($com == '中山弘丰置业有限公司') echo'selected'; ?>   value="中山弘丰置业有限公司">中山弘丰置业有限公司</option>
	<option <? if($com == '中山骏贤物业管理有限公司') echo'selected'; ?>  value="中山骏贤物业管理有限公司">中山骏贤物业管理有限公司</option>
	<option <? if($com == '中山市巴克斯红酒雪茄有限公司') echo'selected'; ?>  value="中山市巴克斯红酒雪茄有限公司">中山市巴克斯红酒雪茄有限公司</option>

</select>
    
    <input type="submit" name="Excel" value="导出" id="Button1" /> 
</form>
 

	<div class="span12"> 
			
	<?  
		
	    echo $head;
    	echo $HTML_ROW;

	?>	 
		
	</div><!--/span-->
</div><!--/row-->
 
	</body>
</html>
