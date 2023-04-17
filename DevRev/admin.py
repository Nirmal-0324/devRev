import os
import json
from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)
@app.route('/')
def index():
    return app.send_static_file('admin.html')

@app.route('/api/addBook', methods=['POST']) # enable CORS for this route only

def add_book():
    book = request.get_json()

    # Load existing books
    if os.path.exists('books.json'):
        with open('books.json', 'r') as f:
            books = json.load(f)
    else:
        books = []

    # Add new book
    books.append(book)

    # Save to file
    with open('books.json', 'w') as f:
        json.dump(books, f)

    return {'success': True}

if __name__ == '__main__':
    app.run(port=5000, debug=True)
