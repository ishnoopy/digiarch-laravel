$(document).ready(function() {

  $('.course_name').on('blur', function (event) {
    const $form = $(this).closest('.edit-course-form');
    const currentName = $(this).val();
    const defaultName = $(this).data('default-value');

    if (currentName !== defaultName) {
        event.preventDefault(); // Prevent default form submission behavior
        $form.submit();
    }
  });
  
   $('.department_name').on('blur', function (event) {
    const $form = $(this).closest('.edit-department-form');
    const currentName = $(this).val();
    const defaultName = $(this).data('default-value');

    if (currentName !== defaultName) {
        event.preventDefault(); // Prevent default form submission behavior
        $form.submit();
    }
  });
    
})