<?php
// Config
$searchDir = __DIR__; // Path to the directory to search (default is the current directory)
$extensions = ['txt', 'php', 'html', 'css', 'js']; // File extensions to search for

// Form processing
if (!empty($_POST['query'])) {
    $query = $_POST['query'];
    $results = searchFiles($searchDir, $query, $extensions);
} else {
    $query = '';
    $results = [];
}

// Search function
function searchFiles($directory, $query, $extensions) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
    $results = [];

    foreach ($iterator as $file) {
        if ($file->isFile() && in_array(pathinfo($file, PATHINFO_EXTENSION), $extensions)) {
            $content = file_get_contents($file->getPathname());
            if (stripos($content, $query) !== false) {
                $results[] = $file->getPathname();
            }
        }
    }

    return $results;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Search</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; }
        input[type="text"] { width: 300px; padding: 5px; }
        button { padding: 5px 10px; }
        ul { list-style-type: none; padding: 0; }
        li { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>File Search</h1>
    <form method="POST">
        <label for="query">Search Term:</label>
        <input type="text" name="query" id="query" value="<?= htmlspecialchars($query) ?>" required>
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($results)): ?>
        <h2>Results:</h2>
        <ul>
            <?php foreach ($results as $file): ?>
                <li><?= htmlspecialchars($file) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No results found for "<?= htmlspecialchars($query) ?>"</p>
    <?php endif; ?>
</body>
</html>
