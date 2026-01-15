このテンプレートが「典型的に生成する実際の HTML」 を、
ユーザーが2人いるケースを想定してそのまま提示します。

<div class="users index content">

  <a href="/notice_board/users/add" class="button float-right">
    New User
  </a>

  <h3>Users</h3>

  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>
            <a href="/notice_board/users?sort=id&direction=asc">Id</a>
          </th>
          <th>
            <a href="/notice_board/users?sort=username&direction=asc">Username</a>
          </th>
          <th>
            <a href="/notice_board/users?sort=role&direction=asc">Role</a>
          </th>
          <th>
            <a href="/notice_board/users?sort=created&direction=asc">Created</a>
          </th>
          <th>
            <a href="/notice_board/users?sort=modified&direction=asc">Modified</a>
          </th>
          <th class="actions">Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>1</td>
          <td>admin</td>
          <td>admin</td>
          <td>2026-01-15 10:00:00</td>
          <td>2026-01-15 10:00:00</td>
          <td class="actions">
            <a href="/notice_board/users/view/1">View</a>
            <a href="/notice_board/users/edit/1">Edit</a>

            <form method="post" action="/notice_board/users/delete/1" style="display:inline">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit"
                onclick="return confirm('Are you sure you want to delete # 1?');">
                Delete
              </button>
            </form>
          </td>
        </tr>

        <tr>
          <td>2</td>
          <td>tanaka</td>
          <td>user</td>
          <td>2026-01-16 09:30:00</td>
          <td>2026-01-16 09:30:00</td>
          <td class="actions">
            <a href="/notice_board/users/view/2">View</a>
            <a href="/notice_board/users/edit/2">Edit</a>

            <form method="post" action="/notice_board/users/delete/2" style="display:inline">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit"
                onclick="return confirm('Are you sure you want to delete # 2?');">
                Delete
              </button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="paginator">
    <ul class="pagination">
      <li><a href="/notice_board/users?page=1">&lt;&lt; first</a></li>
      <li class="disabled"><span>&lt; previous</span></li>
      <li class="active"><span>1</span></li>
      <li><a href="/notice_board/users?page=2">2</a></li>
      <li><a href="/notice_board/users?page=2">next &gt;</a></li>
      <li><a href="/notice_board/users?page=5">last &gt;&gt;</a></li>
    </ul>

    <p>
      Page 1 of 5, showing 2 record(s) out of 10 total
    </p>
  </div>

</div>
