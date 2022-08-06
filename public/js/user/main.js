$(document).ready(function(){
   
   $(".cancelbtn").click(function(){
    $(".update-profile").hide();
    $(".profile").show();
   });
   $(".btnEdit").click(function(){
    $(".update-profile").show();
    $(".profile").hide();
   });
});
function destroyData(link){
    swal({
        icon: 'warning',
        title: 'Logout?',
        text: 'Are you sure you want to logout?',
        buttons: ["No", "Yes"],
        dangerMode: true,
    })
        .then(isClose => {
            if (isClose) {
                window.location = $(link).attr('action');
            } else {
               
            }
        });
}
function agecalculator(){
    var dNow = new Date();
 
 var birthday = document.getElementById('bday');
 var dob = new Date(birthday.value);

 var cmm = dNow.getMonth()+1;
 var cdd = dNow.getDate();
 var cyy = dNow.getFullYear();

 var dd = dob.getDate()+1;
 var mm = dob.getMonth()+1;
 var yy = dob.getFullYear();

 var agebyyear = Math.abs(yy - dNow.getFullYear());
 
 if((agebyyear > 12 && mm < cmm ) || (agebyyear > 12 && mm == cmm && dd <= cdd))
 {
     $(".age").html(agebyyear+ " years old");
     $('#age').val(agebyyear);
 }else if((agebyyear > 12 && mm > cmm ) || (agebyyear > 12 && mm == cmm && dd >= cdd)){
     $(".age").html(agebyyear - 1 + " years old");
     $('#age').val(agebyyear - 1);
 }
 else 
 {
     $(".age").html("Underage");
 }


}