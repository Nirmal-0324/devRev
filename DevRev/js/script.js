const bookContainer = document.getElementById('book-container');
bookContainer.classList.add('fade-in');
const searchForm = document.getElementById('search-form');
const searchBar = document.getElementById('search-bar');
const searchBtn = document.getElementById('search-btn');
const filterBtn = document.getElementById('filter-btn');
document.addEventListener('DOMContentLoaded', () => {
	const urlParams = new URLSearchParams(window.location.search);
	const searchTerm = urlParams.get('query');
	if (searchTerm) {
	  fetchData(searchTerm);
	}
  });

  searchForm.addEventListener('submit', (e) => {
	e.preventDefault();
	const searchTerm = searchBar.value;
	fetchData(searchTerm);
});


async function fetchData(searchTerm = '') {
    searchTerm = searchTerm || '';
    const url = new URL('books.json', window.location.href);
    url.searchParams.set('search', searchTerm);
    try {
        const res = await fetch(url);
        const data = await res.json();
        const filteredData = data.filter((book) => {
            return book.title.toLowerCase().includes(searchTerm.toLowerCase());
        });
        displayData(filteredData);
    } catch (err) {
        console.error(err);
    }
}

function displayData(data) {
    bookContainer.innerHTML = '';
    if (data.length === 0) {
        const message = document.createElement('p');
        message.textContent = 'No results found.';
        bookContainer.appendChild(message);
        return;
    }
    data.forEach((book) => {
        const bookCard = document.createElement('div');
        bookCard.classList.add('book-card');

        const bookImg = document.createElement('img');
        bookImg.src = `${book.image}`;
        bookCard.appendChild(bookImg);

        const bookTitle = document.createElement('h2');
        bookTitle.textContent = book.title;
        bookCard.appendChild(bookTitle);

        const bookAuthor = document.createElement('p');
        bookAuthor.textContent = `By ${book.author}`;
        bookCard.appendChild(bookAuthor);

        const bookDesc = document.createElement('p');
        bookDesc.textContent = book.description;
        bookCard.appendChild(bookDesc);

        bookCard.addEventListener('click', () => {
            window.open(`books/${book.pdf}.pdf`, '_blank');
        });

        bookContainer.appendChild(bookCard);
    });
}

