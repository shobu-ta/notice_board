-- users（社員・ログインユーザー）
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,　*UNSIGNEDでマイナスの値を入れられないようにする
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'user',  *user一般ユーザー,admin管理者,editor編集者,manager部署責任者などの設定　デフォルトは一般ユーザー
    created DATETIME NOT NULL,
    modified DATETIME NOT NULL,
    UNIQUE KEY uq_users_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;　*ENGINE=InnoDB安全・信頼性を担保　CHARSET=utf8mb4文字化け防止


-- posts（お知らせ本体）
CREATE TABLE posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    published BOOLEAN NOT NULL DEFAULT 1, *デフォルトの1で公開中　0は非公開（下書き・管理者のみ）
    created DATETIME NOT NULL,
    modified DATETIME NOT NULL,
    CONSTRAINT fk_posts_users *制約（ルール）に「fk_posts_users」という名前を付ける
        FOREIGN KEY (user_id) *posts.user_id は、他のテーブルの値を参照する posts.user_id = 勝手な数字 ❌ posts.user_id = users.id のどれか ⭕
        REFERENCES users(id) *参照先は users テーブルの id カラム
        ON DELETE CASCADE *親が消えたら、子も一緒に消す
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- sections（部署・分類）
CREATE TABLE sections (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created DATETIME NOT NULL,
    modified DATETIME NOT NULL,
    UNIQUE KEY uq_sections_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- posts_sections（多対多 中間テーブル）
CREATE TABLE posts_sections (　*posts と sections の「関係」だけを保存するテーブル
    post_id INT UNSIGNED NOT NULL,
    section_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, section_id), *同じ組み合わせを2回登録できない
    CONSTRAINT fk_ps_posts  *命名した理由：エラーが出たとき解読しやすくするため、制約を削除・変更しやすくするため　
                            *命名の意味：fk＝foreign key　ps＝posts_sections　posts＝参照先テーブル
        FOREIGN KEY (post_id)
        REFERENCES posts(id)
        ON DELETE CASCADE, *投稿が消えたら、その投稿に紐づく関係も消す
    CONSTRAINT fk_ps_sections
        FOREIGN KEY (section_id)
        REFERENCES sections(id)
        ON DELETE CASCADE *部署（分類）が消えたら、その部署に属する関係も消す
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
