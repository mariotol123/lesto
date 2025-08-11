<?php
// settori.php
// Pagina per la gestione dei settori

// Includi il file di configurazione di WordPress
require_once(dirname(__FILE__) . '/wp-load.php');

get_header();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Settori</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #21759b; }
        .settore-list { margin-top: 20px; }
        .settore-item { padding: 10px; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>
    <h1>Settori</h1>
    <div class="settore-list">
        <?php
        // Esempio: visualizza i settori come categorie
        $categories = get_categories(array('taxonomy' => 'category'));
        if ($categories) {
            foreach ($categories as $category) {
                echo '<div class="settore-item">' . esc_html($category->name) . '</div>';
            }
        } else {
            echo '<p>Nessun settore trovato.</p>';
        }
        ?>
    </div>
</body>
</html>

<?php
get_footer();
?>
