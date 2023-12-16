import{j as c}from"./jquery.js";c(function(e){e('[type="checkbox"]').on("click",function(){const t=this;t.checked?e(t).val("on"):(e(t).removeAttr("value"),e(t).removeAttr("checked"))})});
