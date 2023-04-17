
const authorDropdown = document.getElementById('author-filter');
authorDropdown.addEventListener('change', (e) => {
  const selectedAuthor = e.target.value;
  const filteredData = searchData.filter((book) => {
    return book.author.toLowerCase() === selectedAuthor.toLowerCase();
  });
  displayData(filteredData);
});


const genreDropdown = document.getElementById('genre-filter');
genreDropdown.addEventListener('change', (e) => {
  const selectedGenre = e.target.value;
  const filteredData = searchData.filter((book) => {
    return book.genre.toLowerCase() === selectedGenre.toLowerCase();
  });
  displayData(filteredData);
});

function populateFilters(data) {
  const authorFilterOptions = [];
  const genreFilterOptions = [];
  
  data.forEach((book) => {
    if (!authorFilterOptions.includes(book.author)) {
      authorFilterOptions.push(book.author);
    }
    if (!genreFilterOptions.includes(book.genre)) {
      genreFilterOptions.push(book.genre);
    }
  });
  
  authorFilterOptions.forEach((author) => {
    const option = document.createElement('option');
    option.value = author;
    option.textContent = author;
    authorDropdown.appendChild(option);
  });
  
  genreFilterOptions.forEach((genre) => {
    const option = document.createElement('option');
    option.value = genre;
    option.textContent = genre;
    genreDropdown.appendChild(option);
  });
}

let searchData = [];

async function fetchData(searchTerm = '') {
  const url = new URL('books.json', window.location.href);
  url.searchParams.set('search', searchTerm);

  try {
    const res = await fetch(url);
    searchData = await res.json();
    displayData(searchData);
    populateFilters(searchData);
  } catch (err) {
    console.error(err);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const searchTerm = urlParams.get('query');
  if (searchTerm) {
    fetchData(searchTerm);
  } else {
    fetchData();
  }
});
