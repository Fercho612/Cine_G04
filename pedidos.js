function seat_active(row,column){
  seat_id = '`' + row +'`,' + column.toString();
  console.log(seat_id);
  seat_activ = `<img class="seat_active" src='Multimedia/Sillas/seat-activate.png' alt='asiento' 
  onclick='rm_seat_active(`+ seat_id +`)'>`;
  $("[value='"+row+column+"'] img").remove();
  $("[value='"+row+column+"']").append(seat_activ);
}
function rm_seat_active(row,column){
  seat_id = '`' + row +'`,' + column.toString();
  seat_desact = `<img src='Multimedia/Sillas/seat-free.png' alt='asiento' onclick='seat_active(`+ seat_id +`)'>`;
  $("[value='"+row+column+"'] img").remove();
  $("[value='"+row+column+"']").append(seat_desact);
}
function save_seats(){
  var seats_select = [];
  for(i=1;i<=12;i++){
    let row = 64 + i;
    if(i<=2){
      for(j=1;j<=10;j++){
        if($("[value='"+String.fromCharCode(row)+j+"'] img").hasClass('seat_active')){
          seats_select.push(String.fromCharCode(row)+j);
        };
      }
    }
    if(i>2 && i<=11){
      for(j=1;j<=9;j++){
        if($("[value='"+String.fromCharCode(row)+j+"'] img").hasClass('seat_active')){
          seats_select.push(String.fromCharCode(row)+j);
        };
      }
    }
    if(i>11){
      for(j=1;j<=15;j++){
        if($("[value='"+String.fromCharCode(row)+j+"'] img").hasClass('seat_active')){
          seats_select.push(String.fromCharCode(row)+j);
        };
      }
    }   
  }
  console.log(seats_select);
  var strginSeat = seats_select.join(',');
  $("#arr").val(strginSeat);
}