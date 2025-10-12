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

                // Select All Checkbox
                $('#selectAll').on('click', function() {
                    $('.lead-checkbox').prop('checked', this.checked);
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
            });

function addNote(id) {
    const noteContent = prompt("Enter your note:");
}
       
       
