if(document.querySelector("#switcher-canvas")){const e=document.querySelector(".pickr-container-primary"),t=document.querySelector(".theme-container-primary"),c=[["nano",{defaultRepresentation:"RGB",components:{preview:!0,opacity:!1,hue:!0,interaction:{hex:!1,rgba:!0,hsva:!1,input:!0,clear:!1,save:!1}}}]],r=[];let o=null;for(const[l,s]of c){const a=document.createElement("button");a.innerHTML=l,r.push(a),a.addEventListener("click",()=>{const y=document.createElement("p");e.appendChild(y),o&&o.destroyAndRemove();for(const u of r)u.classList[u===a?"add":"remove"]("active");o=new Pickr(Object.assign({el:y,theme:l,default:"#8e54e9"},s)),o.on("changestop",(u,n)=>{let d=n.getColor().toRGBA();document.querySelector("html").style.setProperty("--primary-rgb",`${Math.floor(d[0])}, ${Math.floor(d[1])}, ${Math.floor(d[2])}`),localStorage.setItem("primaryRGB",`${Math.floor(d[0])}, ${Math.floor(d[1])}, ${Math.floor(d[2])}`),i()})}),t.appendChild(a)}r[0].click()}document.getElementById("year").innerHTML=new Date().getFullYear();(function(){document.querySelector("html"),document.querySelector(".main-content"),document.querySelector("#switcher-canvas")&&(q(),g(),m(),setTimeout(()=>{m()},1e3))})();function g(){let e,t,c,r,o,l,s,a,y,u,n=document.querySelector("html");c=document.querySelector("#switcher-light-theme"),r=document.querySelector("#switcher-dark-theme"),e=document.querySelector("#switcher-ltr"),t=document.querySelector("#switcher-rtl"),o=document.querySelector("#switcher-primary"),l=document.querySelector("#switcher-primary1"),s=document.querySelector("#switcher-primary2"),a=document.querySelector("#switcher-primary3"),y=document.querySelector("#switcher-primary4"),u=document.querySelector("#reset-all"),c.addEventListener("click",()=>{v(),localStorage.setItem("velvetHeader","light"),localStorage.setItem("velvetMenu","light")}),r.addEventListener("click",()=>{f(),localStorage.setItem("velvetMenu","dark"),localStorage.setItem("velvetHeader","dark")}),o.addEventListener("click",()=>{localStorage.setItem("primaryRGB","127, 123, 210"),n.style.setProperty("--primary-rgb","127, 123, 210"),i()}),l.addEventListener("click",()=>{localStorage.setItem("primaryRGB","92, 144, 163"),n.style.setProperty("--primary-rgb","92, 144, 163"),i()}),s.addEventListener("click",()=>{localStorage.setItem("primaryRGB","172, 172, 80"),n.style.setProperty("--primary-rgb","172, 172, 80"),i()}),a.addEventListener("click",()=>{localStorage.setItem("primaryRGB","165, 94, 131"),n.style.setProperty("--primary-rgb","165, 94, 131"),i()}),y.addEventListener("click",()=>{localStorage.setItem("primaryRGB","87, 68, 117"),n.style.setProperty("--primary-rgb","87, 68, 117"),i()}),t.addEventListener("click",()=>{localStorage.setItem("velvetrtl",!0),localStorage.removeItem("velvetltr"),p()}),e.addEventListener("click",()=>{localStorage.setItem("velvetltr",!0),localStorage.removeItem("velvetrtl"),h()}),u.addEventListener("click",()=>{n.style.removeProperty("--primary-rgb"),n.removeAttribute("dir","rtl"),n.setAttribute("dir","ltr"),b()})}function h(){var t;let e=document.querySelector("html");(t=document.querySelector("#style"))==null||t.setAttribute("href","http://127.0.0.1:8000/build/assets/libs/bootstrap/css/bootstrap.min.css"),e.setAttribute("dir","ltr"),document.querySelector("#switcher-ltr").checked=!0,m()}function p(){var t;document.querySelector("html").setAttribute("dir","rtl"),(t=document.querySelector("#style"))==null||t.setAttribute("href","http://127.0.0.1:8000/build/assets/libs/bootstrap/css/bootstrap.rtl.min.css"),m()}localStorage.velvetrtl&&p();function v(){document.querySelector("html").setAttribute("data-theme-mode","light"),document.querySelector("#switcher-light-theme").checked=!0,i(),localStorage.removeItem("velvetdarktheme"),m()}function f(){document.querySelector("html").setAttribute("data-theme-mode","dark"),i(),localStorage.setItem("velvetdarktheme",!0),localStorage.removeItem("velvetlighttheme"),m()}function b(){document.querySelector("html"),m(),localStorage.clear(),i(),h(),v()}function m(){localStorage.getItem("velvetdarktheme")&&(document.querySelector("#switcher-dark-theme").checked=!0),localStorage.getItem("velvetrtl")&&(document.querySelector("#switcher-rtl").checked=!0)}function i(){getComputedStyle(document.documentElement).getPropertyValue("--primary-rgb").trim()}i();function q(){if(localStorage.primaryRGB&&(document.querySelector(".theme-container-primary")&&(document.querySelector(".theme-container-primary").value=localStorage.primaryRGB),document.querySelector("html").style.setProperty("--primary-rgb",localStorage.primaryRGB)),localStorage.velvetdarktheme&&document.querySelector("html").setAttribute("data-theme-mode","dark"),localStorage.velvetrtl&&document.querySelector("html").setAttribute("dir","rtl"),localStorage.velvetlayout){let e=document.querySelector("html");localStorage.getItem("velvetlayout"),e.setAttribute("data-nav-layout","horizontal")}}window.addEventListener("scroll",S);function S(){for(var e=document.querySelectorAll(".reveal"),t=0;t<e.length;t++){var c=window.innerHeight,r=e[t].getBoundingClientRect().top,o=150;r<c-o?e[t].classList.add("active"):e[t].classList.remove("active")}}S();const k=document.querySelectorAll(".side-menu__item");k.forEach(e=>{e!="javascript:void(0);"&&e!=="#"&&e.addEventListener("click",t=>{var c;t.preventDefault(),(c=document.querySelector(e.getAttribute("href")))==null||c.scrollIntoView({behavior:"smooth",offsetTop:-59})})});function w(e){const t=document.querySelectorAll(".side-menu__item"),c=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop;t.forEach(r=>{var a;const o=r.getAttribute("href");let l;o!="javascript:void(0);"&&o!=="#"&&(l=document.querySelector(o));const s=c+73;(l==null?void 0:l.offsetTop)<=s&&(l==null?void 0:l.offsetTop)+l.offsetHeight>s?(r.parentElement.parentElement.classList.contains("child1")&&r.parentElement.parentElement.parentElement.children[0].classList.add("active"),r.classList.add("active"),(a=r.closest(".child1"))!=null&&a.previousElementSibling&&r.closest(".child1").previousElementSibling.classList.add("active")):r.classList.remove("active")})}window.document.addEventListener("scroll",w);new Swiper(".pagination-dynamic",{pagination:{el:".swiper-pagination",dynamicBullets:!0,clickable:!0},slidesPerView:1,loop:!0,autoplay:{delay:3e3,disableOnInteraction:!1},breakpoints:{768:{slidesPerView:2,spaceBetween:40},1024:{slidesPerView:2,spaceBetween:50},1400:{slidesPerView:4,spaceBetween:50}}});
