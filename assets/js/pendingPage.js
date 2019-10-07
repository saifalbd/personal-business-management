const pendingPage = {
    activeInactive:async function (id,role) {

    }
}


$(document).ready(function(){

    const vendorSelect = $('#peddingTable [data-find="vendorSelect"]');
    const dateSelect = $('#peddingTable [data-find="dateSelect"]');
    const numberSelect= $('#peddingTable [data-find="numberSelect"]');
    const amountSelect= $('#peddingTable [data-find="amountSelect"]');
    const customerSelect = $('#peddingTable [data-find="customerSelect"]');
    const phoneSelect = $('#peddingTable [data-find="phoneSelect"]');

    const table = document.getElementById("peddingTableTbody");

    const copyAbleAdd = (dom,val,pos='right')=>{



        dom.setAttribute("clickThenCopy", "true");
        dom.setAttribute("data-role", "hint");
        dom.setAttribute("data-hint-position",pos);
        dom.setAttribute("data-hint-text",'click then do copy');
        dom.setAttribute("data-txt",val);

    }

    const dataAddOnTable = (data)=>{
        table.innerHTML =''
        if (data['data']) {


            data['data'].forEach( function(list, index) {

                var row = table.insertRow(0);
                var c1 = row.insertCell(0);
                var c2 = row.insertCell(1)
                var c3 = row.insertCell(2);
                var c4 = row.insertCell(3)
                var c5 = row.insertCell(4)
                var c6 = row.insertCell(5)
                var c7 = row.insertCell(6)
                var c8 = row.insertCell(7)
                var c9 = row.insertCell(8)
                c1.innerHTML = list.id;
                c2.innerHTML =  list.number;
                c3.innerHTML =  list.type;
                c4.innerHTML = list.amount;
                c5.innerHTML = list.vendorName;
                c6.innerHTML = list.name;
                c7.innerHTML = list.phone;
                c8.innerHTML = list.date;

                c9.innerHTML = `
<button data-find="active" data-value="${list.id}" class="button primary mini rounded">Active</button>
<a href="/payment/${list.id}/edit" class="button primary mini rounded">Edit</a>
        <a href="/payment/${list.id}/remove" class="button primary mini rounded">Remove</a>`;



                copyAbleAdd(c1,`serial:${list.id}`);
                copyAbleAdd(c2,`serial:${list.number}`);
                copyAbleAdd(c3,`serial:${list.name}`);

            });
        }
    }

    vendorSelect.change(function(){

        let baseUrl = $(this).attr('data-url');
        const vendorVal = vendorSelect.val()
        if (vendorVal) {
            location.replace(`${baseUrl}?vendorid=${vendorVal}`)
        }else{
            location.replace(`${baseUrl}`)
        }

    });

    dateSelect.change(function(){
        let baseUrl = $(this).attr('data-url');
        const dateVal = dateSelect.val()
        if (dateVal) {
            location.replace(`${baseUrl}?date=${dateVal}`)
        }else{
            location.replace(`${baseUrl}`)
        }

    });
//pedding.find('')


    function peddingTableFilter(valis ,eq) {
        // Declare variables
        var input, filter, table, tr, td, i;
        filter = valis.toUpperCase();
        table = document.getElementById("peddingTableTbody");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[eq];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    numberSelect.on('keyup',function(){peddingTableFilter($(this).val(),1)})
    amountSelect.on('keyup',function(){peddingTableFilter($(this).val(),2)})
    customerSelect.on('keyup',function(){peddingTableFilter($(this).val(),4)})
    phoneSelect.on('keyup',function(){peddingTableFilter($(this).val(),5)})

    $(document).on("click", '#peddingTable [data-find="active"]' ,async function(event) {

        const id = $(this).attr('data-value');
        const role = $(this).attr('data-role');


try {
    await saif.activeInactivePayment(id,role);

        saif.notifyAlert.addMessage('successFully Add on SuccessList');

    table.deleteRow($(this).parents('tr').index());
    let counter = $('aside ul.v-menu li');
    counter.find('span.counter').text(table.getElementsByTagName("tr").length);




}catch (e) {
console.error(e);
}

    })


    $(document).on("click", '#recentActiveTable [data-find="inactive"]' ,async function(event) {

       // console.log(this);

        try {
            const table = document.getElementById('recentActiveTable');
            const id = $(this).attr('data-value');
            const role = $(this).attr('data-role');

            await saif.activeInactivePayment(id,role);

            saif.notifyAlert.removeMessage('successFully Add on SuccessList');

            let counter = $('aside ul.v-menu li');
           let digit =  counter.find('span.counter').text();
            counter.find('span.counter').text(parseInt(digit)+1);


            table.deleteRow($(this).parents('tr').index());

        }catch (e) {
            console.error(e);
        }

    })



})