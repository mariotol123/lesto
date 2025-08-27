# 📚 Documentazione Completa Progetto Lesto Theme

## 🎯 Panoramica del Progetto

Questo documento descrive tutte le personalizzazioni, modifiche e implementazioni realizzate per il sito WordPress **Lesto Group**. Il progetto si basa su un tema personalizzato sviluppato da zero utilizzando il framework Underscores (_s) come base di partenza.

---

## 🏗️ Architettura del Progetto

### Informazioni Generali
- **Nome Progetto**: Lesto Theme
- **Tipo**: Tema WordPress personalizzato
- **Framework Base**: Underscores (_s)
- **Framework CSS**: Bootstrap 5
- **Preprocessore**: SCSS
- **Font**: Roboto (Google Fonts)
- **Plugin Richiesti**: Advanced Custom Fields (ACF), Contact Form 7

---

## 📋 Custom Post Types (CPT)

### 1. **Settori** (`settore`)
- **Slug Singolo**: `/settore/nome-settore/`
- **Archivio**: Disabilitato (gestito con pagina personalizzata)
- **Supports**: title, editor, thumbnail, excerpt
- **Menu Icon**: `dashicons-portfolio`
- **Template**: `single-settore.php`, `template-settori.php`

### 2. **Servizi** (`servizio`)
- **Slug Singolo**: `/servizio/nome-servizio/`
- **Archivio**: Disabilitato (gestito con pagina personalizzata)
- **Supports**: title, editor, thumbnail, excerpt
- **Menu Icon**: `dashicons-admin-tools`
- **Template**: `single-servizio.php`, `template-servizi.php`

### 3. **Realizzazioni** (`realizzazione`)
- **Slug Singolo**: `/realizzazione/nome-realizzazione/`
- **Archivio**: Disabilitato (gestito con pagina personalizzata)
- **Supports**: title, editor, thumbnail, excerpt
- **Menu Icon**: `dashicons-hammer`
- **Template**: `single-realizzazione.php`, `template-realizzazioni.php`
- **Tassonomie**: `categoria_realizzazione`, `cliente_realizzazione`

### ⚙️ Configurazione CPT
```php
// Disabilitazione archivi automatici per controllo completo
'has_archive' => false,

// Slug singolari per evitare conflitti con pagine
'rewrite' => array('slug' => 'settore'), // invece di 'settori'

// Compatibilità REST API e Gutenberg
'show_in_rest' => true,
```

---

## 🏷️ Tassonomie Personalizzate

### 1. **Categorie Realizzazioni** (`categoria_realizzazione`)
- **Tipo**: Gerarchica (come categorie)
- **Associata a**: CPT Realizzazioni
- **Slug**: `categoria-realizzazione`
- **Template**: `taxonomy-categoria_realizzazione.php`

### 2. **Clienti Realizzazioni** (`cliente_realizzazione`)
- **Tipo**: Non gerarchica (come tag)
- **Associata a**: CPT Realizzazioni
- **Slug**: `cliente-realizzazione`
- **Template**: `taxonomy-cliente_realizzazione.php`

---

## 🎨 Sistema di Template Personalizzati

### Template Principali
- **`template-home.php`**: Pagina home con sistema tab e sezioni dinamiche
- **`template-settori.php`**: Archivio settori personalizzato
- **`template-servizi.php`**: Archivio servizi personalizzato
- **`template-realizzazioni.php`**: Archivio realizzazioni con filtri AJAX
- **`template-contatti.php`**: Pagina contatti con form personalizzato

### Template Single
- **`single-settore.php`**: Singolo settore
- **`single-servizio.php`**: Singolo servizio
- **`single-realizzazione.php`**: Singola realizzazione

---

## 🎛️ Advanced Custom Fields (ACF)

