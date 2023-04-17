<?php
if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $history = [];
  if (($handle = fopen("users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if ($data[0] == $user_id) {
        if (isset($data[2])) {
          $history = explode(',', $data[2]);
        }
        break;
      }
    }
    fclose($handle);
  }

  $books = json_decode(file_get_contents('books.json'), true);
  $result = [];
  foreach ($history as $book_title) {
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
