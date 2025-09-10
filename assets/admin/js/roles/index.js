'use strict';
$(document).ready(function() {
    var action = ADMINURL + '/roles/getRecords';
    const table = $('#rolesListingTable').DataTable({


         scroller: true,
        serverSide: true,
        responsive: false,
        ajax: {
            url: action,
            type: "GET",
        },
        columns: [
              { 
                data: null, 
                render: function(data, type, row, meta) {
                    return meta.row + 1; 
                },
                searchable: false,
                orderable: false 
            },
            { data: 'name', name: 'name' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
        columnDefs: [{
            "orderable": false,
            "targets": [0, 1, 2]
        }],
        "lengthMenu": [
            [10, 20, 50, 100],
            [10, 20, 50, 100]
        ],
        "aaSorting": [
            [0, 'DESC']
        ],
    });
    $('#rolesListingTable td, #rolesListingTable th').css('white-space', 'initial');
    table.on("draw.dt", function(e) {
        setCustomPagingSigns.call($(this));
    }).each(function() {
        setCustomPagingSigns.call($(this));
    });
    function setCustomPagingSigns() {
        var wrapper = this.parent();
        // set global class
        wrapper.find('.dataTables_info').addClass('card-subtitle pb-0');
        // entries info class
        wrapper.find('tbody tr').addClass('inner-td');       
    }
});

function deleteCollection(element) {
    var $this = $(element);
    var action = $this.attr('data-href');
    if (action != '') 
    {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this record?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            confirmButtonClass: "btn-danger",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) 
            {
                axios.delete(action)
                .then(function(response) {
                    if (response.data.status === 'success') {
                        Swal.fire("Deleted!",response.data.msg,"success") 
                        $('#rolesListingTable').DataTable().ajax.reload();
                    }
                    if (response.data.status === 'error') {
                        Swal.fire("Cancelled",response.data.msg,"error")
                    }
                })
                .catch(function(error) {
                    // swal("Error",error.response.data.msg,'error');
                });
                
            } else if (result.dismiss === "cancel") {
                Swal.fire("Cancelled",response.data.msg,"error")
            }
        });
    }
}