### 1. **Options Page Globali**
```php
// Opzioni Sito Generali
acf_add_options_page(array(
    'page_title' => 'Opzioni Sito',
    'menu_title' => 'Opzioni Sito',
    'menu_slug' => 'site-options',
    'capability' => 'edit_posts',
    'redirect' => false,
    'icon_url' => 'dashicons-admin-generic',
    'position' => 30
));

// Footer Settings
acf_add_options_page(array(
    'page_title' => 'Footer Settings',
    'menu_title' => 'Footer',
    'menu_slug' => 'footer-settings',
    'capability' => 'edit_posts',
    'redirect' => false
));
```

### 2. **Campi Homepage**
#### Hero Tabs System
- **`hero_tabs_system`** (Gruppo)
  - **`tab_1`** (Gruppo - Catena/Franchise)
    - `titolo_hero` (Testo)
    - `descrizione_hero` (Textarea)
    - `icona_bottone` (Immagine)
    - `testo_bottone` (Testo)
    - `cards` (Ripetitore)
      - `immagine` (Immagine)
      - `titolo` (Testo)
      - `descrizione` (Textarea)
  - **`tab_2`** (Gruppo - Nuovo Locale)
    - *Stessa struttura di tab_1*
  - `titolo_lesto_help` (Testo)
  - `descrizione_intro` (Textarea)

#### Cooking Room Section
- **`cooking_room`** (Gruppo)
  - `titolo_principale` (Testo)
  - `sottotitolo` (Testo)
  - `descrizione` (Textarea)
  - `testo_bottone` (Testo)
  - `link_bottone` (URL)

#### Loghi Partner
- **`loghi_partner`** (Gruppo)
  - `loghi` (Ripetitore)
    - `logo` (Immagine)

### 3. **Campi Footer Dinamico**
#### Navigation Menu
- **`navigation_menu`** (Gruppo)
  - `navigation_campi` (Ripetitore)
    - `navigation_text` (Testo)
    - `link_url` (URL)

#### Social Menu
- **`social_menu`** (Gruppo)
  - `social_campi` (Ripetitore)
    - `social_text` (Testo)
    - `link_url` (URL)

#### Contatti
- **`contatti`** (Gruppo)
  - `contatti_campi` (Ripetitore)
    - `contatti_text` (Testo)
    - `contatti_link` (Testo)

#### Informazioni Aziendali
- **`informazioni_aziendali`** (Gruppo)
  - `informazioni_aziendali_campi` (Ripetitore)
    - `informazioni_aziendali_text` (Testo)
    - `informazioni_aziendali_link` (Testo)

### 4. **Campi Specifici CPT**
#### Per Settori
- `titolo_accordion` (Testo)
- `riassunto_accordion` (Textarea)

#### Per Realizzazioni
- **`galleria_realizzazioni`** (Ripetitore)
  - `immagine` (Immagine)
  - `titolo` (Testo)

---

## 🎭 Sistema Header e Navigazione

### 1. **Header Menu Walker Personalizzato**
- **File**: `inc/class-header-menu-walker.php`
- **Funzionalità**:
  - Dropdown dinamici per menu con sottovoci
  - Doppio click per navigazione diretta
  - Gestione menu mobile
  - Icone personalizzate per ogni voce
  - Integrazione Bootstrap

### 2. **Menu Positions**
```php
register_nav_menus(array(
    'menu-1' => esc_html__('Primary', 'lesto-theme'),
    'header-menu' => esc_html__('Header Menu', 'lesto-theme'),
    'mobile-menu' => esc_html__('Mobile Menu', 'lesto-theme'),
));
```

### 3. **JavaScript Header**
- **File**: `js/header-menu-walker.js`
- **Funzionalità**:
  - Gestione stati dropdown
  - AJAX per caricamento contenuti dinamici
  - Menu mobile responsive
  - Animazioni CSS integrate

---

## 🦶 Sistema Footer Dinamico

### 1. **Footer Functions**
- **File**: `inc/footer-functions.php`
- **Funzioni Principali**:
  - `lesto_get_footer_navigation()`
  - `lesto_get_footer_social()`
  - `lesto_get_footer_contacts()`
  - `lesto_get_footer_company_info()`

