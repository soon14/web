﻿// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("/show/bk_gunqiu_data.php?leaguename="+league+"&CurrPage="+thispage+"&wap=wap&callback=?",function(json){
		var pagecount	=	json.fy.p_page;
		var page		=	json.fy.page;
		var fenye		=	"";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
		if(dbs !=null){
			if(thispage==0 && p!='p'){	
				data = dbs;
				dbs  = json.db;  
			}else{
				dbs  = json.db;  
				data = dbs;
			}
		}else{
			dbs  = json.db;
			data = dbs;
		}	
		
		if(pagecount == 0){
			$("#nomatch").css("display","");
			$("#loading").css("display","none");
			$("#matchpage").css("display","none");
			$("#showsaishi").css("display","none");
			
		}else{
			//构建分页按钮  <a href="javascript:NumPage(0);" class="ui-link">1</a>
			for(var i=0; i<pagecount; i++){
				if(i != page){
					fenye+="<a href='javascript:NumPage(" + i + ");' class=\"ui-link\">" + (i+1) + "</a>&nbsp;&nbsp;";
				}else{
					fenye+="<a href='javascript:NumPage(" + i + ");' class=\"ui-link\"><font color=#000>" + (i+1) + "</font></a>&nbsp;&nbsp;";
				}
			}
			$("#page_a").html(fenye);
			//联赛
			var lsmArray=window_lsm.split('|');
			$("#lsm").html("");
			lsmlist ="<option value=\"\">选择联赛</option>";
			for(var i=0; i<lsmArray.length; i++){	
				var lsm = decodeURI(lsmArray[i]);
				if(decodeURI(league)==lsm){
					lsmlist +="<option value=\""+lsm+"\" selected = \"selected\" >"+lsm+"</option>";
				}else{
					lsmlist +="<option value=\""+lsm+"\" >"+lsm+"</option>";
				}
			}
			$("#lsm").html(lsmlist);
			//赛事
			var htmls="<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#ACACAC\" class=\"box\"><tbody>";
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				if(lsm != dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls += "<tr class=\"liansai\">";
					htmls += "	<td colspan=\"3\" >";
					htmls += "		<a href=\"javascript:void(0)\" title=\"选择 >> "+lsm+"\" onclick=\"javascript:choose_lsm('"+lsm+"');\">"+lsm+"</a>";
					htmls += "	</td>";
					htmls += "</tr>";
				}
					
				htmls +="<tr class=\"wzjz eachmatch\" >";
				htmls +="	<td width=\"20%\">"+dbs[i]["Match_Time"]+"</td>";
				htmls +="	<td width=\"40%\"><span>主队</span><br/><span>"+dbs[i]["Match_Master"]+"</span></td>";
				htmls +="	<td width=\"40%\"><span>客队</span><br/><span>"+dbs[i]["Match_Guest"]+"</span></td>";
				htmls +="</tr>";
				
				htmls +="<tr  class=\"wzjz\" >";
				htmls +="	<td class=\"wzjz\" ><span>让分</span></td>";
				htmls +="	<td>";
				htmls +="		<span class=\"pankou\">"+((dbs[i]["Match_ShowType"]=="H" && dbs[i]["Match_Ho"]!="0")? dbs[i]["Match_RGG"] :"")+"</span>";
				htmls +="		<span class=\"odds\">";
				htmls +=				((dbs[i]["Match_Ho"]==null || dbs[i]["Match_Ho"]<= 0) ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('篮球滚球','让球-"+(dbs[i]["Match_ShowType"]=="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Master"]+"','"+dbs[i]["Match_ID"]+"','Match_Ho','1','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Ho"]!=data[i]["Match_Ho"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFFF00":"")+"'>"+formatNumber(dbs[i]["Match_Ho"],2)+"</a>"));
				htmls +="		</span>";
				htmls +="	</td>";
				htmls +="	<td>";
				htmls +="		<span class=\"pankou\">"+((dbs[i]["Match_ShowType"]=="C" && dbs[i]["Match_Ho"]!=0)? dbs[i]["Match_RGG"] :"")+"</span>";
				htmls +="		<span class=\"odds\">";
				htmls +=				(dbs[i]["Match_Ao"]<=0 ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('篮球滚球','让球-"+(dbs[i]["Match_ShowType"]=="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Guest"]+"','"+dbs[i]["Match_ID"]+"','Match_Ao','1','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Ao"]!=data[i]["Match_Ao"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFFF00":"")+"'>"+formatNumber(dbs[i]["Match_Ao"],2)+"</a>"));
				htmls +="		</span>";
				htmls +="	</td>";
				htmls +="</tr>";
				
				htmls +="<tr  class=\"wzjz\" >";
				htmls +="	<td class=\"wzjz\" ><span>大小</span></td>";
				htmls +="	<td>";
				htmls +="		<span class=\"pankou\">"+(dbs[i]["Match_DxGG1"]!="O" ? dbs[i]["Match_DxGG1"] :"")+"</span>";
				htmls +="		<span class=\"odds\">";
				htmls +=				(dbs[i]["Match_DxDpl"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('篮球滚球','大小-"+dbs[i]["Match_DxGG1"]+"','"+dbs[i]["Match_ID"]+"','Match_DxDpl','1','0','"+dbs[i]["Match_DxGG1"]+"');\" style='"+(dbs[i]["Match_DxDpl"]!=data[i]["Match_DxDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFFF00":"")+"'>"+formatNumber(dbs[i]["Match_DxDpl"],2)+"</a>"));
				htmls +="		</span>";
				htmls +="	</td>";
				htmls +="	<td>";
				htmls +="		<span class=\"pankou\">"+(dbs[i]["Match_DxGG2"]!="U" ? dbs[i]["Match_DxGG2"] :"")+"</span>";
				htmls +="		<span class=\"odds\">";
				htmls +=				(dbs[i]["Match_DxXpl"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('篮球滚球','大小-"+dbs[i]["Match_DxGG2"]+"','"+dbs[i]["Match_ID"]+"','Match_DxXpl','1','0','"+dbs[i]["Match_DxGG2"]+"');\" style='"+(dbs[i]["Match_DxXpl"]!=data[i]["Match_DxXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFFF00":"")+"'>"+formatNumber(dbs[i]["Match_DxXpl"],2)+"</a>"));
				htmls +="		</span>";
				htmls +="	</td>";
				htmls +="</tr>";
				
				
				
				
			}

			htmls +="</tbody></table>";
			if(dbs.length<=0){
				$("#nomatch").css("display","");
				$("#loading").css("display","none");
				$("#matchpage").css("display","none");
				$("#showsaishi").css("display","none");
			}else{
				$("#nomatch").css("display","none");
				$("#loading").css("display","none");
				$("#matchpage").css("display","");
				$("#showsaishi").css("display","");
				$("#showsaishi").html(htmls);
			}
		}
	})
}
