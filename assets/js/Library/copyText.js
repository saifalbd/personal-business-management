



$(document).ready(function(){
function textBoxCreate(){
this.delayIs = 100;
 this.textarea = document.createElement("textarea");

  // Place in top-left corner of screen regardless of scroll position.
  this.textarea.style.position = 'normal';
  this.textarea.style.top = 0;
  this.textarea.style.left = 0;

  // Ensure it has a small width and height. Setting to 1px / 1em
  // doesn't work as this gives a negative w/h on some browsers.
  this.textarea.style.width = '2em';
  this.textarea.style.height = '2em';

  // We don't need padding, reducing the size if it does flash render.
  this.textarea.style.padding = 0;

  // Clean up any borders.
  this.textarea.style.border = 'none';
  this.textarea.style.outline = 'none';
  this.textarea.style.boxShadow = 'none';

  // Avoid flash of white box if rendered for any reason.
  this.textarea.background = 'transparent';

document.body.appendChild(this.textarea);


this.valueAdd = function(val){
	
	this.textarea.value = val;
	return this;
}

this.copyDone = function(callBack=false){

  	 this.textarea.select();
   try {
    var successful = document.execCommand('copy');
    var msg = successful ? true : false;
    if (callBack instanceof Function) {
    	callBack(msg)
    }
    
  } catch (err) {
    console.log('Oops, unable to copy');
  }
  return this;

}

this.delay = function(t) {
	this.delayIs = t;
	return this;
}

this.remove = function(){
	setTimeout(()=>{
		
		document.body.removeChild(this.textarea);
	}, this.delayIs);
	return this;
	
}



}




$('table tr').on('click','[clickThenCopy="true"]',function(){

let isVal = $(this).attr('data-txt');
const textarea = new textBoxCreate();
textarea.valueAdd(isVal).copyDone((success)=>{

 Metro.notify.setup({
            width: 300,
            duration: 5000,
            animation: 'easeOutBounce'
        });
  Metro.notify.create(`<b style="color:blue;">copyed: ${isVal}</b>`, "Copy DONE", {});

}).delay(1000).remove();


})


})