### 2. **Riconoscimento Automatico Link**
La funzione `lesto_render_smart_link()` riconosce automaticamente:
- **📧 Email**: `info@example.com` → `mailto:info@example.com`
- **📞 Telefono**: `+39 02 1234567` → `tel:+390212344567`
- **🌐 URL**: `https://...` → link diretto
- **🗺️ Indirizzo**: Testo geografico → Google Maps

### 3. **Fallback System**
Sistema di fallback robusto:
1. **Prima priorità**: Campi ACF Options Page
2. **Seconda priorità**: Campi ACF da pagina "Footer Settings"
3. **Terza priorità**: WordPress Customizer
4. **Ultima priorità**: Valori di default hardcoded

---

## 🎯 Sistema Tab Dinamico

### 1. **Implementazione HTML**
```html
<div class="tabcontent fade-content show" data-tab="Tab1">
    <!-- Contenuto Tab 1 -->
</div>
<div class="tabcontent fade-content" data-tab="Tab2">
    <!-- Contenuto Tab 2 -->
</div>

<button class="tablinks btn btn-custom active" data-tab="Tab1">
    <img class="icon" src="..." alt="icon" />
    <span>Tab 1</span>
</button>
```

### 2. **Stili SCSS**
```scss
.tabcontent {
    display: none;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.4s ease;
}

.tabcontent.show {
    display: block;
    opacity: 1;
    visibility: visible;
}

.tablinks .icon {
    width: 1rem;
    height: 0.5rem;
    opacity: 0;
    max-width: 0;
    transition: opacity 1s ease, max-width 1s ease-in-out;
}

.tablinks:hover .icon,
.tablinks.active .icon {
    opacity: 1;
    max-width: 20px;
}
```

### 3. **JavaScript Tab Logic**
```javascript
function openTab(evt, tabName) {
    // Nascondi tutti i contenuti
    document.querySelectorAll('.tabcontent').forEach(content => {
        content.classList.remove('show');
    });
    
    // Mostra contenuto selezionato
    document.querySelectorAll(`.tabcontent[data-tab="${tabName}"]`).forEach(content => {
        content.classList.add('show');
    });
    
    // Attiva bottone
    evt.currentTarget.classList.add('active');
}
```

---

## 🎪 Slider e Carousel

### 1. **Splide.js Integration**
- **CDN**: `https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/`
- **File**: `js/slider-multi-row.js`
- **Utilizzo**: Carousel loghi partner in homepage

### 2. **Masonry Layout**
- **CDN**: `https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js`
- **File**: `js/main.js`
- **Utilizzo**: Layout griglia realizzazioni

---

## 🎨 Asset Management

### 1. **CSS/SCSS Structure**
```
css/
├── main.css (CSS compilato principale)
└── (altri file CSS)

(SCSS source files presumibilmente in una cartella separata)
```

### 2. **JavaScript Files**
```
js/
├── bootstrap.bundle.min.js (Bootstrap JS)
├── navigation.js (Navigazione base)
├── header-menu-walker.js (Menu header)
├── main.js (Funzioni principali)
├── slider-multi-row.js (Splide carousel)
├── four-section-persist.js (Persistenza sezioni)
├── contatti.js (Form contatti)
└── menu-dropdown.js (Dropdown legacy)
```

### 3. **Images**
```
images/
├── logo.svg (Logo principale)
├── onde.svg (Icone onde menu)
├── Vector.png (Hamburger menu)
├── Container.png (Bottone chiusura)
└── (altre immagini)
```

### 4. **Enqueue Strategy**
```php
// Google Fonts
wp_enqueue_style('google-fonts-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

// CSS principale con versioning
wp_enqueue_style('lesto-theme-main', get_template_directory_uri() . '/css/main.css', array(), filemtime(get_template_directory() . '/css/main.css'));

// JavaScript con dipendenze
wp_enqueue_script('lesto-main-js', '...', array('masonry-cdn'), null, true);
```

