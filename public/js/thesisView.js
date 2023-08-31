$(document).ready(function() {
  $('.download_btn').click(function(event) {
    
    var targetId = $(this).data('target-id'); // Access the data attribute
    
    // Use the targetId in your AJAX request or other logic
    console.log(targetId);
    
    // Perform your AJAX request here
    $.ajax({
      url: '/documents/download/' + targetId, // Update the URL with the targetId
      type: 'GET',
      // Other AJAX settings
    });
  });
  
});
