--
CREATE TABLE tags (
  post_id INTEGER NOT NULL,
  tag VARCHAR(255) NOT NULL
);
--

----
-- phpLiteAdmin database dump (https://www.phpliteadmin.org/)
-- phpLiteAdmin version: 1.9.8.2
-- Exported: 7:25am on August 23, 2020 (JST)
-- database file: ./blog
----
BEGIN TRANSACTION;

----
-- Table structure for tags
----
CREATE TABLE 'tags' ('post_id' INTEGER NOT NULL, 'tag' TEXT NOT NULL);

----
-- Data dump for tags, a total of 19 rows
----
INSERT INTO "tags" ("post_id","tag") VALUES ('1','思考');
INSERT INTO "tags" ("post_id","tag") VALUES ('2','演劇');
INSERT INTO "tags" ("post_id","tag") VALUES ('2','演技');
INSERT INTO "tags" ("post_id","tag") VALUES ('3','思考');
INSERT INTO "tags" ("post_id","tag") VALUES ('4','音楽');
INSERT INTO "tags" ("post_id","tag") VALUES ('5','演劇');
INSERT INTO "tags" ("post_id","tag") VALUES ('5','演技');
INSERT INTO "tags" ("post_id","tag") VALUES ('6','時間');
INSERT INTO "tags" ("post_id","tag") VALUES ('7','演技');
INSERT INTO "tags" ("post_id","tag") VALUES ('8','音楽');
INSERT INTO "tags" ("post_id","tag") VALUES ('8','演技');
INSERT INTO "tags" ("post_id","tag") VALUES ('9','時間');
INSERT INTO "tags" ("post_id","tag") VALUES ('10','思考');
INSERT INTO "tags" ("post_id","tag") VALUES ('11','演劇');
INSERT INTO "tags" ("post_id","tag") VALUES ('11','思考');
INSERT INTO "tags" ("post_id","tag") VALUES ('12','演劇');
INSERT INTO "tags" ("post_id","tag") VALUES ('13','演技');
INSERT INTO "tags" ("post_id","tag") VALUES ('13','演劇');
INSERT INTO "tags" ("post_id","tag") VALUES ('14','音楽');
COMMIT;