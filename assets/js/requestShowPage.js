
$(document).ready(function(){


$("[data-copy]").click(function() {
const id = $(this).attr('data-copy');
$(this).text('im copyed')
$(this).toggleClass("alert");
setTimeout(()=>{$(this).text('copy me'); $(this).toggleClass("alert");},5000)
const findID = document.querySelector(`[data-copy-find='${id}']`);
  findID.select();
  document.execCommand("copy");
   Metro.notify.setup({
            width: 300,
            duration: 3000,
            animation: 'easeOutBounce'
        });
  Metro.notify.create(`copyed ${findID.value} data`, "Copy DONE", {});
  
})


})