(function(){var f=document.getElementById("product-price-range");noUiSlider.create(f,{start:[0,1e4],connect:!0,tooltips:[!0,!0],range:{min:0,max:1e4}}),y(f,15," - ");function y(o,U,m){var E=getComputedStyle(o).direction==="rtl",T=o.noUiSlider.options.direction==="rtl",h=o.noUiSlider.options.orientation==="vertical",r=o.noUiSlider.getTooltips(),P=o.noUiSlider.getOrigins();r.forEach(function(a,s){a&&P[s].appendChild(a)}),o.noUiSlider.on("update",function(a,s,B,H,i){var l=[[]],e=[[]],c=[[]],n=0;r[0]&&(l[0][0]=0,e[0][0]=i[0],c[0][0]=a[0]);for(var t=1;t<i.length;t++)(!r[t]||i[t]-i[t-1]>U)&&(n++,l[n]=[],c[n]=[],e[n]=[]),r[t]&&(l[n].push(t),c[n].push(a[t]),e[n].push(i[t]));l.forEach(function(S,d){for(var v=S.length,g=0;g<v;g++){var p=S[g];if(g===v-1){var u=0;e[d].forEach(function(k){u+=1e3-k});var C=h?"bottom":"right",R=T?0:v-1,V=1e3-e[d][R];u=(E&&!h?100:0)+u/v-V,r[p].innerHTML=c[d].join(m),r[p].style.display="block",r[p].style[C]=u+"%"}else r[p].style.display="none"}})})}})();