---

## 🔧 Funzionalità AJAX

### 1. **Caricamento CPT Dinamico**
```php
function lesto_get_cpt_posts() {
    // Verifica nonce per sicurezza
    if (!wp_verify_nonce($_POST['nonce'], 'lesto_ajax_nonce')) {
        wp_die('Security check failed');
    }
    
    $post_type = sanitize_text_field($_POST['post_type']);
    
    // Query e return JSON
    wp_send_json_success($response);
}

add_action('wp_ajax_lesto_get_cpt_posts', 'lesto_get_cpt_posts');
add_action('wp_ajax_nopriv_lesto_get_cpt_posts', 'lesto_get_cpt_posts');
```

### 2. **Filtri Realizzazioni**
```php
function lesto_get_realizzazioni_by_taxonomy() {
    // Filtri per categoria_realizzazione e cliente_realizzazione
    // Return JSON con thumbnail, titoli, URL
}
```

### 3. **Localizzazione JavaScript**
```php
wp_localize_script('lesto-theme-header-menu-walker', 'lestoTheme', array(
    'menuCloseImg' => get_template_directory_uri() . '/images/Container.png',
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('lesto_ajax_nonce')
));
```

---

## 🚀 Ottimizzazioni Performance

### 1. **Asset Conditioning**
```php
// JS specifici per template
if (is_page_template('template-contatti.php')) {
    wp_enqueue_script('lesto-form-animation', '...contatti.js');
}
```

### 2. **File Versioning**
```php
// CSS con timestamp per cache busting
filemtime(get_template_directory() . '/css/main.css')
```

### 3. **Gutenberg Disabling**
```php
// Disattiva Gutenberg per performance
add_filter('use_block_editor_for_post', '__return_false', 10);

// Rimuovi CSS Gutenberg dal frontend
wp_dequeue_style('wp-block-library');
```

---

## 📱 Responsive Design

### 1. **Bootstrap 5 Integration**
- Grid system responsivo
- Componenti UI pronti
- Utilities classes

### 2. **Mobile-First Approach**
- Header mobile con hamburger menu
- Footer layout adattivo desktop/mobile
- Tab system responsive

### 3. **Breakpoints Strategy**
```scss
// Mobile first
.elemento {
    // Mobile styles
}

// Desktop
@media (min-width: 768px) {
    .elemento {
        // Desktop styles
    }
}
```

---

## 🔐 Sicurezza Implementata

### 1. **AJAX Security**
```php
// Nonce verification
if (!wp_verify_nonce($_POST['nonce'], 'lesto_ajax_nonce')) {
    wp_die('Security check failed');
}

// Input sanitization
$post_type = sanitize_text_field($_POST['post_type']);

// Whitelist validation
if (!in_array($post_type, array('settore', 'servizio', 'realizzazione'))) {
    wp_die('Invalid post type');
}
```

### 2. **Output Escaping**
```php
// Sempre escape dell'output
echo esc_html($variable);
echo esc_url($url);
echo esc_attr($attribute);
echo wp_kses_post($html_content);
```

### 3. **Direct Access Prevention**
```php
// Prevenzione accesso diretto
if (!defined('ABSPATH')) {
    exit;
}
```

---

## 🌐 SEO e Accessibilità

### 1. **Struttura HTML Semantica**
- Tag header, main, footer, section, article
- Heading hierarchy corretta (h1, h2, h3...)
- Alt text per tutte le immagini

### 2. **WordPress SEO Ready**
```php
// Support per title-tag
add_theme_support('title-tag');

// Feed RSS
add_theme_support('automatic-feed-links');

// Post thumbnails
add_theme_support('post-thumbnails');
```

### 3. **Accessibilità**
- Link con attributi aria corretti
- Focus management per dropdown
- Testi alternativi descrittivi

---

## 📊 Monitoring e Debug

