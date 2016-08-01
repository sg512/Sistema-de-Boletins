<h1>User</h1>

<form method="post" action="<?php echo URL;?>user/create">
    <label>Login</label><input type="text" name="login" /><br />
    <label>Password</label><input type="text" name="password" /><br />
    <label>Role</label>
        <select name="role">
            <option value="default">Default</option>
            <option value="admin">Admin</option>
        </select><br />
    <label>&nbsp;</label><input type="submit" />
</form>

<hr />

<table>
<div class="container">
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Permissão</th>
        <th>Opções</th>
      </tr>
    </thead>
    <tbody>
    <?php
        foreach($this->userList as $key => $value) {
            echo'<tr>';
                echo'<td style="width:5%;">&nbsp;&nbsp;&nbsp;'.$value['userid'].'</td>';
                echo'<td style="width:8%">'.$value['login'].'</td>';
                echo'<td style="width:8%">'.$value['role'].'</td>';
                echo'<td style="width:40%"><a href="'.URL.'user/edit/'.$value['userid'].'">Edit</a>  <a href="'.URL.'user/delete/'.$value['userid'].'">Delete</a></td>';
            echo'</tr>';
        }
    ?>
    </tbody>
  </table>
</div>
</table>