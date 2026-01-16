実際にブラウザに送られるHTML（概念的にほぼそのまま）

<div class="row">
  <aside class="column">
    <div class="side-nav">
      <h4 class="heading">Actions</h4>

      <form method="post" action="/notice_board/users/delete/1" class="side-nav-item">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_csrfToken" value="xxxxxxxx">
        <button type="submit"
          onclick="return confirm('Are you sure you want to delete # 1?');">
          Delete
        </button>
      </form>

      <a href="/notice_board/users" class="side-nav-item">List Users</a>
    </div>
  </aside>

  <div class="column column-80">
    <div class="users form content">

      <form method="post" action="/notice_board/users/edit/1">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_csrfToken" value="xxxxxxxx">

        <fieldset>
          <legend>Edit User</legend>

          <div class="input text">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="admin">
          </div>

          <div class="input password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
          </div>

          <div class="input text">
            <label for="role">Role</label>
            <input type="text" name="role" id="role" value="admin">
          </div>

        </fieldset>

        <button type="submit">Submit</button>
      </form>

    </div>
  </div>
</div>
