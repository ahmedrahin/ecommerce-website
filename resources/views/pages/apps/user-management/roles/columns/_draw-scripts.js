// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Swal.fire({
            text: 'Are you sure you want to remove this admin from the role?',
            icon: 'warning',
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const adminId = this.getAttribute('data-kt-admin-id');
                const roleName = this.getAttribute('data-kt-role-name');
                
                // Emit both adminId and roleName
                Livewire.emit('remove_from_role', adminId, roleName);
            }
        });
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.emit('update_user', this.getAttribute('data-kt-user-id'));
    });

});

// Listen for 'success' event emitted by Livewire
Livewire.on('info', (message) => {
    // Reload the users-table datatable
    LaravelDataTables['users-table'].ajax.reload();
});
