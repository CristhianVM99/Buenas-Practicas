let c=()=>{typeof success<"u"&&success&&n({mensaje:success,clase:"success"}),typeof danger<"u"&&danger&&n({mensaje:danger,clase:"danger"}),typeof warning<"u"&&warning&&n({mensaje:warning,clase:"warning"}),typeof error<"u"&&error&&n({mensaje:error,clase:"error"}),typeof info<"u"&&info&&n({mensaje:info,clase:"info"})};$(".mensaje-toast").on("click",".close",function(){$(this).closest(".toast").remove()}).on("ready",c());function f(e){var i,t,r,o;let s=document.createElement("div"),a=(i=e.timer)!=null?i:5e3;return s.classList.add("toast",(t=e.clase)!=null?t:" success",(r=e.animation_init)!=null?r:"slideLeftRight"),s.innerHTML=`
        ${(o=e.mensaje)!=null?o:"No se defini\xF3 un mensaje"}
        <span class="close">\u2716</span>
    `,a<1e7&&setTimeout(()=>{s.remove()},a),s}function n(e={}){$(".mensaje-toast").append(f(e))}export{n as m};