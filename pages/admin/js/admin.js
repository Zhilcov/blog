function init () { 
        $.post(
            "core.php",
            {
            "action":'init'
            },
            showtitle
        );

 }


function showtitle (data){
    data  = JSON.parse(data);
    var out = '<select>';
    for(var id in data){
           out += `<option cat-id="${id}">${data[id].title}</option>`;
    }
    out += '</select>'
    $('.categor').html(out);
    console.log(out);
}


var upload_file = null;
$(document).ready(function () {

init();   

var file=document.getElementById("file");
file.onchange=function()
{   
    upload_file=file.files[0]["name"];
}

$('#do_title').on('click', function () { 
    var id = $('.categor select option:selected').attr('cat-id');
    
    $.post(
      "core.php",
      {
      "action":'insert',
      "title" :$('#title').val(),
      "text" : $('#text').val(),
      "id_cat" : id,
      "image" :upload_file
      }
  );
   })

   $('#do_update').on('click', function () { 
    var id = $('.categor select option:selected').attr('cat-id');
    var id_art = $(this).attr('art_id');
    $.post(
      "core.php",
      {
      "action":'update',
      "title" :$('#title').val(),
      "text" : $('#text').val(),
      "id_cat" : id,
      "image" :upload_file,
      "id_art" : id_art
      }
  );
     
   })
  
});
