var C=Object.defineProperty;var N=(e,t,i)=>t in e?C(e,t,{enumerable:!0,configurable:!0,writable:!0,value:i}):e[t]=i;var y=(e,t,i)=>(N(e,typeof t!="symbol"?t+"":t,i),i);const s=document.getElementById("sidebar");let b=document.querySelector(".main-content");const R=document.querySelectorAll(".nav > ul > .slide.has-sub"),I=document.querySelectorAll(".nav > ul > .slide.has-sub > a"),T=document.querySelectorAll(".nav > ul > .slide.has-sub .slide.has-sub > a");class _{constructor(t,i){y(this,"instance",null);y(this,"reference",null);y(this,"popperTarget",null);this.init(t,i)}init(t,i){this.reference=t,this.popperTarget=i,this.instance=Popper.createPopper(this.reference,this.popperTarget,{placement:"bottom",strategy:"relative",resize:!0,modifiers:[{name:"computeStyles",options:{adaptive:!1}}]}),document.addEventListener("click",l=>this.clicker(l,this.popperTarget,this.reference),!1);const n=new ResizeObserver(()=>{this.instance.update()});n.observe(this.popperTarget),n.observe(this.reference)}clicker(t,i,n){s.classList.contains("collapsed")&&!i.contains(t.target)&&!n.contains(t.target)&&this.hide()}hide(){}}class O{constructor(){y(this,"subMenuPoppers",[]);this.init()}init(){R.forEach(t=>{this.subMenuPoppers.push(new _(t,t.lastElementChild)),this.closePoppers()})}togglePopper(t){window.getComputedStyle(t).visibility==="hidden"&&window.getComputedStyle(t).visibility===void 0?t.style.visibility="visible":t.style.visibility="hidden"}updatePoppers(){this.subMenuPoppers.forEach(t=>{t.instance.state.elements.popper.style.display="none",t.instance.update()})}closePoppers(){this.subMenuPoppers.forEach(t=>{t.hide()})}}const A=(e,t=300)=>{const{parentElement:i}=e;i.classList.remove("open"),e.style.transitionProperty="height, margin, padding",e.style.transitionDuration=`${t}ms`,e.style.boxSizing="border-box",e.style.height=`${e.offsetHeight}px`,e.offsetHeight,e.style.overflow="hidden",e.style.height=0,e.style.paddingTop=0,e.style.paddingBottom=0,e.style.marginTop=0,e.style.marginBottom=0,window.setTimeout(()=>{e.style.display="none",e.style.removeProperty("height"),e.style.removeProperty("padding-top"),e.style.removeProperty("padding-bottom"),e.style.removeProperty("margin-top"),e.style.removeProperty("margin-bottom"),e.style.removeProperty("overflow"),e.style.removeProperty("transition-duration"),e.style.removeProperty("transition-property")},t)},q=(e,t=300)=>{const{parentElement:i}=e;i.classList.add("open"),e.style.removeProperty("display");let{display:n}=window.getComputedStyle(e);n==="none"&&(n="block"),e.style.display=n;const l=e.offsetHeight;e.style.overflow="hidden",e.style.height=0,e.style.paddingTop=0,e.style.paddingBottom=0,e.style.marginTop=0,e.style.marginBottom=0,e.offsetHeight,e.style.boxSizing="border-box",e.style.transitionProperty="height, margin, padding",e.style.transitionDuration=`${t}ms`,e.style.height=`${l}px`,e.style.removeProperty("padding-top"),e.style.removeProperty("padding-bottom"),e.style.removeProperty("margin-top"),e.style.removeProperty("margin-bottom"),window.setTimeout(()=>{e.style.removeProperty("height"),e.style.removeProperty("overflow"),e.style.removeProperty("transition-property"),e.style.removeProperty("transition-duration")},t)},x=(e,t=300)=>{let i=document.querySelector("html");if(!(i.getAttribute("data-nav-style")==="menu-hover"&&i.getAttribute("data-toggled")==="menu-hover-closed"&&window.innerWidth>=992||i.getAttribute("data-nav-style")==="icon-hover"&&i.getAttribute("data-toggled")==="icon-hover-closed"&&window.innerWidth>=992)&&e&&e.nodeType!=3)return window.getComputedStyle(e).display==="none"?q(e,t):A(e,t)};new O;const z=document.querySelectorAll(".slide.has-sub.open");z.forEach(e=>{e.lastElementChild.style.display="block"});I.forEach(e=>{e.addEventListener("click",()=>{let t=document.querySelector("html");if(!(t.getAttribute("data-nav-style")==="menu-hover"&&t.getAttribute("data-toggled")==="menu-hover-closed"&&window.innerWidth>=992||t.getAttribute("data-nav-style")==="icon-hover"&&t.getAttribute("data-toggled")==="icon-hover-closed"&&window.innerWidth>=992)){const i=e.closest(".nav.sub-open");i&&i.querySelectorAll(":scope > ul > .slide.has-sub > a").forEach(n=>{(n.nextElementSibling.style.display==="block"||window.getComputedStyle(n.nextElementSibling).display==="block")&&A(n.nextElementSibling)}),x(e.nextElementSibling)}})});T.forEach(e=>{document.querySelector("html"),e.addEventListener("click",()=>{const t=e.closest(".slide-menu");t&&t.querySelectorAll(":scope .slide.has-sub > a").forEach(i=>{var n;i.nextElementSibling&&((n=i.nextElementSibling)==null?void 0:n.style.display)==="block"&&A(i.nextElementSibling)}),x(e.nextElementSibling)})});let k,a;(()=>{let e=document.querySelector("html");k=document.querySelector(".sidemenu-toggle"),k.addEventListener("click",p);let t=document.querySelector(".main-content");window.innerWidth<=992?t.addEventListener("click",g):t.removeEventListener("click",g),a=[window.innerWidth],f(),e.getAttribute("data-nav-layout")==="horizontal"&&window.innerWidth>=992?(c(),t.addEventListener("click",c)):t.removeEventListener("click",c),window.addEventListener("resize",M),B(),!localStorage.getItem("velvetlayout")&&!localStorage.getItem("velvetnavstyles")&&!localStorage.getItem("velvetverticalstyles")&&!document.querySelector(".landing-body")&&document.querySelector("html").getAttribute("data-nav-layout")!=="horizontal"&&!e.getAttribute("data-vertical-style")&&!e.getAttribute("data-nav-style")&&W(),p(),e.getAttribute("data-vertical-style")==="detached"&&e.removeAttribute("data-toggled"),(e.getAttribute("data-nav-style")==="menu-hover"||e.getAttribute("data-nav-style")==="icon-hover")&&window.innerWidth>=992&&c(),window.innerWidth<992&&e.setAttribute("data-toggled","close")})();function M(){let e=document.querySelector("html"),t=document.querySelector(".main-content");a.push(window.innerWidth),a.length>2&&a.shift(),a.length>1&&(a[a.length-1]<992&&a[a.length-2]>=992&&(t.addEventListener("click",g),f(),p(),t.removeEventListener("click",c)),a[a.length-1]>=992&&a[a.length-2]<992&&(t.removeEventListener("click",g),p(),e.getAttribute("data-nav-layout")==="horizontal"?(c(),t.addEventListener("click",c)):t.removeEventListener("click",c),e.removeAttribute("data-toggled"))),P()}function g(){document.querySelector("html").setAttribute("data-toggled","close"),document.querySelector("#responsive-overlay").classList.remove("active")}function p(){let e=document.querySelector("html"),t=e.getAttribute("data-nav-layout");if(window.innerWidth>=992){if(t==="vertical"){switch(s.removeEventListener("mouseenter",u),s.removeEventListener("mouseleave",h),s.removeEventListener("click",L),b.removeEventListener("click",S),document.querySelectorAll(".main-menu li > .side-menu__item").forEach(o=>o.removeEventListener("click",E)),e.getAttribute("data-vertical-style")){case"closed":e.removeAttribute("data-nav-style"),e.getAttribute("data-toggled")==="close-menu-close"?e.removeAttribute("data-toggled"):e.setAttribute("data-toggled","close-menu-close");break;case"overlay":e.removeAttribute("data-nav-style"),e.getAttribute("data-toggled")==="icon-overlay-close"?(e.removeAttribute("data-toggled","icon-overlay-close"),s.removeEventListener("mouseenter",u),s.removeEventListener("mouseleave",h)):window.innerWidth>=992?(localStorage.getItem("velvetlayout")||e.setAttribute("data-toggled","icon-overlay-close"),s.addEventListener("mouseenter",u),s.addEventListener("mouseleave",h)):(s.removeEventListener("mouseenter",u),s.removeEventListener("mouseleave",h));break;case"icontext":e.removeAttribute("data-nav-style"),e.getAttribute("data-toggled")==="icon-text-close"?(e.removeAttribute("data-toggled","icon-text-close"),s.removeEventListener("click",L),b.removeEventListener("click",S)):(e.setAttribute("data-toggled","icon-text-close"),window.innerWidth>=992?(s.addEventListener("click",L),b.addEventListener("click",S)):(s.removeEventListener("click",L),b.removeEventListener("click",S)));break;case"doublemenu":if(e.removeAttribute("data-nav-style"),e.getAttribute("data-toggled")==="double-menu-open")e.setAttribute("data-toggled","double-menu-close"),document.querySelector(".slide-menu")&&document.querySelectorAll(".slide-menu").forEach(r=>{r.classList.contains("double-menu-active")&&r.classList.remove("double-menu-active")});else{let o=document.querySelector(".side-menu__item.active");o&&(e.setAttribute("data-toggled","double-menu-open"),o.nextElementSibling?o.nextElementSibling.classList.add("double-menu-active"):document.querySelector("html").setAttribute("data-toggled","double-menu-close"))}D();break;case"detached":e.getAttribute("data-toggled")==="detached-close"?(e.removeAttribute("data-toggled","detached-close"),s.removeEventListener("mouseenter",u),s.removeEventListener("mouseleave",h)):(e.setAttribute("data-toggled","detached-close"),window.innerWidth>=992?(s.addEventListener("mouseenter",u),s.addEventListener("mouseleave",h)):(s.removeEventListener("mouseenter",u),s.removeEventListener("mouseleave",h)));break;case"default":W(),e.removeAttribute("data-toggled");break}switch(e.getAttribute("data-nav-style")){case"menu-click":e.getAttribute("data-toggled")==="menu-click-closed"?e.removeAttribute("data-toggled"):e.setAttribute("data-toggled","menu-click-closed");break;case"menu-hover":e.getAttribute("data-toggled")==="menu-hover-closed"?(e.removeAttribute("data-toggled"),f()):(e.setAttribute("data-toggled","menu-hover-closed"),c());break;case"icon-click":e.getAttribute("data-toggled")==="icon-click-closed"?e.removeAttribute("data-toggled"):e.setAttribute("data-toggled","icon-click-closed");break;case"icon-hover":e.getAttribute("data-toggled")==="icon-hover-closed"?(e.removeAttribute("data-toggled"),f()):(e.setAttribute("data-toggled","icon-hover-closed"),c());break}}}else if(e.getAttribute("data-toggled")==="close"){e.setAttribute("data-toggled","open");let i=document.createElement("div");i.id="responsive-overlay",setTimeout(()=>{document.querySelector("html").getAttribute("data-toggled")=="open"&&(document.querySelector("#responsive-overlay").classList.add("active"),document.querySelector("#responsive-overlay").addEventListener("click",()=>{document.querySelector("#responsive-overlay").classList.remove("active"),console.log(i.id),g()})),window.addEventListener("resize",()=>{window.screen.width>=992&&document.querySelector("#responsive-overlay").classList.remove("active")})},100)}else e.setAttribute("data-toggled","close")}function u(){document.querySelector("html").setAttribute("data-icon-overlay","open")}function h(){document.querySelector("html").removeAttribute("data-icon-overlay")}function L(){document.querySelector("html").setAttribute("data-icon-text","open")}function S(){document.querySelector("html").removeAttribute("data-icon-text")}function W(){let e=document.querySelector("html");e.setAttribute("data-nav-layout","vertical"),e.setAttribute("data-vertical-style","overlay"),p(),f()}function f(){let e=window.location.pathname.split("/")[0];console.log(e),e=location.pathname=="/"?"index":location.pathname.substring(1),e=e.substring(e.lastIndexOf("/")+1),document.querySelectorAll(".side-menu__item").forEach(i=>{if(e==="/"&&(e="index"),i.getAttribute("href")===window.location.href){i.classList.add("active"),i.parentElement.classList.add("active");let n=i.closest("ul");if(i.closest("ul:not(.main-menu)"),n){if(n.classList.add("active"),n.previousElementSibling.classList.add("active"),n.parentElement.classList.add("active"),n.parentElement.classList.contains("has-sub")){let l=n.parentElement.parentElement.parentElement;l.classList.add("open","active"),l.firstElementChild.classList.add("active"),l.children[1].style.display="block",Array.from(l.children[1].children).map(o=>{o.classList.contains("active")&&(o.children[1].style.display="block")})}n.classList.contains("child1")&&q(n),n=n.parentElement.closest("ul"),n&&n.closest("ul:not(.main-menu)")&&n.closest("ul:not(.main-menu)")}}})}function c(){document.querySelectorAll("ul.slide-menu").forEach(t=>{let i=t.closest("ul"),n=t.closest("ul:not(.main-menu)");if(i){let l=i.closest("ul.main-menu");for(;l;)i.classList.add("active"),A(i),i=i.parentElement.closest("ul"),n=i.closest("ul:not(.main-menu)"),n||(l=!1)}})}function B(){let e=document.querySelector(".slide-left"),t=document.querySelector(".slide-right");function i(){let n=document.querySelectorAll(".slide"),l=document.querySelectorAll(".slide-menu");n.forEach((o,r)=>{o.classList.contains("is-expanded")==!0&&o.classList.remove("is-expanded")}),l.forEach((o,r)=>{o.classList.contains("open")==!0&&(o.classList.remove("open"),o.style.display="none")})}P(),e.addEventListener("click",()=>{let n=document.querySelector(".main-menu"),l=document.querySelector(".main-sidebar"),o=Math.ceil(Number(window.getComputedStyle(n).marginLeft.split("px")[0])),r=Math.ceil(Number(window.getComputedStyle(n).marginRight.split("px")[0])),d=l.offsetWidth;n.scrollWidth>l.offsetWidth?document.querySelector("html").getAttribute("dir")!=="rtl"?o<0&&!(Math.abs(o)<d)?(n.style.marginRight=0,n.style.marginLeft=Number(n.style.marginLeft.split("px")[0])+Math.abs(d)+"px",t.classList.remove("d-none")):(o>=0,n.style.marginLeft="0px",e.classList.add("d-none"),t.classList.remove("d-none")):r<0&&!(Math.abs(r)<d)?(n.style.marginLeft=0,n.style.marginRight=Number(n.style.marginRight.split("px")[0])+Math.abs(d)+"px",t.classList.remove("d-none")):(r>=0,n.style.marginRight="0px",e.classList.add("d-none"),t.classList.remove("d-none")):(document.querySelector(".main-menu").style.marginLeft="0px",document.querySelector(".main-menu").style.marginRight="0px",e.classList.add("d-none"));let m=document.querySelector(".main-menu > .slide.open"),v=document.querySelector(".main-menu > .slide.open >ul");m&&m.classList.remove("open"),v&&(v.style.display="none"),i()}),t.addEventListener("click",()=>{let n=document.querySelector(".main-menu"),l=document.querySelector(".main-sidebar"),o=Math.ceil(Number(window.getComputedStyle(n).marginLeft.split("px")[0])),r=Math.ceil(Number(window.getComputedStyle(n).marginRight.split("px")[0])),d=n.scrollWidth-l.offsetWidth,m=l.offsetWidth;n.scrollWidth>l.offsetWidth&&(document.querySelector("html").getAttribute("dir")!=="rtl"?Math.abs(d)>Math.abs(o)&&(n.style.marginRight=0,Math.abs(d)>Math.abs(o)+m||(m=Math.abs(d)-Math.abs(o),t.classList.add("d-none")),n.style.marginLeft=Number(n.style.marginLeft.split("px")[0])-Math.abs(m)+"px",e.classList.remove("d-none")):Math.abs(d)>Math.abs(r)&&(n.style.marginLeft=0,Math.abs(d)>Math.abs(r)+m||(m=Math.abs(d)-Math.abs(r),t.classList.add("d-none")),n.style.marginRight=Number(n.style.marginRight.split("px")[0])-Math.abs(m)+"px",e.classList.remove("d-none")));let v=document.querySelector(".main-menu > .slide.open"),w=document.querySelector(".main-menu > .slide.open >ul");v&&v.classList.remove("open"),w&&(w.style.display="none"),i()})}function P(){let e=document.querySelector(".main-menu"),t=document.querySelector(".main-sidebar"),i=document.querySelector(".slide-left"),n=document.querySelector(".slide-right"),l=Math.ceil(Number(window.getComputedStyle(e).marginLeft.split("px")[0])),o=Math.ceil(Number(window.getComputedStyle(e).marginRight.split("px")[0])),r=e.scrollWidth-t.offsetWidth;e.scrollWidth>t.offsetWidth?(n.classList.remove("d-none"),i.classList.add("d-none")):(n.classList.add("d-none"),i.classList.add("d-none"),e.style.marginLeft="0px",e.style.marginRight="0px"),document.querySelector("html").getAttribute("dir")!=="rtl"?(e.scrollWidth>t.offsetWidth&&Math.abs(r)<Math.abs(l)&&(e.style.marginLeft=-r+"px",i.classList.remove("d-none"),n.classList.add("d-none")),l==0?i.classList.add("d-none"):i.classList.remove("d-none")):(e.scrollWidth>t.offsetWidth&&Math.abs(r)<Math.abs(o)&&(e.style.marginRight=-r+"px",i.classList.remove("d-none"),n.classList.add("d-none")),o==0?i.classList.add("d-none"):i.classList.remove("d-none")),(l!=0||o!=0)&&i.classList.remove("d-none")}["switcher-icon-click","switcher-icon-hover","switcher-horizontal"].map(e=>{document.getElementById(e)&&document.getElementById(e).addEventListener("click",()=>{let t=document.querySelector(".main-menu"),i=document.querySelector(".main-sidebar");setTimeout(()=>{t.offsetWidth>i.offsetWidth?document.getElementById("slide-right").classList.remove("d-none"):document.getElementById("slide-right").classList.add("d-none")},100)})});function D(){window.innerWidth>=992&&(document.querySelector("html"),document.querySelectorAll(".main-menu > li > .side-menu__item").forEach(t=>{t.addEventListener("click",E)}))}function E(){var e=this;let t=document.querySelector("html");var i=e.nextElementSibling;i&&(i.classList.contains("double-menu-active")||(document.querySelector(".slide-menu")&&document.querySelectorAll(".slide-menu").forEach(l=>{l.classList.contains("double-menu-active")&&(l.classList.remove("double-menu-active"),t.setAttribute("data-toggled","double-menu-close"))}),i.classList.add("double-menu-active"),t.setAttribute("data-toggled","double-menu-open")))}window.addEventListener("unload",()=>{document.querySelector(".main-content").removeEventListener("click",c),window.removeEventListener("resize",M),document.querySelectorAll(".main-menu li > .side-menu__item").forEach(i=>i.removeEventListener("click",E))});let V=()=>{document.querySelectorAll(".side-menu__item").forEach(e=>{if(e.classList.contains("active")){let t=e.getBoundingClientRect();e.children[0]&&e.parentElement.classList.contains("has-sub")&&t.top>435&&e.scrollIntoView({behavior:"smooth"})}})};setTimeout(()=>{V()},300);document.querySelector(".main-content").addEventListener("click",()=>{document.querySelectorAll(".slide-menu").forEach(e=>{(document.querySelector("html").getAttribute("data-toggled")=="menu-click-closed"||document.querySelector("html").getAttribute("data-toggled")=="icon-click-closed")&&(e.style.display="none")})});
