const buttons = document.querySelectorAll('.admin-dashboard__button');
const contentContainer = document.querySelector('.admin-dashboard__content-container');

buttons.forEach(button => {
  button.addEventListener('click', async () => {
    contentContainer.classList.toggle('admin-dashboard__content-container--expanded');
    const page = button.dataset.page;
    const response = await fetch(`${page}`);
    const html = await response.text();
    contentContainer.innerHTML = html;
  });
});
