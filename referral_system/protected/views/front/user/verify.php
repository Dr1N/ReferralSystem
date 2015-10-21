<?php if ($result && $result == 'success'): ?>
    <h1>Your invitation is verified</h1>
    <p class="alert alert-success">
        You have been added as a member of <?php echo $organization->name; ?>.<br />
        Thanks for your registration.
    </p>
<?php else: ?>
    <h1>Verification error</h1>
    <p class="alert alert-danger">
        The requested page does not exist
    </p>
<?php endif; ?>