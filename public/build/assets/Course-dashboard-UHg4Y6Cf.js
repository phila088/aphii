var e=document.getElementById("CourseStatistics");if(e!==null){e.innerHTML="";var s={series:[{name:"Study",data:[44,42,57,86,112,55,70,43,23,54,77,34]},{name:"Exams",data:[20,58,58,120,80,95,35,88,60,85,75,85]}],chart:{type:"line",height:320},grid:{borderColor:"rgba(167, 180, 201 ,0.2)"},markers:{size:[5,0],strokeColors:"#fff",strokeWidth:[3,0],strokeOpacity:.9},stroke:{curve:"smooth",width:[2,2],dashArray:[0,4]},dataLabels:{enabled:!1},legend:{show:!0,position:"top",labels:{colors:"#74767c"}},yaxis:{labels:{formatter:function(a){return a.toFixed(0)+""}},labels:{style:{colors:"#8c9097",fontSize:"11px",fontWeight:600,cssClass:"apexcharts-xaxis-label"}}},xaxis:{type:"month",categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","sep","oct","nov","dec"],axisBorder:{show:!0,color:"rgba(167, 180, 201 ,0.2)",offsetX:0,offsetY:0},axisTicks:{show:!0,borderType:"solid",color:"rgba(167, 180, 201 ,0.2)",width:6,offsetX:0,offsetY:0},labels:{rotate:-90,style:{colors:"#8c9097",fontSize:"11px",fontWeight:600,cssClass:"apexcharts-xaxis-label"}}}},o=new ApexCharts(document.querySelector("#CourseStatistics"),s);o.render()}var e=document.getElementById("payoutsReport");if(e!==null){e.innerHTML="";var t={series:[{name:"Paid",data:[50,20,32,32,20,50,20,40,25,55,20,30],type:"area"},{name:"UnPaid",data:[25,15,40,20,25,15,58,28,30,15,58,28],type:"line"}],chart:{height:230,toolbar:{show:!1},background:"none",fill:"#fff"},grid:{borderColor:"#f2f6f7"},colors:["rgb(132, 90, 223)","#ffb8a5"],background:"transparent",dataLabels:{enabled:!1},stroke:{curve:"smooth",width:2,dashArray:[0,5]},dataLabels:{enabled:!1},legend:{show:!0,position:"top"},xaxis:{show:!1,axisBorder:{show:!1,color:"rgba(119, 119, 142, 0.05)",offsetX:0,offsetY:0},axisTicks:{show:!1,borderType:"solid",color:"rgba(119, 119, 142, 0.05)",width:6,offsetX:0,offsetY:0},labels:{rotate:-90}},yaxis:{show:!1,axisBorder:{show:!1},axisTicks:{show:!1}},tooltip:{x:{format:"dd/MM/yy HH:mm"}}},r=new ApexCharts(document.querySelector("#payoutsReport"),t);r.render()}