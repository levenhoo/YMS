<?
        /// <summary>
    /// 基础系数
    /// </summary>
    /// <param name="year">年份</param>
    /// <param name="date">工作年份</param>
    /// <returns></returns>


    function basicData($year,$date)
    {
        try
        {
            $jobdate =  strtotime($date);

            //$spanYear = date("Y")-date("Y",$jobdate) - 1;

            //当年1月1日 
            $tYear = mktime(0,0,0,12,31,$year); 

            $spanYear = date("Y",$tYear) - date("Y",$jobdate) ;


            if ($spanYear >= 1)
            {
                //满1年的则基础系数为1
                return "1";
            }

            if (date("Y",$jobdate)  > $year)
            {
                return "0";
            }


            $spanMonth = date("m",$tYear)  - date("m",$jobdate) ;

            if ( date("d",$jobdate) <= 15)
            {
                //每月15日前入职的算为满1个月
                $spanMonth += 1;
            }
            else
            {
                $spanMonth += 0.5;
            }

            //return ""+spanMonth+"月"  ;
            //服务月数/12
            return   sprintf("%.2f",($spanMonth/12) )  ;
 
            #endregion

        }
        catch(Exception $e)
        {
            return "error";
        } 

       
    }
 
    
    
    
    /*生日日期*/
    function GetBirthday($date){
        return date("MM-dd",strtotime($date) ) ;
    }

    /*计算年假*/
     function JobVacation($date){ 
        $result = JobYear($date);
        return  $result > 5 ? 5 : $result ;
     }

    /*计算年资*/ 
    function JobYear($date,$year=""){ 
        try {
             $year = $year == "" ? date("Y") : $year ;
             $result = ( $year - date("Y",strtotime($date))) -1 ;
             if($result < 0 )
                $result = 0;            
                return $result;
        } catch (Exception $e) {
            return -1;
        }
       
    }
?>