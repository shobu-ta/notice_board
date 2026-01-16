実際にブラウザに送られるHTML（かなり忠実）

<div class="row">
  <aside class="column">
    <div class="side-nav">
      <h4 class="heading">Actions</h4>
      <a href="/notice_board/users" class="side-nav-item">List Users</a>
    </div>
  </aside>

  <div class="column column-80">
    <div class="users form content">

      <form method="post" action="/notice_board/users/add">
        <input type="hidden" name="_csrfToken" value="xxxxxxxx">

        <fieldset>
          <legend>Add User</legend>

          <div class="input text">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
          </div>

          <div class="input password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
          </div>

          <div class="input text">
            <label for="role">Role</label>
            <input type="text" name="role" id="role">
          </div>

        </fieldset>

        <button type="submit">Submit</button>
      </form>

    </div>
  </div>
</div>
