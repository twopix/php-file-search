# PHP File Search

A lightweight PHP script to search for specific text inside files on your server. This script recursively scans the specified directory and finds files containing the desired text.

## Features

- Recursive search through directories.
- Supports filtering by file extensions (e.g., `.txt`, `.php`, `.html`).
- Displays search results in a user-friendly format.
- Easy to configure and use.

## Usage

1. Download the script and place it in the directory where you want to perform the search.
2. Open the script in a browser, for example:  
   `https://yourdomain.com/file_search.php`
3. Enter the text you want to search for and click **Search**.
4. View the results with the file paths where the text was found.

## Configuration

You can customize the script by modifying the following variables:

- `$searchDir`: Set the root directory for the search (default is the script's directory).
- `$extensions`: Define the file extensions to include in the search (e.g., `['txt', 'php', 'html']`).

## Example

Search for the term `example` in all `.php` files within the current directory:

```php
$searchDir = __DIR__;
$extensions = ['php'];
