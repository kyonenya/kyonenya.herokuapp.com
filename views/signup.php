<?php
// setLayoutVarはどこのthisだよ（怒）
// View.phpだったわ
$this->setLayoutVar('title', 'アカウント登録'); 
?>
<h2>アカウント登録</h2>
<form method="post" action="<?= $base_url ?>?l=/account/register">
  <!-- escapeはどこのthisだよ（怒） -->
  <input type="hidden" name="_token" value="<?= $this->escape($_token); ?>"/>
  <table>
    <tbody>
      <tr>
        <th>ユーザーID</th>
        <td><input type="text" name="user_name" /></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="password" name="password" /></td>
      </tr>
    </tbody>
  </table>
  <p><input type="submit" value="登録" /></p>
</form>