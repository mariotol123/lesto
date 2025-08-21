# Guida alla Creazione dei Custom Post Types per Settori e Servizi

## Panoramica

Nel progetto Lesto abbiamo creato tre Custom Post Types (CPT) principali:
- **Settori** (`settore`)
- **Servizi** (`servizio`) 
- **Realizzazioni** (`realizzazione`)

## 1. Registrazione dei Custom Post Types

### File di Configurazione
I CPT sono registrati nel file `functions.php` del tema, all'interno della funzione `lesto_register_custom_post_types()`.

### Codice di Registrazione

```php
/**
 * Registrazione Custom Post Type Settore, Servizio e Realizzazione
 */
function lesto_register_custom_post_types() {
    // Settore
    register_post_type('settore', array(
        'labels' => array(
            'name' => __('Settori', 'lesto-theme'),
            'singular_name' => __('Settore', 'lesto-theme'),
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'settore'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'menu_icon' => 'dashicons-portfolio',
    ));

    // Servizio
    register_post_type('servizio', array(
        'labels' => array(
            'name' => __('Servizi', 'lesto-theme'),
            'singular_name' => __('Servizio', 'lesto-theme'),
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'servizio'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'menu_icon' => 'dashicons-admin-tools',
    ));

    // Realizzazione (con labels più complete)
    register_post_type('realizzazione', array(
        'labels' => array(
            'name' => __('Realizzazioni', 'lesto-theme'),
            'singular_name' => __('Realizzazione', 'lesto-theme'),
            'add_new' => __('Aggiungi Nuova', 'lesto-theme'),
            'add_new_item' => __('Aggiungi Nuova Realizzazione', 'lesto-theme'),
            'edit_item' => __('Modifica Realizzazione', 'lesto-theme'),
            'new_item' => __('Nuova Realizzazione', 'lesto-theme'),
            'view_item' => __('Visualizza Realizzazione', 'lesto-theme'),
            'search_items' => __('Cerca Realizzazioni', 'lesto-theme'),
            'not_found' => __('Nessuna realizzazione trovata', 'lesto-theme'),
            'not_found_in_trash' => __('Nessuna realizzazione nel cestino', 'lesto-theme'),
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'realizzazione'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'menu_icon' => 'dashicons-hammer',
        'taxonomies' => array('categoria_realizzazione', 'cliente_realizzazione'),
    ));
}
add_action('init', 'lesto_register_custom_post_types');
```

## 2. Caratteristiche Principali dei CPT

### Configurazione Comune
Tutti e tre i CPT condividono queste caratteristiche:

- **`public => true`**: Visibili sia nel frontend che nel backend
- **`has_archive => false`**: Nessun archivio automatico (gestito con pagine personalizzate)
- **`show_in_rest => true`**: Compatibilità con Gutenberg e REST API
- **`show_in_nav_menus => true`**: Possono essere aggiunti ai menu di navigazione
- **`supports`**: Supportano title, editor, thumbnail, excerpt

### URL Structure
- Settore singolo: `/settore/nome-del-settore/`
- Servizio singolo: `/servizio/nome-del-servizio/`
- Realizzazione singola: `/realizzazione/nome-della-realizzazione/`

### Icone Dashboard
- **Settori**: `dashicons-portfolio`
- **Servizi**: `dashicons-admin-tools`
- **Realizzazioni**: `dashicons-hammer`

## 3. Tassonomie per Realizzazioni

Il CPT Realizzazioni utilizza due tassonomie personalizzate:

### Categorie Realizzazioni
```php
register_taxonomy('categoria_realizzazione', 'realizzazione', array(
    'labels' => array(
        'name' => __('Categorie', 'lesto-theme'),
        'singular_name' => __('Categoria', 'lesto-theme'),
        // ... altre labels
    ),
    'hierarchical' => true, // Come le categorie standard
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'categoria-realizzazione'),
));
```

