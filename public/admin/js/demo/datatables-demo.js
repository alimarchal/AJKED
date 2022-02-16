// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
      "paging": false,
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'print', 'pageLength'
      ],
      responsive: true,
  });


});
