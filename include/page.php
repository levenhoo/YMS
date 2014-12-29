<?
 

    class Pager
    {
        var $maxCount;//每页显示数量
        var $totalResult;//总数量
        var $curPage;
        var $totalPage;//总页数
        var $left=5;
        var $right=5;
        
        var $pageHtml;
        
        function InitPage($totalResult , $curPage="" , $maxCount = "", $curpage = "" )
        {
            $this -> maxCount =  empty( $maxCount ) ? 10 : $maxCount ;
            $this -> totalResult =  empty( $totalResult ) ? 0 : $totalResult ;
            $this -> curPage =  empty( $curPage ) ? 1 : $curPage ; 
        }
        
        /**
         * 计算总页数
         */
        private function GetTotalPage()
        {
            $this -> totalPage = ceil ( $this -> totalResult  /   $this -> maxCount );
        }
        
        
        function pr()
        {
            
            /*
            if ( $this -> totalPage <= 1){
                return "";
            }
            */
            $this -> GetTotalPage();
            /*
            echo  "[maxCount]".$this -> maxCount ;
            echo  "[totalResult]".$this -> totalResult ;
            echo  "[curPage]".$this -> curPage ;
           
            
             $this -> pageHtml .= "Result : ".$this -> totalResult;
             $this -> pageHtml .=  " MaxShow : <select name=\"max\" id=\"max\">";
             if($this -> maxCount == 5)  $this -> pageHtml .=  "<option selected value=\"5\" >5</option>";
             else $this -> pageHtml .=  "<option  value=\"5\" >5</option>";
             if($this -> maxCount == 10) $this -> pageHtml .=  "<option selected value=\"10\" >10</option>";
             else $this -> pageHtml .=  "<option value=\"10\" >10</option>";
            
             $this -> pageHtml .=  "</select>";
             */
             $this -> pageHtml .= "<ul>";
            
            //显示上一页
               if ( $this -> curPage != 1)
                    $this -> pageHtml .= "<li><a alt=\"".($this -> curPage - 1)."\" href=\"#".($this -> curPage - 1)."\">&laquo; Prev</a></li>"; 
                else
                 $this -> pageHtml .= "<li  class=\"disabled\"><a alt=\"".($this -> curPage - 1)."\" href=\"#\">&laquo; Prev</a></li>";    
            //中间页码
            for ($i = 1 ; $i <=  $this -> totalPage ; $i ++ )
            {
                
                 if ( $i + $this -> left  <  $this -> curPage  )
                {
                     $this -> pageHtml .= "<li><a   alt=\"\" href=\"#\">...</a>  ";
                     $i = $this -> curPage - $this -> left;
                    //$this -> pageHtml .= " <a href=\"#\">...</a>  ";
                   // break;
                }
               
                
                if($this -> curPage == $i)
                    $this -> pageHtml .= "<li class=\"active\"><a  alt=\"". $i ."\" href=\"#\">". $i ."</a></li>";
                else
                    $this -> pageHtml .= "<li><a  alt=\"". $i ."\" href=\"#\">". $i ."</a></li>";
                
                
                 if ( $this -> curPage + $this -> right == $i )
                {
                    $this -> pageHtml .= "<li><a  alt=\"\" href=\"#\">...</a></li>";
                    break;
                }
                
            }
            //显示下一页
               if ( $this -> curPage  != $this -> totalPage and   $this -> totalPage != 0 )
                    $this -> pageHtml .= "<li><a alt=\"".($this -> curPage + 1)."\" href=\"#".($this -> curPage + 1)."\">Next &raquo;</a></li>"; 
            
             $this -> pageHtml .= "</ul>";
            $this -> pageHtml .= "<input type=\"hidden\" name=\"cur\" id=\"cur\" value=\"\" />";
            
            
            
            
            
            echo $this -> pageHtml;
            
            
            
            
        }
    }

   
?>