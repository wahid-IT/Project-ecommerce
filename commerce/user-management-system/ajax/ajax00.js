$(document).on('click','#btn-add',function(e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/save00.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#addEmployeeModal').modal('hide');
                    alert('Data added successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
$(document).on('click','.update',function(e) {
    var num=$(this).attr("data-id");
    var numm=$(this).attr("data-id");
    var exercise=$(this).attr("data-exercise");
    var chauffeur=$(this).attr("data-chauffeur");
    var objet=$(this).attr("data-objet_om");
    var date_m=$(this).attr("data-date_m");
    var date_r=$(this).attr("data-date_r");
    var destination=$(this).attr("data-destination");
    var moyen=$(this).attr("data-moyen");
    var matricule=$(this).attr("data-matricule");
    var missionnaire1=$(this).attr("data-missionnaire1");
    var missionnaire2=$(this).attr("data-missionnaire2");
    var missionnaire3=$(this).attr("data-missionnaire3");
    var missionnaire4=$(this).attr("data-missionnaire4");
    var marchandise=$(this).attr("data-marchandise");
    var aller=$(this).attr("data-aller");
    var retour=$(this).attr("data-retour");
    $('#num_u').val(num);
    $('#numm_u').val(numm);
    $('#exercise_u').val(exercise);
    $('#chauffeur_u').val(chauffeur);
    $('#objet_u').val(objet);
    $('#datem_u').val(date_m);
    $('#dater_u').val(date_r);
    $('#destination_u').val(destination);
    $('#moyen_u').val(moyen);
    $('#matricule_u').val(matricule);
    $('#missionnaire1_u').val(missionnaire1);
    $('#missionnaire2_u').val(missionnaire2);
    $('#missionnaire3_u').val(missionnaire3);
    $('#missionnaire4_u').val(missionnaire4);
    $('#marchandise_u').val(marchandise);
    $('#aller_u').val(aller);
    $('#retour_u').val(retour);
});

$(document).on('click','#update',function(e) {
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/save00.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#editEmployeeModal').modal('hide');
                    alert('Data updated successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
$(document).on("click", ".delete", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
    
});
$(document).on("click", "#delete", function() { 
    $.ajax({
        url: "backend/save00.php",
        type: "POST",
        cache: false,
        data:{
            type:3,
            id: $("#id_d").val()
        },
        success: function(dataResult){
                $('#deleteEmployeeModal').modal('hide');
                $("#"+dataResult).remove();
                location.reload();
        }
    });
});
$(document).on("click", "#delete_multiple", function() {
    var user = [];
    $(".user_checkbox:checked").each(function() {
        user.push($(this).data('user-id'));
    });
    if(user.length <=0) {
        alert("Please select records."); 
    } 
    else { 
        WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if(checked == true) {
            var selected_values = user.join(",");
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "backend/save00.php",
                cache:false,
                data:{
                    type: 4,						
                    id : selected_values
                },
                success: function(response) {
                    var ids = response.split(",");
                    for (var i=0; i < ids.length; i++ ) {	
                        $("#"+ids[i]).remove(); 
                    }	
                    location.reload();
                } 
            }); 
        }  
    } 
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });
});