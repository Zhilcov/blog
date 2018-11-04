$(document).ready(function () {

    $('.del').on('click', function () { 
        var id = $(this).attr('name');
        console.log(id);
        $.post(
          "/pages/admin/core.php",
          {
          "action":'del_art',
          "id_art" : id
          }
      );
       })






});