$( document ).ready(function() {
    var count = $('#table1 tr').length;
    var count1 = $('#table2 tr').length;
    var diff = count1-count;
    alert(diff);
    var a;
    if(count>count1){
      for(a=0;a<diff;a++){
       $('#table1').closest('table').find('tr:last').prev().after('<tr><td>&nbsp;</td><td></td><td></td><td></td></tr>');
      }
    }
    else{
      for(a=0;a<diff;a++){
       $('#table1').closest('table').find('tr:last').prev().after('<tr><td>&nbsp;</td><td></td><td></td><td></td></tr>');
      }
    }

});