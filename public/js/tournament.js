
$(document).ready(function () {
  console.log('rdy');
  
  function base_url(subdirectory) {
    return IS.base_url + (subdirectory || '');
  }
  
  if($('.display-back')){
    let index = $('.display-back').length-1;
    $('.display-back').eq(index).show();
  }
if( $('#dataTable-report').val()){
  $('#dataTable-report').DataTable( {
       fixedHeader: true
   } );

}
  $('body')
    .on('change', '#inputPlayers, #inputGender, #inputTournamentName', function(event) {
      // console.log('this', $(this).val());
      if(($("#inputPlayers").val()>0) && ($("#inputGender").val()>0) && $('#inputTournamentName').val() ){
        $('.create-button').prop('disabled', false);
      }else{
        $('.create-button').prop('disabled', true);
      }
    })
    //search home
    .on('click', '.create-button', function (event) {
      let data = {
        playerNum:$('#inputPlayers').val(),
        tournamentName:$('#inputTournamentName').val(),
        gender:$('#inputGender').val(),
      }
      create_inputs(data);
    
    })

    .on('click', '.search-button', function (event) {
      let data = {
        tournament:$('#inputTournament').val(),
        gender:$('#inputGender').val(),
        inputDate:$('#inputDate').val(),
      }
      search_tournament(data);
    
    })

  function create_inputs(data) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: base_url('/generate_input'),
      type: 'POST',
      dataType: 'json',
      data: data,
      beforeSend: function () {
        $('body>.content-preloader').fadeIn('slow');
      },
      success: function (data) {
        // console.log("response",data);
        $('.player-create').html(data.view);
        $('body>.content-preloader').fadeOut('slow');
      }
    });
  }

  function search_tournament(data) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: base_url('/search_tournament'),
      type: 'POST',
      dataType: 'json',
      data: data,
      beforeSend: function () {
        // $('body>.content-preloader').fadeIn('slow');
      //   Swal.fire({
      //     title: 'Please Wait !',
      //     html: 'data uploading',// add html attribute if you want or remove
      //     allowOutsideClick: false,
      //     onBeforeOpen: () => {
      //         Swal.showLoading()
      //     },
      // });

      Swal.fire({
        title: 'Please Wait !',
          allowOutsideClick: false,
   });
   Swal.showLoading();
      },
      success: function (response) {
        // console.log("response",response);
        // console.log("response2",response.view);

        // var table = $('#dataTable-report');
        if(!response.view){
          Swal.fire({
            icon: 'info',
            title: 'Alert',
            text: 'No records found for this search.',
          })
        }else{
          $('.tbl-result').html(response.view);
          swal.close();
        }
        // $('.player-create').html(data.view);
        $('body>.content-preloader').fadeOut('slow');
      }
    });
  }

})