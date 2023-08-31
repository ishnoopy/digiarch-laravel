$(document).ready(function() {
  console.log('thesisForm.js loaded')
  $('#department').change(function() {
    console.log('department changed')
    let departmentId = $(this).val();
    if(departmentId) {
      $.ajax({
        url: '/get-courses/' + departmentId,
        type: 'GET',
        success: function(response) {
          $('#course').empty().append('<option value="">Select Course</option>');
          $.each(response, function(key, value) {
            console.log(response)
            $('#course').append('<option value="'+ value.department_id+'">'+ value.name +'</option>');
          });
        }
      })
    } else {
      $('#course').empty().append('<option value="">Select Course</option>');
    }
  })
})