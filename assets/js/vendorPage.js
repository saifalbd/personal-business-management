

$(document).ready(function() {
const { el, mount } =redom;

const dateVal = ()=>{
const d = new Date();
return `${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`;
};

const vendorPays = async (id,slug)=>{
	try {
		const {data} = await axios.get(`/api/vendors/${id}/${slug}`);
		return data.data;
	}catch (e) {
console.error(e);
	}



};

	const winContent = (data,resouece)=>{

		const  pay = resouece;


return el('.grid',
	el('.row',
		el('.cell-12',
			el('.row',
				[el('.stub', { style: { width: '50px','background':'grey' } }),
				el('.cell',{ style: { 'background':'lightgrey' } },`List ${data.name} of payments`)]),
			el('.row.mt-4.p-5',
				el('.stub', { style: { width: '200px','background':'lightgrey' } },`add ${data.info.paymentType} payment`),
				el('.cell-12.p-2',
					el('form',{method:'get',action:`/vendors/${data.id}/payment`,'accept-charset':'UTF-8'},
						el('input',{name:'paymentType',value:data.info.paymentType,type: 'hidden',required:true }),
						el('.row.p-1',{style:{'border': '1px solid black'}},
							el('.cell-md-3.d-flex.flex-justify-end.flex-align-center',{style:'background: lightgrey;'},'amount'),
							el('.cell-md-9.pt-1',
								el('input',{name:'amount',type: 'text', autofocus: true, placeholder: 'amount',required:true })),
							el('.cell-md-3.d-flex.flex-justify-end.flex-align-center',{style:'background: lightgrey;'},'Date'),
							el('.cell-md-9.pt-1',
								el('input',{name:'date','data-role':'calendarpicker','data-calendar-wide-point':'md',value:dateVal(),required:true})),
							el('.cell-md-3.d-flex.flex-justify-end.flex-align-center',{style:'background: lightgrey;'},'type'),
							el('.cell-md-9.pt-1',
								el('select',{name:'amountType',required:true },
									el('option',{value:'prepaid'},'prepaid'),
									el('option',{value:'return'},'return'))),
							el('.cell-md-3.d-flex.flex-justify-end.flex-align-center',{style:'background: lightgrey;'},' Description'),
							el('.cell-md-9.pt-1',
								el('input',{name:'description', type: 'text', autofocus: true, placeholder: 'description',required:true }))),
						el('.row',
							el('.cell.text-right',el('button.button.primary',{type:'submit'},'Add Payment'))))))
			),

		el('.cell-12',
			el('table.table.subcompact.table-border.cell-border',
				[el('thead',
					el('tr',
						[
						el('th.sortable-column sort-asc','#'),
						el('th.sortable-column sort-asc','money'),
						el('th.sortable-column sort-asc','type'),
						el('th.sortable-column sort-asc','date'),
							el('th.sortable-column sort-asc','comment'),
						])),
				el('tbody',pay.map((item,index)=>{

		return	 el('tr',
				el('td',index+1),
				el('td',item.amount),
				el('td',item.amount<1?'return':'prepaid'),
				el('td',item.date),
				el('td',item.comment)
				)

		}))
				]))
		)
	)


 
}


$('#vendorCreditAdd[add-cradit]').click(async function(){
const data = JSON.parse($(this).attr('vendor-info'));
const winId = '#creditWin2';
const win = Metro.window;
data.info = {'paymentType':'credit'};
console.log(data);
 win.create({
        resizeable: true,
        draggable: true,
        width: 600,
        height: 600,
        top:60,
        left:200,
        icon: "<span class='mif-rocket'></span>",
        title: 'credit Payment',
        content: `<div class="container" id="winCreditContent"></div>`,
    })
	const {list}= await vendorPays(data.id,'credit');
$('#winCreditContent').append(winContent(data,list))

//
});


$('#vendorDebitAdd[add-debit]').click(async function(){
const data = JSON.parse($(this).attr('vendor-info'));
const winId = '#creditWin2';
const win = Metro.window;

data.info = {'paymentType':'debit'};

 win.create({
        resizeable: true,
        draggable: true,
        width: 600,
        height: 600,
        top:60,
        left:200,
        icon: "<span class='mif-rocket'></span>",
        title: 'debit Payment',
        content: `<div class="container" id="winCreditContent"></div>`,
    });
	const {list}= await vendorPays(data.id,'debit');
$('#winCreditContent').append(winContent(data,list))

//
});




})