### Clienti Realizzazioni
```php
register_taxonomy('cliente_realizzazione', 'realizzazione', array(
    'labels' => array(
        'name' => __('Clienti', 'lesto-theme'),
        'singular_name' => __('Cliente', 'lesto-theme'),
        // ... altre labels
    ),
    'hierarchical' => false, // Come i tag
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'cliente-realizzazione'),
));
```

## 4. Template Files

### Template per Singoli Post
- `single-settore.php` - Template per singolo settore
- `single-servizio.php` - Template per singolo servizio  
- `single-realizzazione.php` - Template per singola realizzazione

### Template per Pagine Archivio
Invece degli archivi automatici, utilizziamo pagine WordPress personalizzate:
- `template-settori.php` - Per la pagina `/settori/`
- `template-servizi.php` - Per la pagina `/servizi/`
- `template-realizzazioni.php` - Per la pagina `/realizzazioni/`

## 5. Motivo della Scelta `has_archive => false`

Abbiamo disabilitato gli archivi automatici dei CPT per evitare conflitti:

### Problema Originale
Con `has_archive => true`, WordPress generava automaticamente:
- `/settori/` - archivio automatico settori
- `/servizi/` - archivio automatico servizi
- `/realizzazioni/` - archivio automatico realizzazioni

### Soluzione Adottata
- **`has_archive => false`** per tutti i CPT
- Creazione di **pagine WordPress normali** con slug personalizzati
- Uso di **template personalizzati** per maggiore controllo del layout

### Vantaggi
- ✅ Controllo completo del design delle pagine archivio
- ✅ Possibilità di usare page builder o campi personalizzati
- ✅ Migliore SEO management con plugin come Yoast
- ✅ Flessibilità nell'organizzazione dei contenuti

## 6. Supporto per Gutenberg e REST API

Tutti i CPT sono configurati con:
- **`show_in_rest => true`**: Abilita l'editor Gutenberg
- **Compatibilità REST API**: I contenuti sono accessibili via API

## 7. Funzioni di Utilità

### AJAX per recupero CPT
Il tema include una funzione AJAX per recuperare i post dei CPT:

```php
function lesto_get_cpt_posts() {
    // Verifica nonce per sicurezza
    if (!wp_verify_nonce($_POST['nonce'], 'lesto_ajax_nonce')) {
        wp_die('Security check failed');
    }
    
    $post_type = sanitize_text_field($_POST['post_type']);
    
    // Verifica che il post type sia permesso
    if (!in_array($post_type, array('settore', 'servizio', 'realizzazione'))) {
        wp_die('Invalid post type');
    }

    $posts = get_posts(array(
        'post_type' => $post_type,
        'numberposts' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ));

    $response = array();
    foreach ($posts as $post) {
        $response[] = array(
            'id' => $post->ID,
            'title' => $post->post_title,
            'url' => get_permalink($post->ID)
        );
    }

    wp_send_json_success($response);
}
```

## 8. Best Practices Implementate

### Internazionalizzazione
- Uso di `__()` per tutte le stringhe
- Textdomain: `'lesto-theme'`

### Hook WordPress
- Registrazione su `init` hook
- Separazione delle funzioni (CPT e tassonomie)

### Sicurezza
- Sanitizzazione input nelle funzioni AJAX
- Verifica nonce per le chiamate AJAX
- Controllo dei post type permessi

### Performance
- Query ottimizzate per il recupero dei post
- Uso appropriato di `numberposts => -1` solo quando necessario

## 9. File di Riferimento

- **`functions.php`** - Registrazione CPT e tassonomie (righe 224-325)
- **`single-settore.php`** - Template singolo settore
- **`single-servizio.php`** - Template singolo servizio
- **`template-settori.php`** - Template archivio settori
- **`template-servizi.php`** - Template archivio servizi
- **`MODIFICHE_ARCHIVI.md`** - Documentazione modifiche archivi

Questa implementazione fornisce una base solida e flessibile per la gestione dei contenuti di settori e servizi nel sito Lesto.
