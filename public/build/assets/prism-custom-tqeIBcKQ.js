(function(){document.querySelectorAll(".prism-toggle").forEach(e=>{e.addEventListener("click",()=>{console.log(e.firstElementChild.childNodes);let s=e.parentNode.parentNode;s.children[1].classList.contains("d-none")?(e.firstElementChild.childNodes[1].className="ri-code-line ms-2 align-middle",s.children[1].classList.remove("d-none"),s.children[2].classList.add("d-none")):(e.firstElementChild.childNodes[1].className="ri-code-s-slash-line ms-2 align-middle",s.children[1].classList.add("d-none"),s.children[2].classList.remove("d-none"))})})})();
