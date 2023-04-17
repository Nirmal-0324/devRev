document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  const addBookBtn = document.querySelector('#add-book-btn');

  addBookBtn.addEventListener('click', (event) => {
    event.preventDefault();

    const title = document.querySelector('#title').value;
    const author = document.querySelector('#author').value;
    const genre = document.querySelector('#genre').value;
    const image = document.querySelector('#image').value;
    const pdf = document.querySelector('#pdf').value;
    if (title && author && genre && image && pdf) {
    const book = {
      id: Math.floor(Math.random() * 1000000),
      title,
      author,
      genre,
      image,
      pdf
    };

    const response= fetch('http://localhost:5000/api/addBook', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(book)
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error(error));
    if (response) {
      alert('Book added successfully!');
      form.reset();
    } else {
      alert('Error adding book!');
    }
  }
  else {
    alert('Please fill in all fields!');
  }
  });
});
