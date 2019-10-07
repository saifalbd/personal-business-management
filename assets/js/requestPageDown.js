







function openNumberDialog(numConfrim=false){ 

const  dialogElCreate =()=>{

  const { el, mount } = redom;
function isConfirmNumber(){return (numConfrim=='numConfrim')? $('#requestNumber').val():'' }
function isTable(){ return (numConfrim=='numConfrim')? 'd-none':null  }
return el('.row',
	el('.cell-md-12.number-confirm-cell',isConfirmNumber()),
	el('.cell-md-12.number-zoom-cell',
		el('p.clear',
			el('span.place-left','Request Number'),
			el('span.place-right.zoomCount')),
		el('.input',
			el('input',{type: 'number', autofocus: true, placeholder: 'number',id:'ZoomNumber' }))),
	el(`.cell-md-12 ${isTable()}`,
		el('table.table.row-hover.row-border.cell-border.compact',
			el('thead',
				el('tr',
					el('th','#'),
					el('th','number'),
					el('th','name'),
					el('th','phone'),
					el('th','times'))),
			el('tbody',{id:'ZoomNumberFinderTable'}))))


}


const baseInput = numConfrim=='numConfrim' ? '#number_confirmation':'#requestNumber'
const onCloseDialogs = ()=>{
$(baseInput).val($('#ZoomNumber').val());
$(baseInput).focus();

}


var cssToggle = true;





const dd =  Metro.dialog.create({
    //title: "Use Windows location service?",
    width:600,
    top:100,
    content: "<div class='grid' id='zoomNumberGrid'></div>",
    closeButton: true,
    onClose:()=>{onCloseDialogs()},
    onDialogCreate:function(e){
$(e).css('top','75px');
    },
   	actions:[
   	 {
                    caption: "zoom in",
                    cls: "zommer-button primary",
                    onclick:(e)=>{
                        
                        const baseCss = {
                        	width:$(e)[0].style.width, 
                        	height:'auto', 
                        	visibility:'visible',
                        	top:$(e)[0].style.top,
                        	left:$(e)[0].style.left,
                        	bottom:'auto'
                        }
                       if (cssToggle) {
                       	$(e).css({transform:'scale(1.5)'});
                       	$('.zommer-button').text('zoom Out');

                       	cssToggle = false;
                       }else{
                       $(e).css({transform:''}); 
                       $('.zommer-button').text('zoom in') 
                       	cssToggle = true;
                       }
                       
                    },
       },
   	  {
                    caption: "Close",
                    cls: "js-dialog-close alert",
                    
                },
   	],

});




$('#zoomNumberGrid').append(dialogElCreate());


$('#ZoomNumber').val($(baseInput).val());
$('#ZoomNumber').focus();


if (numConfrim !='numConfrim') {
$('#ZoomNumber').keyup(function(e) {

let inputVal = $(this).val();
let rlnth = $('span.place-right.zoomCount');

if (inputVal.length>11) {$(this).addClass('inVaild');}else{$(this).removeClass('inVaild'); }
if (inputVal.length) {rlnth.text(inputVal.length) }else{ rlnth.text('') }
if (inputVal.length>2) {
axios.get(`/api/order/${inputVal}/show`).then(res=>{

const zoomTable = document.getElementById('ZoomNumberFinderTable');
zoomTable.innerHTML = ''

if (res && res.data && res.data.length) {tableAdd(res.data,zoomTable);}
}).catch(e=>{console.error(e)})
}//
})
}



$(document).keyup(function(e) {
 if (Metro.dialog.isOpen(dd) ) {
   
    if (e.code=='KeyX') { Metro.dialog.close(dd)}
 }

})




}


//console.log(Metro.noop.onOpen())

