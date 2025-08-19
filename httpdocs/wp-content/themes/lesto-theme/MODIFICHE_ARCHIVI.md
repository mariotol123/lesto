# Modifiche agli Archivi dei Custom Post Types

## Problema Iniziale

Con la configurazione originale dei Custom Post Types:

```php
register_post_type('settore', array(
    // ...
    'has_archive' => true,
    'rewrite' => array('slug' => 'settori'),
    // ...
));
```

WordPress generava automaticamente delle **pagine archivio** agli URL:
- `/settori/` - archivio automatico di tutti i settori
- `/servizi/` - archivio automatico di tutti i servizi  
- `/realizzazioni/` - archivio automatico di tutte le realizzazioni

Questo creava dei **conflitti** perché:
- ❌ Non potevamo creare pagine WordPress normali con questi slug
- ❌ Gli archivi automatici erano "rigidi" e poco personalizzabili
- ❌ WordPress dava sempre priorità agli archivi automatici dei CPT

## Soluzione Implementata

### 1. Disattivazione degli Archivi Automatici

Cambiato in tutti e tre i Custom Post Types:

```php
// PRIMA
'has_archive' => true,

// DOPO  
'has_archive' => false,
```

**Risultato:** WordPress non genera più automaticamente le pagine archivio.

### 2. Modifica degli Slug dei Post Singoli

Cambiato gli slug per evitare conflitti:

```php
// PRIMA
'rewrite' => array('slug' => 'settori'),    // Plurale
'rewrite' => array('slug' => 'servizi'),    // Plurale
'rewrite' => array('slug' => 'realizzazioni'), // Plurale

// DOPO
'rewrite' => array('slug' => 'settore'),    // Singolare
'rewrite' => array('slug' => 'servizio'),   // Singolare  
'rewrite' => array('slug' => 'realizzazione'), // Singolare
```

## Struttura URL Risultante

### URL dei Post Singoli
- `/settore/nome-del-settore/` ← singolo settore
- `/servizio/nome-del-servizio/` ← singolo servizio
- `/realizzazione/nome-della-realizzazione/` ← singola realizzazione

### URL delle Pagine Archivio (ora disponibili)
- `/settori/` ← pagina WordPress personalizzata per l'archivio settori
- `/servizi/` ← pagina WordPress personalizzata per l'archivio servizi
- `/realizzazioni/` ← pagina WordPress personalizzata per l'archivio realizzazioni

## Come Implementare le Nuove Pagine Archivio

### Passo 1: Creare le Pagine in WordPress Admin

1. Vai in **Pagine → Aggiungi Nuova**
2. Crea tre pagine:
   - Titolo: "Settori", Slug: `settori`
   - Titolo: "Servizi", Slug: `servizi`  
   - Titolo: "Realizzazioni", Slug: `realizzazioni`

### Passo 2: Assegnare i Template Personalizzati

Per ogni pagina, assegna il template corrispondente:

- Pagina **Settori** → Template `template-settori.php`
- Pagina **Servizi** → Template `template-servizi.php`
- Pagina **Realizzazioni** → Template `template-realizzazioni.php`

### Passo 3: Aggiornare i Permalink

Vai in **Impostazioni → Permalink** e clicca **"Salva modifiche"** per rigenerare le regole di rewrite.

## Vantaggi della Nuova Configurazione

### ✅ Controllo Completo
- Puoi personalizzare completamente il layout delle pagine archivio
- Puoi aggiungere contenuti statici, form di ricerca, filtri personalizzati
- Gestione SEO completa (title, meta description, schema markup)

### ✅ Flessibilità
- I template personalizzati possono includere logica complessa
- Puoi utilizzare ACF (Advanced Custom Fields) per contenuti aggiuntivi
- Integrazione con plugin di cache più efficace

### ✅ URL Logici e Puliti
- `/settori/` per vedere tutti i settori
- `/settore/nome/` per un singolo settore
- Struttura intuitiva per utenti e motori di ricerca

### ✅ Gestione Admin WordPress
- Le pagine archivio sono gestibili dall'admin come pagine normali
- Puoi impostare parent/child relationships
- Integrazione con menu di navigazione standard

## Template Files Esistenti

I seguenti template sono già disponibili nel tema:

```
template-settori.php      ← Per la pagina /settori/
template-servizi.php      ← Per la pagina /servizi/  
template-realizzazioni.php ← Per la pagina /realizzazioni/
```

Questi template contengono già la logica per:
- Query personalizzate dei Custom Post Types
- Layout responsive con Bootstrap
- Integrazione con ACF (Advanced Custom Fields)
- Funzionalità AJAX per filtri dinamici

## File Modificato

**File:** `/wp-content/themes/lesto-theme/functions.php`

**Linee modificate:**
- Linea ~226: `'has_archive' => false` per 'settore'
- Linea ~236: `'has_archive' => false` per 'servizio'  
- Linea ~246: `'has_archive' => false` per 'realizzazione'
- Linea ~227: `'slug' => 'settore'` (era 'settori')
- Linea ~237: `'slug' => 'servizio'` (era 'servizi')
- Linea ~247: `'slug' => 'realizzazione'` (era 'realizzazioni')

## Prossimi Passi

1. **Creare le pagine WordPress** come descritto sopra
2. **Aggiornare i permalink** in WordPress Admin
3. **Testare i nuovi URL** per assicurarsi che funzionino correttamente
4. **Aggiornare i link nei menu** e template per puntare ai nuovi URL
5. **Configurare redirect 301** se necessario per mantenere SEO esistente

## Note Tecniche

- I file `archive-settore.php`, `archive-realizzazione.php` potrebbero non essere più utilizzati automaticamente
- Le funzioni AJAX esistenti nel `functions.php` continueranno a funzionare normalmente
- I Custom Post Types mantengono tutte le altre funzionalità (REST API, Gutenberg, ecc.)
- Le tassonomie personalizzate (`categoria_realizzazione`, `cliente_realizzazione`) restano invariate
