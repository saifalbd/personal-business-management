
$('.remove-selcted').click(function(e) {
const result = [];
$('.node').each(function(){
 var checked = $(this).find('input').is(":checked");
 var valueIs =  $(this).attr('value');
if (checked) {
result.push({id:valueIs})
}
})
location.replace(`/option/remove?ids=${JSON.stringify(result)}`)


})

