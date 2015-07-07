<?php
      error_reporting(0);
      session_start();
      require_once 'db.php';
if(isset($_REQUEST['result1']))
{
	$formid = 2;
    for($i=1; $i<=5; $i++)
	{
		$iname = 'result'.$i;
		$query = "INSERT ".$_SESSION['studentname']." (formid, questionid, answer) value('".$formid."','".$i."','".htmlspecialchars($_REQUEST[$iname],ENT_QUOTES)."');";
		if(!executeQuery($query))
		{
		$error = true;		
		$_GLOBALS['message']="实验数据没有存储成功". mysql_error();
		break;
		}
	}
	closedb();
	if(!$error)
	{
		header('Location:finish.php?csb='.$_REQUEST['result4']);
	}
	end:
		unset($_REQUEST['result']);
		echo $_GLOBALS['message'];
}
?>
<html>
  <head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
    <title>按键测试</title> 
  </head>
  <body bgcolor="#000000">
    <table height="100%"  width="100%">
	  <tr>
	    <td align="center" valign="middle" style="font-family:'宋体'"><font color="#FFFFFF" size="+3"  id="ha">实验即将开始，请将该网页全屏！<br/>此过程需要耗费您20分钟左右的时间，请不要离开，认真操作即可！<br/>我们的实验非常简单，但若您不正常操作，而造成实验数据不理想，我们将有权不给予报酬！<br/>按任意键进入实验！</font></td>
	  </tr>
	</table>
	<form action="" method="post">
		<input type="hidden" name="result1" value=" ">
		<input type="hidden" name="result2" value=" ">
		<input type="hidden" name="result3" value=" ">
		<!--result4存储正确率-->
		<input type="hidden" name="result4" value=" ">
		<!--result5存储提交时间-->
		<input type="hidden" name="result5" value=" ">
	</form>

