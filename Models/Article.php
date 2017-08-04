<?php
include_once '../Config/db.php';

class Article
{
 private $db;
 private $id;
 private $content;
 private $title;
 private $creation_date;
 private $edition_date;
 private $author_id;

 public function __construct(Database $db) {
   $this->db = $db;
 }

 protected function setAttributes($queryResult) {
   $article = new Article($this->db);
   $article->setId($queryResult['id']);
   $article->setContent($queryResult['content']);
   $article->setTitle($queryResult['title']);
   $article->setAuthor_id($queryResult['author_id']);
   $article->setCreationdate($queryResult['creation_date']);
   $article->setEditionDate($queryResult['edition_date']);
   return $article;
 }

 public function getArticleById($id)
 {

   $res = $this->db->readOneWithId($id, 'articles', ['*']);
   $article = $this->setAttributes($res);
   return $article;
 }

 public function getArticleByTitle($title)
 {

   $res = $this->db->readOneWithTitle($title, 'articles', ['*']);
   $article = $this->setAttributes($res);
   return $article;
 }

 // public function getArticlesByAuthor($author)
 // {
 //
 //   $res = $this->db->readOneWithVariable('author_id', $author, 'articles', ['*']);
 //   $article = $this->setAttributes($res);
 //   return $articles;
 // }

 public function createArticle($title, $content, $author) {
     $fields = ['content' => $content, 'title' => $title, 'author_id' => $author];
     $res = $this->db->create('articles', $fields);
     $this->user = $this->setAttributes($res);
 }

 public function updateArticle($id, $fields)
 {
   $this->db->update($id, 'articles', $fields);
 }

 public function deleteArticle($id)
 {
   $this->db->delete($id, 'articles');
 }

 public function listByDescDate() {
   $articles = $this->db->readAll('articles', ['*'], 10, 'desc');
   return $articles;
 }

 //GETTERS
 public function getId() {
   return $this->id;
 }

 public function getContent() {
   return $this->content;
 }

 public function getTitle() {
   return $this->title;
 }

 public function getCreationDate() {
   return $this->creation_date;
 }

 public function getEditionDate() {
   return $this->edition_date;
 }

 public function getAuthor_id() {
   return $this->author;
 }

 //SETTERS
 public function setId($id)
 {
   $this->id = $id;
 }

 public function setContent($content)
 {
   $this->content = $content;
 }

 public function setTitle($title)
 {
   $this->title = $title;
 }

 public function setCreationDate($creation_date)
 {
   $this->creation_date = $creation_date;
 }

 public function setEditionDate($edition_date)
 {
   $this->edition_date = $edition_date;
 }

 public function setAuthor_id($author)
 {
   $this->author = $author;
 }

 public function setTag() {
  $res = $this->db->readOneWithEmail($creation_date, 'article"', ['*']);
  $article = "SELECT * FROM article";
  $tag = array($article, ['*']);
}
}
?>
