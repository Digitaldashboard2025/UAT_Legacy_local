
    <?php foreach ($user_details as $user): ?>
        <tr>
            <td class="text-center align-middle">
                <h6><?php echo $user['emp_id']; ?></h6>
            </td>
            <td class="text-center align-middle">
                <h6><?php echo $user['first_name']; ?></h6>
            </td>
            <td class="text-center align-middle">
                <h6><?php echo $user['user_role']; ?></h6>
            </td>
            <td class="text-center align-middle">
                <a class="btn btn-link permissions-button" id="UserEditButton" style="color:#448aff;" data-toggle="modal" data-target="#permissionModal" data-user-name="<?php echo $user['first_name']; ?>" data-emp-id="<?php echo $user['emp_id']; ?>">Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