### 1. **Debug Functions**
```php
// Debug ACF fields (commented)
function lesto_debug_footer_fields() {
    if (function_exists('get_field')) {
        $data = get_field('navigation_menu', 'option');
        echo '<pre>'; var_dump($data); echo '</pre>';
    }
}
```

### 2. **Error Handling**
```php
// Fallback robusti per ogni funzione
if (function_exists('lesto_get_footer_navigation') && lesto_get_footer_navigation()) {
    // Success
} else {
    // Fallback
}
```

---

## 🔄 Modifiche agli Archivi

### Problema Risolto
**Prima**: WordPress generava automaticamente:
- `/settori/` - archivio automatico settori
- `/servizi/` - archivio automatico servizi  
- `/realizzazioni/` - archivio automatico realizzazioni

**Soluzione**: 
1. `has_archive => false` per tutti i CPT
2. Slug singolari (`settore` invece di `settori`)
3. Pagine WordPress personalizzate per gli archivi
4. Template personalizzati per controllo completo

### Vantaggi Ottenuti
- ✅ Controllo completo layout archivi
- ✅ Gestione SEO con plugin
- ✅ Contenuti personalizzabili tramite ACF
- ✅ URL logici e puliti

---

## 📋 Plugin e Dipendenze

### Plugin Essenziali
1. **Advanced Custom Fields (ACF)**
   - Gestione campi personalizzati
   - Options pages
   - Repeater fields

2. **Contact Form 7**
   - Form di contatto
   - Integrazione con template contatti

### Plugin Opzionali Raccomandati
- **Yoast SEO**: Ottimizzazione motori di ricerca
- **W3 Total Cache**: Performance caching
- **Wordfence**: Sicurezza

---

## 🛠️ Manutenzione e Aggiornamenti

### File da Backup Prioritari
1. `/wp-content/themes/lesto-theme/` (tema completo)
2. `/wp-content/uploads/` (media files)
3. Database WordPress (settings ACF, contenuti)

### Procedura Aggiornamenti
1. **Backup completo** sito e database
2. **Test in staging** environment
3. **Verifica ACF** fields dopo aggiornamenti
4. **Test funzionalità AJAX** dopo modifiche

### Punti di Attenzione
- **ACF Updates**: Verificare compatibilità campi personalizzati
- **WordPress Core**: Testare compatibilità funzioni tema
- **Plugin Updates**: Verificare integrazione con tema

---

## 📈 Performance Metrics

### Ottimizzazioni Implementate
- ✅ CSS/JS minificati e concatenati
- ✅ Immagini ottimizzate (lazy loading possibile)
- ✅ Asset conditioning per template specifici
- ✅ Cache busting con filemtime()
- ✅ Gutenberg disabilitato per performance

### Raccomandazioni Future
- Implementare lazy loading immagini
- Ottimizzare font loading strategy
- Considerare Critical CSS
- Implementare Service Workers per PWA

---

## 🎯 Conclusioni

Il progetto **Lesto Theme** rappresenta una soluzione WordPress completamente personalizzata che combina:

- **Flessibilità**: Sistema ACF per gestione contenuti dinamici
- **Performance**: Codice ottimizzato e asset management efficiente  
- **Scalabilità**: Architettura modulare facilmente estendibile
- **User Experience**: Design responsive e interazioni fluide
- **Manutenibilità**: Codice documentato e strutturato

### Caratteristiche Distintive
1. **Sistema Tab Dinamico** homepage completamente gestibile
2. **Footer Dinamico** con riconoscimento automatico tipi link
3. **Menu Header Avanzato** con dropdown e doppio click
4. **CPT e Tassonomie** per organizzazione contenuti
5. **Template System** flessibile e personalizzabile
6. **AJAX Integration** per filtri e caricamenti dinamici

Il tema è pronto per espansioni future mantenendo la stabilità e le performance ottenute.

---

**📅 Data Documentazione**: Agosto 2025  
**👨‍💻 Sviluppatore**: Progetto Lesto Theme  
**📝 Versione Tema**: 1.0.0  
**🔧 WordPress Version**: 6.x Compatible
