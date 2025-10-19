// users.js
function addUser() {
    const form = document.getElementById('addUserForm');
    const formData = new FormData(form);

    const password = formData.get('password');
    const confirmPassword = formData.get('password_confirmation');

    // Basic validation
    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return;
    }

    if (password.length < 8) {
        alert('Password must be at least 8 characters long!');
        return;
    }

    fetch('/staff', { 
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Staff account created successfully!');
            form.reset();
            const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
            modal.hide();
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
    });
}

function viewUser(id) {
    fetch(`/admin/staff/${id}`)
        .then(response => response.json())
        .then(user => {
            const userDetails = `
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr><td><strong>User ID:</strong></td><td>${user.id}</td></tr>
                            <tr><td><strong>Name:</strong></td><td>${user.first_name} ${user.last_name}</td></tr>
                            <tr><td><strong>Email:</strong></td><td>${user.email}</td></tr>
                            <tr><td><strong>Phone:</strong></td><td>${user.phone_number || '-'}</td></tr>
                            <tr><td><strong>Role:</strong></td><td><span class="badge bg-success">${user.role}</span></td></tr>
                            <tr><td><strong>Status:</strong></td><td><span class="badge bg-success">${user.status}</span></td></tr>
                            <tr><td><strong>Created:</strong></td><td>${user.created_at}</td></tr>
                        </table>
                    </div>
                </div>
            `;
            document.getElementById('userDetails').innerHTML = userDetails;

            const modal = new bootstrap.Modal(document.getElementById('viewUserModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error fetching user:', error);
            alert('Could not fetch user data.');
        });
}