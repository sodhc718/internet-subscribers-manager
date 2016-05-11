$(function() {
  $('.datatable-basic').DataTable({
    autoWidth: false,
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
    language: {
        search: '<span>Filter:</span> _INPUT_',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: { 'first': 'First', 'last': 'Last', 'next': '→', 'previous': '←' }
    },
    drawCallback: function () {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
    },
    preDrawCallback: function() {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
    }
  });

  // Add placeholder to the datatable filter option
  $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


  // Enable Select2 select for the length option
  $('.dataTables_length select').select2({
      minimumResultsForSearch: Infinity,
      width: 'auto'
  });
});