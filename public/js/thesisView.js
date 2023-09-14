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
  
  // Get the PDF file URL from the data attribute
var pdfFileUrl = document.getElementById('pdf-viewer').getAttribute('data-file-url');

// Initialize PDF.js and render all pages of the PDF
pdfjsLib.getDocument(pdfFileUrl).promise.then(function(pdfDoc) {
    var pdfViewer = document.getElementById('pdf-viewer');

    for (var pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
        pdfDoc.getPage(pageNum).then(function(page) {
            var viewport = page.getViewport({ scale: 1.5 });
            
            // Create a canvas with dimensions matching the viewport
            var canvas = document.createElement('canvas');
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            var context = canvas.getContext('2d');

            var renderContext = {
                canvasContext: context,
                viewport: viewport,
            };

            page.render(renderContext);

            // Create a container for the canvas
            var pageContainer = document.createElement('div');
            pageContainer.className = 'pdf-page-container';
            pageContainer.appendChild(canvas);

            // Append the page container to the PDF viewer
            pdfViewer.appendChild(pageContainer);
        });
    }
});



});
