<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h1>Users List</h1>
    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Users will be loaded here via AJAX -->
        </tbody>
    </table>

    <!-- Update User Modal -->
    <div id="updateModal" style="display:none;">
        <h2>Update User</h2>
        <form id="updateForm">
            <input type="hidden" id="userId">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Update</button>
        </form>
    </div>

    <script>
        // Load users dynamically using AJAX
        function loadUsers() {
            $.ajax({
                url: 'getUsers.php', // This PHP file will return the users data as JSON
                method: 'GET',
                success: function(response) {
                    const data = JSON.parse(response);
                    
                    // Check if response is successful
                    if (data.status === "success") {
                        const users = data.users; // Extract users from response
                        const tableBody = $('#userTable tbody');
                        tableBody.empty(); // Clear existing data
                        
                        // Check if users exist
                        if (users.length > 0) {
                            users.forEach(user => {
                                tableBody.append(`
                                    <tr>
                                        <td>${user.id}</td>
                                        <td>${user.username}</td>
                                        <td>${user.email}</td>
                                        <td>
                                            <button class="update-btn" data-id="${user.id}" data-username="${user.username}" data-email="${user.email}">Update</button>
                                            <button class="delete-btn" data-id="${user.id}">Delete</button>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            tableBody.append('<tr><td colspan="4">No users found.</td></tr>');
                        }
                    } else {
                        alert('Error: ' + data.message); // Show error message if status is not success
                    }
                },
                error: function() {
                    alert('Error loading users');
                }
            });
        }

        // Handle Update button click
        $(document).on('click', '.update-btn', function() {
            const userId = $(this).data('id');
            const username = $(this).data('username');
            const email = $(this).data('email');

            // Fill the modal with user data
            $('#userId').val(userId);
            $('#username').val(username);
            $('#email').val(email);
            $('#updateModal').show();
        });

        // Handle Delete button click
        $(document).on('click', '.delete-btn', function() {
            const userId = $(this).data('id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: 'deleteUser.php', // This PHP file will handle deletion
                    method: 'POST',
                    data: { id: userId },
                    success: function(response) {
                        if (response === 'success') {
                            loadUsers(); // Reload users after delete
                        } else {
                            alert('Error deleting user');
                        }
                    }
                });
            }
        });

        // Handle Update form submission
        $('#updateForm').on('submit', function(e) {
            e.preventDefault();
            const userId = $('#userId').val();
            const username = $('#username').val();
            const email = $('#email').val();

            $.ajax({
                url: 'updateUser.php', // This PHP file will handle updating the user
                method: 'POST',
                data: { id: userId, username: username, email: email },
                success: function(response) {
                    if (response === 'success') {
                        $('#updateModal').hide();
                        loadUsers(); // Reload users after update
                    } else {
                        alert('Error updating user');
                    }
                }
            });
        });

        // Initial load of users
        loadUsers();
    </script>

</body>
</html>
