import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function() {
                // Initialize DataTable
                let table = $('#leadsTable').DataTable({
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    responsive: true
                });

                $('lead-checkbox').on()

                // Select All Checkbox
                $('#selectAll').on('click', function() {
                    $('.lead-checkbox').prop('checked', this.checked);
                });

                //Delete selected leads
                $('#bulkDeleteBtn').on('click', function () {
                    let ids = getSelected('.lead-checkbox:checked');
                    if (!ids.length) return showAlert('Please select at least one lead.', 'bg-yellow-500');
                    if (confirm('Delete selected leads?')) sendRequest('delete', ids,"leads/bulk-delete","POST");
                });

                // Open bulk update modal
                $('#bulkUpdateBtn').on('click', function() {
                    const selected = $('.lead-checkbox:checked');
                    if (!selected.length) return showAlert('Please select at least one lead.', 'bg-yellow-500');
                    $('#bulkUpdateModal').removeClass('hidden');
                });

                // Close modal
                $('#cancelBulkUpdate').on('click', function() {
                    $('#bulkUpdateModal').addClass('hidden');
                });

                $('#confirmBulkUpdate').on('click', function() {
                    const status = $('#bulkStatus').val();
                    if (!status) return showAlert('Please select a status.', 'bg-yellow-500');

                    const ids = $('.lead-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();

                    // Pass status as extra data
                    $.ajax({
                        url: "/leads/bulk-update",
                        method: "POST",
                        data: {
                            ids: ids,
                            status: status,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            showAlert(res.message, 'bg-green-600');
                            setTimeout(() => location.reload(), 500);
                        },
                        error: function(res) {
                            showAlert(res.responseJSON?.message || 'Something went wrong!', 'bg-red-600');
                        }
                    });
                });





                let opportunitiesTable = $('#opportunitiesTable').DataTable({
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    responsive: true
                });

                // Select All Checkbox
                $('#selectAllOpportunities').on('click', function() {
                    $('.opportunity-checkbox').prop('checked', this.checked);
                });

                 let contactsTable = $('#contactsTable').DataTable({
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    responsive: true
                });

                // Select All Checkbox
                $('#selectAllContacts').on('click', function() {
                    $('.contact-checkbox').prop('checked', this.checked);
                });

                 let userTable = $('#usersTable').DataTable({
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    responsive: true
                });

                // Select All Checkbox
                $('#selectAllUsers').on('click', function() {
                    $('.user-checkbox').prop('checked', this.checked);
                });

                //Globals Functions
                 function getSelected(select) {
                    return $(select).map(function () {
                        return $(this).val();
                    }).get();
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

              function sendRequest(action, ids, url, method) {
                const baseUrl = $('meta[name="base-url"]').attr('content'); // if using meta tag for base URL

                $.ajax({
                    url: `${baseUrl}/${url}`,
                    method: method,
                    data: {
                        action: action,
                        ids: ids
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        showAlert(res.message, 'bg-green-600');
                        // Reload the page after successful action
                        setTimeout(() => {
                            location.reload();
                        }, 300); // optional small delay to show alert
                    },
                    error: function () {
                        showAlert('Something went wrong!', 'bg-red-600');
                    }
                });
            }




            });



function showAlert(message, bg = 'bg-green-600') {
    // Create a div for the alert
    const alert = $('<div>')
        .addClass(`fixed bottom-5 right-5 text-white px-4 py-2 rounded shadow-lg ${bg}`)
        .text(message);

    // Add it to the body
    $('body').append(alert);

    // Remove it after 3 seconds
    setTimeout(() => {
        alert.fadeOut(400, () => alert.remove());
    }, 3000);
}
   
       
