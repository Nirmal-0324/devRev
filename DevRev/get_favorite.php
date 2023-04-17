<?php
if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $favorites = [];
  if (($handle = fopen("users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if ($data[0] == $user_id) {
        if (isset($data[1])) {
          $favorites = explode(',', $data[1]);
        }
        break;
      }
    }
    fclose($handle);
  }

  $books = json_decode(file_get_contents('books.json'), true);
  $result = [];
  foreach ($favorites as $book_title) {
    foreach ($books as $book) {
      if (strtolower($book['title']) == strtolower($book_title)) {
        $result[] = $book;
        break;
      }
    }
  }
  echo json_encode($result);
}
?>
A