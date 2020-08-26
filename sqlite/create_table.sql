-- postgres
CREATE TABLE posts (
  id SERIAL UNIQUE PRIMARY KEY,
  title VARCHAR(255),
  body TEXT,
  created_at TIMESTAMP WITH TIME ZONE DEFAULT statement_timestamp(),
  modified_at TIMESTAMP WITH TIME ZONE DEFAULT statement_timestamp()
);


CREATE TABLE posts (
  id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255),
  body TEXT,
  created_at DATETIME DEFAULT current_timestamp,
  modified_at DATETIME DEFAULT current_timestamp ON UPDATE current_timestamp  -- 更新時の現在時刻
);


CREATE TABLE user(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(20) NOT NULL,
    password VARCHAR(40) NOT NULL,
    created_at DATETIME  
    -- KEY句はINDEX句（索引）の代わり
      -- UNIQUE KEY user_name_index(user_name)
    -- こう書いてもいいが、
    -- UNIQUE INDEX user_name_index(user_name)
);
-- 普通は外に書く。
ALTER TABLE user ADD INDEX user_name_index(user_name);

-- SQLite版
CREATE TABLE user(
    -- 間のアンダーバーは無し、AUTOINCREMENT
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_name VARCHAR(20) NOT NULL,
    password VARCHAR(40) NOT NULL,
    created_at DATETIME
);
-- 構文が少し違う。
CREATE INDEX user_name_index ON user(user_name);



CREATE TABLE following(
    user_id INTEGER,
    following_id INTEGER,
    -- 主キーが複数のときは、二つの組み合わせが重複しなければよいという意味。
    -- 複合キーという。
    PRIMARY KEY(user_id, following_id)
);
-- SQLite版：同じ


CREATE TABLE status(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    body VARCHAR(255),
    created_at DATETIME,
    -- INDEX user_id_index(user_id)
);
ALTER TABLE status ADD INDEX user_id_index(user_id);

-- SQLite版
CREATE TABLE status(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    body VARCHAR(255),
    created_at DATETIME
);
CREATE INDEX user_id_index ON status(user_id);

-- 外部キー制約はひとまず諦める。
-- PRAGMA foreign_keys=true;
-- でオンにできるが、SQLiteだとテーブル作成時にしか効かない。
ALTER TABLE following ADD FOREIGN KEY (user_id) REFERENCES user(id);
ALTER TABLE following ADD FOREIGN KEY (following_id) REFERENCES user(id);
ALTER TABLE status ADD FOREIGN KEY (user_id) REFERENCES user(id);