<script type="text/javascript">
	var success=0;
	
	//各数组定义

	
	var arr2=new Array();
	arr2[0]=[3,2,2,4,3,3,4,1,1,1,4,2,4,3,1,1,2,4,3,1,4,3,2,2,3,2,4,1,4,4,4,2,2,3,3,1,1,2,1,3];//单个数字的数组，40个
	arr2[1]=[2,2,1,3,4,3,4,3,1,3,2,1,1,3,2,1,1,3,2,4,2,2,1,4,2,1,1,4,4,4,2,4,3,4,2,3,3,3,4,1];
	arr2[2]=[1,4,1,4,2,1,4,1,4,2,1,4,1,4,1,3,3,1,4,3,2,2,2,3,2,4,2,3,2,3,3,4,2,3,1,3,3,1,4,2];
	arr2[3]=[4,1,2,3,2,1,3,4,3,1,1,2,3,4,2,4,4,3,1,3,2,3,1,2,4,3,4,3,2,1,2,4,2,1,2,4,1,3,4,1];
	var arr3=new Array();var arr3ic01=new Array();var arr3xl=new Array();
	arr3[0]=[22222,44344,11411,33233,44444,33333,22122,11111];//练习试次数组，8个
	arr3ic01[0]=[1,0,0,0,1,1,0,1];//i0.c1
	arr3xl[0]=[3,2,0,0,1,3,2,1];//ii0,ic1,ci2,cc3
	arr3[1]=[11411,22222,44444,44344,11111,33333,33233,22122];
	arr3ic01[1]=[0,1,1,0,1,1,0,0];
	arr3xl[1]=[2,1,3,2,1,3,2,0];
	arr3[2]=[44444,33233,22122,33333,11111,11411,44344,22222];
	arr3ic01[2]=[1,0,0,1,1,0,0,1];
	arr3xl[2]=[3,2,0,1,3,2,0,1];
	arr3[3]=[22122,44444,33333,44344,11111,22222,11411,33233];
	arr3ic01[3]=[0,1,1,0,1,1,0,0];
	arr3xl[3]=[2,1,3,2,1,3,2,0];
	arr3[4]=[33333,11111,22222,11411,22122,44344,44444,33233];
	arr3ic01[4]=[1,1,1,0,0,0,1,0];
	arr3xl[4]=[3,3,3,2,0,0,1,2];
 
	
    var arr=[22222,11411,33233,11411,33333,11411,33233,44444,33233,11411,33333,11411,22222,44444,22222,11111,44344,11111,33333,22222,11111,33233,11111,33233,44444,22122,44344,11111,44344,22122,44344,22122,44444,22222,33333,22122,44344,22122,33333,44444,22222,44444,33233,11111,44344,11111,33233,11111,22222,44444,22222,11411,33233,11411,33333,22122,44344,22122,44344,22222,33333,11411,33333,22222,11411,33233,11411,33333,11111,44344,22122,44444,22122,44344,22122,33333,44444,11111,33233,44444,11111,44344,22122,44344,22122,33333,22222,11411,33333,22122,44444,33333,11411,33233,11411,33233,11111,44444,22222,11111,33233,44444,33233,11411,22222,11111,44344,22222,44344,22222,11411,33233,44444,11111,44444,33333,22122,44344,22122,33333,33233,11411,33233,11411,22222,44444,33333,11411,22222,33333,11111,22222,44344,22122,44344,11111,44344,11111,33233,11111,44344,22122,44444,22122,33333,22222,44444,33233,11411,33233,11411,33333,22122,44344,11111,44444,22122,44444,22222,33333,22122,44444,33233,11411,22222,44344,22222,44344,11111,22222,11111,44344,22122,44344,22122,33333,22122,33333,11411,33333,44444,11111,44444,33233,11411,33233,44444,33233,11411,33233,11411,33333,22222,33333,22122,44344,11111,22222,44444,11111,44444,33333,22122,44344,22122,33333,44444,22122,33333,22122,44344,11111,44344,22122,44344,22222,44344,11111,33233,11411,22222,44444,33233,44444,33333,11111,33333,11411,22222,11111,33233,11411,22222,44444,22222,11411,33233,11411,33233,11111];//给定试次数组，240个
	var arric01=[1,0,0,0,1,0,0,1,0,0,1,0,1,1,1,1,0,1,1,1,1,0,1,0,1,0,0,1,0,0,0,0,1,1,1,0,0,0,1,1,1,1,0,1,0,1,0,1,1,1,1,0,0,0,1,0,0,0,0,1,1,0,1,1,0,0,0,1,1,0,0,1,0,0,0,1,1,1,0,1,1,0,0,0,0,1,1,0,1,0,1,1,0,0,0,0,1,1,1,1,0,1,0,0,1,1,0,1,0,1,0,0,1,1,1,1,0,0,0,1,0,0,0,0,1,1,1,0,1,1,1,1,0,0,0,1,0,1,0,1,0,0,1,0,1,1,1,0,0,0,0,1,0,0,1,1,0,1,1,1,0,1,0,0,1,0,1,0,1,1,1,0,0,0,0,1,0,1,0,1,1,1,1,0,0,0,1,0,0,0,0,1,1,1,0,0,1,1,1,1,1,1,0,0,0,1,1,0,1,0,0,1,0,0,0,1,0,1,0,0,1,1,0,1,1,1,1,0,1,1,0,0,1,1,1,0,0,0,0,1];
	var arrxl=[3,2,0,0,1,2,0,1,2,0,1,2,1,3,3,3,2,1,3,3,3,2,1,2,1,2,0,1,2,0,0,0,1,3,3,2,0,0,1,3,3,3,2,1,2,1,2,1,3,3,3,2,0,0,1,2,0,0,0,1,3,2,1,3,2,0,0,1,3,2,0,1,2,0,0,1,3,3,2,1,3,2,0,0,0,1,3,2,1,2,1,3,2,0,0,0,1,3,3,3,2,1,2,0,1,3,2,1,2,1,2,0,1,3,3,3,2,0,0,1,2,0,0,0,1,3,3,2,1,3,3,3,2,0,0,1,2,1,2,1,2,0,1,2,1,3,3,2,0,0,0,1,2,0,1,3,2,1,3,3,2,1,2,0,1,2,1,2,1,3,3,2,0,0,0,1,2,1,2,1,3,3,3,2,0,0,1,2,0,0,0,1,3,3,2,0,1,3,3,3,3,3,2,0,0,1,3,2,1,2,0,1,2,0,0,1,2,1,2,0,1,3,2,1,3,3,3,2,1,3,2,0,1,3,3,2,0,0,0,1];

	var size3="+4";var size4="+2";
    document.onkeydown=function()
	{document.getElementById("ha").innerHTML="欢迎您进入实验部分！</br>按任意键开始！";
	 document.onkeydown=function()
	 {document.getElementById("ha").innerHTML="第一部分：实验练习！</br>按任意键继续！";
	  document.onkeydown=function()
	  {document.onkeydown = function(){};document.getElementById("ha").innerHTML="";setTimeout("step3()",1000);}
	 }
	} 
	//练习
	//1.练习
	  //初始定义
	
	var s1x;	
	var shuzitim=-1;
	var shuzitims=0;
	var arr2keydown1=new Array();//记录真实按键数组
	var rtd1=new Array();//反应时数组
	var rightd1=new Array();//正确错误数组，0正确，1错误
	  //
	  var step3=function()//反应时与正误初始定义【3000,0】，按键后，延迟1秒空白后进入数字练习
      {s1x=-1;shuzitims+=1;shuzitim+=1;if(shuzitim==4){shuzitim=0;}    for(md=0;md<arr2[0].length;md++){rtd1[md]=2000;rightd1[md]=0;arr2keydown1[md]=0;}  
	    document.getElementById("ha").color="white";
		document.getElementById("ha").innerHTML="step1：有提示指法练习</br>当屏幕出现有颜色的正方形时，按下颜色对应的字母按键,本部分练习会有相应按键的提示！</br>（Z--红、X--黄、N--蓝、M--绿），要求又快又准！</br>按任意键开始！";
	   document.onkeydown=function(){document.onkeydown = function(){};document.getElementById("ha").innerHTML="</br>+";setTimeout("s2a1()",1000);}
      }
	  
      function s2a1()//每次数字出现，同时获取此时时间，2000毫秒后消失成“+”。最后，1秒后判断。
	  {s1x+=1;td=0;
	   if(s1x<arr2[0].length){haha=document.getElementById("ha");var tishi=change2(arr2[shuzitim][s1x].toString());
	                          var he="</br>■";
	                          haha.innerHTML= tishi.fontsize(size4)+he.fontsize(size3);haha.color=change(arr2[shuzitim][s1x].toString());
	                          window.startTimd=(new Date).getTime();document.onkeydown=one1;clock=setTimeout("s2c1()",2000);}
	   else{setTimeout("s2b1()",1000);}
	  }	 
	  

	  function one1()//按键记录正误与反应时间
	  {  clearTimeout(clock);
	     document.onkeydown=function(){};
	     var stopTimd = (new Date).getTime();
		 var timdelyd = stopTimd - startTimd; 
		 arr2keydown1[s1x]=keyvalue();
		 if(keyvalue()==arr2[shuzitim][s1x]){ rightd1[s1x]=1;}else{ rightd1[s1x]=2;}  //需返回的01数组
		 rtd1[s1x]=timdelyd;//需返回的反应时数组
         
		 var sss="</br>+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;setTimeout("s2a1()",2000);
	   }
		
		  function s2c1()//1000毫秒的“+”，下一次数字练习
	  {var sss="</br>+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;
	  document.onkeydown = function(){};setTimeout("s2a1()",2000); }
	  
	  	
	  	 
	    function s2b1()//判断正确率和平均反应速度	
	  { var arry=0;var rtds=0;
	    for(var s2y=0;s2y<arr2[0].length;s2y++){if(rightd1[s2y]==1){arry+=1;}rtds+=rtd1[s2y];}
		var arrs=(arry/arr2[0].length);
		var rtdss=(rtds/arr2[0].length);
		document.getElementById("ha").color="white";
		if(arrs>=0.95){if(rtdss<=800){document.getElementById("ha").innerHTML="恭喜您完成有提示按键练习！</br>按任意键继续！";document.onkeydown=step4;}
		               else{document.getElementById("ha").innerHTML="对不起！您的准确率已达要求，但是反应速度未达要求，请重新完成该组练习！</br>按任意键重新开始step1！";document.onkeydown=step3;}}
		else{if(rtdss<=800){document.getElementById("ha").innerHTML="对不起！您的反应速度已达要求，但是准确率未达要求，请重新完成该组练习！</br>按任意键重新开始step1！";document.onkeydown=step3;}
	         else{document.getElementById("ha").innerHTML="对不起！您的反应速度以及准确率都未达要求，请重新完成该组练习！</br>按任意键重新开始step1！";document.onkeydown=step3;}}
	  }		  
	 
 

	//2.数字练习
	  //初始定义
	var s2x;
	var shuzitime=4;
	var shuzitimes=0;
	var arr2keydown=new Array();//记录真实按键数组
	var rtd=new Array();//反应时数组
	var rightd=new Array();//正确错误数组，0正确，1错误
	  //
	  var step4=function()//反应时与正误初始定义【3000,0】，按键后，延迟1秒空白后进入数字练习
      {s2x=-1;shuzitimes+=1;shuzitime-=1;if(shuzitime==-1){shuzitime=3;}    for(md=0;md<arr2[0].length;md++){rtd[md]=2000;rightd[md]=0;arr2keydown[md]=0;}  
	   document.getElementById("ha").color="white";
	   document.getElementById("ha").innerHTML="step2：无提示指法练习</br>当屏幕出现有颜色的正方形时，按下颜色对应的字母按键,本部分练习会无相应按键的提示！</br>（Z--红、X--黄、N--蓝、M--绿），要求又快又准！</br>按任意键开始！";
	   document.onkeydown=function(){document.onkeydown = function(){};document.getElementById("ha").innerHTML="+";setTimeout("s2a()",1000);}
      }
	  
      function s2a()//每次数字出现，同时获取此时时间，2000毫秒后消失成“+”。最后，1秒后判断。
	  {s2x+=1;td=0;
	   if(s2x<arr2[0].length){haha=document.getElementById("ha"); var he="■";
	                          haha.innerHTML= he.fontsize(size3);haha.color=change(arr2[shuzitime][s2x].toString());
	                          window.startTimed=(new Date).getTime();document.onkeydown=one;clock=setTimeout("s2c()",2000);}
	   else{setTimeout("s2b()",1000);}
	  }	 
	  

	  function one()//按键记录正误与反应时间
	  {  clearTimeout(clock);
	     document.onkeydown=function(){};
	     var stopTimed = (new Date).getTime();
		 var timedelyd = stopTimed - startTimed; 
		 arr2keydown[s2x]=keyvalue();
		 if(keyvalue()==arr2[shuzitime][s2x]){ rightd[s2x]=1;}else{ rightd[s2x]=2;}  //需返回的01数组
		 rtd[s2x]=timedelyd;//需返回的反应时数组
         
		 var sss="+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;setTimeout("s2a()",2000);
	   }
		
		  function s2c()//1000毫秒的“+”，下一次数字练习
	  {var sss="+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;
	  document.onkeydown = function(){};setTimeout("s2a()",2000); }
	  
	  	
	  	 
	    function s2b()//判断正确率和平均反应速度	
	  { var arry=0;var rtds=0;
	    for(var s2y=0;s2y<arr2[0].length;s2y++){if(rightd[s2y]==1){arry+=1;}rtds+=rtd[s2y];}
		var arrs=(arry/arr2[0].length);
		var rtdss=(rtds/arr2[0].length);
		document.getElementById("ha").color="white";
		if(arrs>=0.95){if(rtdss<=800){document.getElementById("ha").innerHTML="恭喜您完成无提示按键练习！</br>按任意键继续！";document.onkeydown=step5;}
		               else{document.getElementById("ha").innerHTML="对不起！您的准确率已达要求，但是反应速度未达要求，请重新完成该组练习！</br>按任意键重新开始step2！";document.onkeydown=step4;}}
		else{if(rtdss<=800){document.getElementById("ha").innerHTML="对不起！您的反应速度已达要求，但是准确率未达要求，请重新完成该组练习！</br>按任意键重新开始step2！";document.onkeydown=step4;}
	         else{document.getElementById("ha").innerHTML="对不起！您的反应速度以及准确率都未达要求，请重新完成该组练习！</br>按任意键重新开始step2！";document.onkeydown=step4;}}
	  }	
	  
  // 3.正式实验练习
    //初始定义
	
	var xx;//指针
	var lianxitime=-1;
	var lianxitimes=0;
	var arr3keydown=new Array();
	var arr3real=new Array();
	var tim=new Array();//反应时大数组
	var rtm=new Array();//反应时数组
	var tfm=new Array(); //正确错误大数组
	var rightm=new Array();//正确错误数组，0正确，1错误
	//
		 var step5=function()
        {xx=-1;lianxitimes+=1;lianxitime+=1;if(lianxitime==5){lianxitime=0;}
         for(mm=0;mm<arr3[0].length;mm++){rtm[mm]=2000;rightm[mm]=0;arr3keydown[mm]=0;} 
		 document.getElementById("ha").color="white";
         document.getElementById("ha").innerHTML="step3：正式实验练习</br>屏幕会出现一个有颜色的汉字，按下颜色对应的字母按键！</br>（Z--红、X--黄、N--蓝、M--绿），要求又快又准！</br>按任意键开始！";
	     document.onkeydown=function(){document.onkeydown = function(){};document.getElementById("ha").innerHTML="";setTimeout("b0()",1000);}
        }

	    function b0()//开始时5秒持续的“+”
		{var sss="+"; var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html; 
		 setTimeout("b1()",5000);
		}
		
	    function b1()//判断实验是否结束，未结束则250ms的“11 11”，进入a2（）；实验进行结束则5秒持续+
	    { xx += 1;if(xx< arr3[0].length){var number = new Number(arr3[lianxitime][xx]);var str=number.toString();
		                                 var a=str.charAt(0);ganrao=change1(a);aam=str.charAt(2);mubiao=change(aam);arr3real[xx]=aam;
										 haha=document.getElementById("ha");
	                                     haha.innerHTML= ganrao;haha.color=mubiao;
	                                     window.startTimem=(new Date).getTime();document.onkeydown=bb;clock=setTimeout("b4()",2000);
		                                // document.getElementById("ha").innerHTML=a+a+" "+a+a;setTimeout("b2()",250);
		                                 }
		         else{var sss="+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;setTimeout("b5()",5000);} 
	    }
		
		   
		
		function b4()//持续1000反应时的“+”
		{var sss="+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;
		document.onkeydown = function(){};setTimeout("b1()",2000);}
		
		
	
	
		 function b5()//判断正确率和平均反应速度	
	  { var arry=0;var rtds=0;
	    for(var s2y=0;s2y<arr3[0].length;s2y++){if(rightm[s2y]==1){arry+=1;}rtds+=rtm[s2y];}
		var arrs=(arry/arr3[0].length);
		var rtdss=(rtds/arr3[0].length);
		document.getElementById("ha").color="white";
		if(arrs>=1){if(rtdss<=1000){document.getElementById("ha").innerHTML="恭喜您完成正式实验练习！</br>按任意键继续！";document.onkeydown=step6;}
		               else{document.getElementById("ha").innerHTML="对不起！您的准确率已达要求，但是反应速度未达要求，请重新完成该组练习！</br>按任意键重新开始step3！";document.onkeydown=step5;}}
		else{if(rtdss<=1000){document.getElementById("ha").innerHTML="对不起！您的反应速度已达要求，但是准确率未达要求，请重新完成该组练习！</br>按任意键重新开始step3！";document.onkeydown=step5;}
	         else{document.getElementById("ha").innerHTML="对不起！您的反应速度以及准确率都未达要求，请重新完成该组练习！</br>按任意键重新开始step3！";document.onkeydown=step5;}}
	  }		
	
		
		function bb()//可以记录该试次内每次按键的反应时和正确错误，并取第一次按键的反应时和正确错误，记录在rt数组和tf数组
	    {clearTimeout(clock);
		 document.onkeydown = function(){};var stopTime = (new Date).getTime();var timedely = stopTime - startTimem;arr3keydown[xx]=keyvalue();
	     if(keyvalue()==aam){rightm[xx]=1;}else{rightm[xx]=2;}  
		 rtm[xx]=timedely;
		 var sss="+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;setTimeout("b1()",2000);
	    }
		

  //正式实验部分
    //初始定义
  	var x = -1;//指针
	var arrreal=new Array();
	var arrkeydown=new Array();
	var rt=new Array();//反应时数组
	var right=new Array();//正确错误数组，0正确，1错误
	for(m=0;m<arr.length;m++){rt[m]=2000;right[m]=0;arrkeydown[m]=0;}  
    //
    var step6=function()//1s空白后开始实验
   {document.getElementById("ha").color="white";
    document.getElementById("ha").innerHTML="第二部分：正式实验</br>屏幕会出现一个有颜色的汉字，按下颜色对应的字母按键！</br>（Z--红、X--黄、N--蓝、M--绿），要求又快又准！</br>按任意键开始！";
	document.onkeydown=function()
     {document.onkeydown = function(){};document.getElementById("ha").innerHTML="";setTimeout("a00()",1000);}
   }


    function a00()//开始时5秒持续的“+”
	{var sss="+";var html=sss.fontcolor("white").bold();
	 document.getElementById("ha").innerHTML=html;setTimeout("a1()",5000);
	}

	function a0()//开始时5秒持续的“+”
	{var sss="+";var html=sss.fontcolor("white").bold();
	 document.getElementById("ha").innerHTML=html;setTimeout("a11()",5000);
	}
		
	function a1()//判断实验完成四分之一，二分之一，四分之三，若是则停留十秒后开始五秒的“+”
	{ x += 1;document.getElementById("ha").color="white";
	  if(x==40){document.getElementById("ha").innerHTML="该实验部分已经完成六分之一，休息5秒后继续！";setTimeout("a0()",5000);}
	  else{
	   if(x==80){document.getElementById("ha").innerHTML="该实验部分已经完成三分之一，休息5秒后继续！";setTimeout("a0()",5000);}
	   else{
	    if(x==120){document.getElementById("ha").innerHTML="该实验已经部分完成二分之一，休息5秒后继续！";setTimeout("a0()",5000);}
		else{
		 if(x==160){document.getElementById("ha").innerHTML="该实验已经部分完成三分之二，休息5秒后继续！";setTimeout("a0()",5000);}
		 else{
		  if(x==200){document.getElementById("ha").innerHTML="该实验已经部分完成六分之五，休息5秒后继续！";setTimeout("a0()",5000);}
		  else{setTimeout("a11()",0);}
	         }
	       }
		  }
	    }
	}
		
    function a11()//未完成则出现250毫秒的11 11，否则持续五秒“+”后结束
    {if(x< arr.length){var number = new Number(arr[x]);var str=number.toString();
	                   var a=str.charAt(0);ganrao1=change1(a);aa=str.charAt(2);mubiao1=change(aa);arrreal[x]=aa;
                       haha=document.getElementById("ha");
	                   haha.innerHTML= ganrao1;haha.color=mubiao1;
	                   window.startTime=(new Date).getTime();document.onkeydown=b;clock=setTimeout("a4()",2000);
	                  }
     else{var sss="+";var html=sss.fontcolor("white").bold();
		 document.getElementById("ha").innerHTML=html;setTimeout("a55()",5000);
	     } 
	 } 


		   
		
		function a4()//持续1000反应时的“+”
		{var sss="+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;
		document.onkeydown = function(){};setTimeout("a1()",2000);}
	


		
	function a55()//空白1s后结束
{document.getElementById("ha").color="white";document.onkeydown=function(){};document.getElementById("ha").innerHTML="正式实验部分结束啦！";setTimeout("a5()",1000);}
	

		
	function a5()//完成
	{ 
	
		 var cs=0; for(var cishu=0;cishu<right.length;cishu++){if(right[cishu]==1)cs+=1;}
		 var csb=(cs/right.length);
		 if(csb>=0.75){document.getElementById("ha").innerHTML="恭喜您完成正式实验！</br>您的正确率为"+Math.round(csb*100)+"%,此次报酬会在3-5个工作日后发放到您的支付宝账户！";success=1;}
         else{document.getElementById("ha").innerHTML="对不起！您的正确率为"+Math.round(csb*100)+"%,由于您的正确率过低，不能达到我们的要求，所以此次实验无效！</br>若您希望重新完成本实验，请于至少24小时之后再次进行实验！";success=2;}  

	
	
	
	  var srr3="";//Target,IC01,Sequenceii0.ic1.ci2,cc3,Targetcenter,Targetresponse0空,1234,5其他,Rightor0空,1对2错,RT;
	  for(m=0;m<arr.length;m++){var num= new Number(rt[m]);var numn= new Number(right[m]);srr3=srr3+arr[m]+","+arric01[m]+","+arrxl[m]+","+arrreal[m]+","+arrkeydown[m]+","+numn.toString()+","+num.toString()+","+success+";"}
	
    /*var srr0="";//sTarget,sTargetresponse,sRightor,sRT,stimes;
	  for(m=0;m<arr2[0].length;m++){var num= new Number(rtd1[m]);var numn= new Number(rightd1[m]);srr0=srr0+arr2[shuzitim][m]+","+arr2keydown1[m]+","+numn.toString()+","+num.toString()+","+shuzitims+";"}	*/ 
	  var srr1="";//sTarget,sTargetresponse,sRightor,sRT,stimes;
	  for(m=0;m<arr2[0].length;m++){var num= new Number(rtd[m]);var numn= new Number(rightd[m]);srr1=srr1+arr2[shuzitime][m]+","+arr2keydown[m]+","+numn.toString()+","+num.toString()+","+shuzitimes+";"}

	  var srr2="";//lTarget,lIC,lSequence,lTargetcenter,lTargetresponse,lRightor,lRT,ltimes;
		  for(m=0;m<rtm.length;m++){var num= new Number(rtm[m]);var numn= new Number(rightm[m]);srr2=srr2+arr3[lianxitime][m]+","+arr3ic01[lianxitime][m]+","+arr3xl[lianxitime][m]+","+arr3real[m]+","+arr3keydown[m]+","+numn.toString()+","+num.toString()+","+lianxitimes+";"}
		  document.getElementById("ha").innerHTML="恭喜您顺利完成实验<br/><span style=\"color:red;\">请按任意键提交实验结果,否则您的实验数据将会丢失</span>"; //此处返回数据
		  document.onkeydown=function()
		  {document.onkeydown = function(){};
		  var subTime=new Date();
		  var subYear=subTime.getFullYear();
		  var subMonth=subTime.getMonth();
		  var subDate=subTime.getDate();
		  var subHour=subTime.getHours();
		  var subMinute=subTime.getMinutes();
		  var subTimeNew=subYear+"/"+(subMonth+1)+"/"+subDate+"--"+subHour+":"+subMinute;
		 // document.getElementById("ha").innerHTML="单数字练习：</br>"+srr1+"</br>正式实验练习：</br>"+srr2+"</br>正式实验：</br>"+srr3;//zhushidiao
			formElement1=document.forms[0];
		   formElement1.elements[0].value=srr1;
		   formElement1.elements[1].value=srr2;
		   formElement1.elements[2].value=srr3;		  
		   formElement1.elements[3].value=csb;
		   formElement1.elements[4].value=subTimeNew;
		   formElement1.submit();

		  }
      }

	function b()//可以记录该试次内每次按键的反应时和正确错误，并取第一次按键的反应时和正确错误，记录在rt数组和tf数组
    { clearTimeout(clock);
	  document.onkeydown = function(){};var stopTime = (new Date).getTime();var timedely = stopTime - startTime;arrkeydown[x]=keyvalue();	  
	  if(keyvalue()==aa){right[x]=1;}else{right[x]=2;}   rt[x]=timedely;
	  var sss="+";var html=sss.fontcolor("white").bold();document.getElementById("ha").innerHTML=html;setTimeout("a1()",2000);
    }

	
    function keyvalue()
	{var keycode;if(event.keyCode){keycode=event.keyCode;}else {keycode=event.which;}
	 key= String.fromCharCode(keycode); 
	 switch(key){case"Z":key=1;break;case"X":key=2;break;case"N":key=3;break;case"M":key=4;break;default:key=5;break;}
	 return(key);
     } 
	 
	 function change(shuzi)
	{var x=shuzi;
	 switch(x){case "1":colorword="red";break;case "2":colorword="yellow";break;case "3":colorword="blue";break;case "4":colorword="green";break;default:colorword="none";break;}
	 return colorword;
	} 
	 function change1(shuzi)
	{var x=shuzi;
	 switch(x){case "1":colorword="红";break;case "2":colorword="黄";break;case "3":colorword="蓝";break;case "4":colorword="绿";break;default:colorword="none";break;}
	 return colorword;
	} 
	function change2(shuzi)
	{var x=shuzi;
	 switch(x){case "1":colorword="Z";break;case "2":colorword="X";break;case "3":colorword="N";break;case "4":colorword="M";break;default:colorword="none";break;}
	 return colorword;
	} 
</script>	
  </body>
</html>