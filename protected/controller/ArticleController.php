<?php

class ArticleController extends DooController {
  
  public function createArticle(){
//    $data = 'ok324234234234234';
    print_r($_POST['article_name']); exit;
    
    $this->toJSON($_POST['article_name']);
//    print_r($data); exit;

  }
}

?>
