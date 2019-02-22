// used to load an ajax modal with a dashobard of  2 liv
$('.open-modal-dashboard').click(function (event) {
    event.preventDefault();
    var widget = $(this).parents('.item-widget');
    var current_dashboard = $(widget).attr('data-code');
    var module = $(this).attr('data-module');
    var title = $(this).find('.pluginName span').text();

    $('#modal-2liv-dashboard > .modal-dialog > .modal-content > .modal-body').load('/dashboard/ajax/index?module=' + module + '&parent=' + current_dashboard, function () {
        $('#modal-2liv-dashboard  .modal-dialog > .modal-content > .modal-header > .modal-title').text(title);
        $('#modal-2liv-dashboard').modal('show');
    })
});