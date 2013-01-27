<h1><?php echo $title; ?></h1>
<?php echo $this->pagination->create_links(); ?>
<table>
    <thead>
        <tr>
            <th>ID: </th>
            <th>User name: </th>
            <th>Email adress: </th>
            <th>Control: </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($query->result() as $row) { ?>
        <tr>
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->username; ?></td>
            <td><?php echo $row->email_address; ?></td>
            <td class="control_panel">
                <ul>
                    <li>
                        <a href="<?php echo site_url('admin/user/edit_user_form/'. $row->id); ?>" title="Edit"><img src="<?php echo base_url("public/img/edit.png");  ?>" alt="Edit" /></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/user/reset_password_form/'. $row->id); ?>" title="Reset Password"><img src="<?php echo base_url("public/img/unlock.png");  ?>" alt="Edit" /></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/user/delete_user/'. $row->id); ?>" title="Delete"><img src="<?php echo base_url("public/img/delete.png"); ?>" alt="Delete" /></a>
                    </li>
                </ul>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $this->pagination->create_links(); ?>