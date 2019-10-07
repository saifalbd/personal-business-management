
const sortableTable = ()=>{
const sortRuls = (arr,role='sort')=>{
var  arrIs = arr.sort();
var roleIs =role.toLowerCase(); 
if (roleIs=="reverse") {
arrIs = arr.sort().reverse();  
}
const numberArray = arrIs.filter((item)=>{return  !isNaN(item);})
const textArray = arrIs.filter((item)=>{return  isNaN(item);})
numberArray.sort(function(a, b){
  return roleIs=="reverse" ? b-a :a-b
});
if (roleIs=="reverse") {
return numberArray.concat(textArray)
}else{
 return textArray.concat(numberArray)

}
} //
$(`[custom-sortable="true"]`).each(function(){
var thead = $(this).find('thead tr.sortable-tr');
var tbody = $(this).children('tbody').eq(0);
thead.each(function() {
$(this).find('th').each(function(){
var th = $(this);
if (th.hasClass("sortable-column")) {
  th.click(function(){
 let thIndex =  th.index();
 let tdValues = [];
tbody.find('tr').each(function(){
  let tr = $(this);
  let trIndex = tr.index();
  let td = $(this).children('td').eq(thIndex);
  tdValues.push(td.text().trim())
 })
$(this).siblings().removeClass("sort-asc sort-desc");
  const  tdValuesSort = ()=>{
    if ($(this).hasClass("sort-asc")) {
     $(this).addClass('sort-desc').removeClass('sort-asc');
    return sortRuls(tdValues)
    }else{
     $(this).addClass('sort-asc').removeClass('sort-desc');
      return sortRuls(tdValues,'reverse');
    }
  }
 var sortValues =tdValuesSort();
sortValues.forEach((item, index)=> {
let tableRow =  tbody.find('tr').filter(function() {
  let tdTxt = $(this).children('td').eq(thIndex).text();
        return tdTxt.trim().toLowerCase() == item.trim().toLowerCase()
    })
tbody.append(tableRow);
});
  })
}
})
})
})
}


$(document).ready(function(){
	sortableTable()
})
