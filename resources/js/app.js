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

                function sendRequest(action, ids,url,method) {
                    $.ajax({
                        url: "http://localhost:8000/"+url,
                        method: method,
                        data: {
                            _token: "{{ csrf_token() }}",
                            action: action,
                            ids: ids
                        },
                        success: function (res) {
                            showAlert(res.message, 'bg-green-600');
                            ids.forEach(id => $('tr[data-id="' + id + '"]').remove());
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
   
       
