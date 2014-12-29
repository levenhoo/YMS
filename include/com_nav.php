    <div class="navbar navbar-fixed-top" >
      <div class="navbar-inner">
        <div class="container-fluid" id="banner"   >
             <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="brand" href="index.php">YMS</a>
  <style type="text/css">
      #divLoginpanelHor{ display: none; }
    </style>          
  

  <div class="nav-collapse collapse"> 
    <ul class="nav nav-pills pull-right"> 
      <li class="dropdown">
          <a id="userhead" class="dropdown-toggle"  data-toggle="dropdown"   href="#">
              <i class="icon-user"></i>  <?=$LOGIN_NAME?>
              <b class="caret"></b>
          </a>
          <ul class="dropdown-menu"> 

		  <?
			// onclick="checkemail();"  
		  ?>
            <li><a  tabindex="-1"  href="#"  title="我的邮箱"><i class="icon-envelope"></i> 我的邮件</a></li>
            <li><a  tabindex="-1"  href="http://202.96.189.88/wfcx/wfcx.html?jc=粤&hphm=TMF929&hpzl=02&lxdh=2968"   target="_blank" title="违章查询"><i class="icon-tag"></i> 违章查询</a></li> 
            <li><a  tabindex="-1"  href="http://crj.gdga.gov.cn/wsyw/tcustomer/tcustomer.do?method=find&applyid=442000198202048409" target="_blank"   title="进度查询"><i class="icon-tag"></i> 进度查询</a></li>
            <li class="divider"></li>  
            <li><a tabindex="-1"  href="password.php"><i class="icon-user"></i> 修改密码</a></li>  
            <li><a tabindex="-1"  class="navbar-link" href="logout.php" title="退出"><i class="icon-tag"></i> 退出</a></li> 
          </ul>
       </li> 
    </ul> 

   <!--  <p class="navbar-text" >
    <a href="#" data-toggle="dropdown" class="navbar-link">134</a> 
    </p> -->

    <ul id="top-nav" class="nav nav-pills"> 
      <li><a href="stafflist.php"> 员工管理</a></li>
      <li><a href="remind.php" > 提醒事项</a></li>
      <li><a href="staffevent.php" >奖罚</a></li> 
      <li><a href="monthdata.php" >考勤月表</a></li> 
      <li><a href="report-year.php" target="_blank">考勤统计</a></li> 
    </ul> 

  <!--  <ul class="nav">
      <li class="active"><a href="http://localhost:8667/index.html" target="_blank">旧版本</a></li>.
    </ul> -->

    <!--/.nav-collapse -->
  </div> 
        </div>
      </div>
    </div>