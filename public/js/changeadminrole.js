    function confirmRoleChange(event, userId, currentRole) {
        event.preventDefault(); // Prevent the form submission

        const newRole = currentRole === 'admin' ? 'user' : 'admin';
        const confirmed = confirm(`Are you sure you want to change the role to ${newRole}?`);

        if (confirmed) {
            // Submit the form for the respective user
            document.getElementById(`toggle-role-form-${userId}`).submit();
        } else {
            // Revert the checkbox state if the action is canceled
            event.target.checked = !event.target.checked;
        }
    }
