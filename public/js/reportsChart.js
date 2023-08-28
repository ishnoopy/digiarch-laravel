
$( document ).ready(function() {
  const topics = $("#keywordsChart").data("topics");
  const topicsArray = Object.values(topics);
  const labels = topicsArray.map(topic => topic.keyword);
  const data = topicsArray.map(topic => topic.count);

  new Chart($('#keywordsChart'), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'searched keywords',
        data: data,
        borderWidth: 1,
        fill: false,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
      }]
    },
    options: {
      indexAxis: 'y',
    },
    
  });


  const documents = $("#downloadsChart").data("documents");
  const documentsArray = Object.values(documents);
  const downloadLabels = documentsArray.map(document => document.title);
  const downloadData = documentsArray.map(document => document.download_count);

  console.log(documents)

  new Chart($('#downloadsChart'), {
    type: 'bar',
    data: {
      labels: downloadLabels,
      datasets: [{
        label: 'most downloaded thesis',
        data: downloadData,
        borderWidth: 1,
        fill: false,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
      }]
    },
    options: {
      indexAxis: 'y',
    },
    
  });

  const viewLabels = documentsArray.map(document => document.title);
  const viewData = documentsArray.map(document => document.view_count);

  console.log(documents)

  new Chart($('#viewsChart'), {
    type: 'bar',
    data: {
      labels: viewLabels,
      datasets: [{
        label: 'most viewed thesis',
        data: viewData,
        borderWidth: 1,
        fill: false,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
      }]
    },
    options: {
      indexAxis: 'y',
    },
    
  });

  $("#toggleButton").click(function() {
    $(".chart").toggle();
    $(".table").toggle();

    if ($("#toggleButton").text() == "Show Charts") {
      $("#toggleButton").text("Show Tables");
    }else {
      $("#toggleButton").text("Show Charts");
    }
  })
});