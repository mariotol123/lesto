# Guida Footer Dinamico - WordPress Theme Lesto

## 📋 Panoramica del Progetto

Questo documento descrive l'implementazione di un **footer completamente dinamico** per il tema WordPress `lesto-theme`, utilizzando **Advanced Custom Fields (ACF)** per gestire tutti i contenuti del footer tramite interfaccia amministrativa.

## 🎯 Obiettivo

Trasformare il footer statico in un sistema dinamico gestibile da WordPress Admin, eliminando la necessità di modificare codice per aggiornare:
- Menu di navigazione footer
- Link social media  
- Informazioni di contatto
- Indirizzi e collegamenti

## 🏗️ Architettura della Soluzione

### Struttura ACF Implementata

```
📁 Footer Settings (Options Page)
├── 📁 navigation_menu (Gruppo)
│   └── 🔄 navigation_campi (Ripetitore)
│       └── 📝 navigation_text (Campo Testo)
│
├── 📁 social_menu (Gruppo)
│   └── 🔄 social_campi (Ripetitore)
│       └── 📝 social_text (Campo Testo)
│
└── 📁 contatti (Gruppo)
    └── 🔄 contatti_campi (Ripetitore)
        ├── 📝 contatti_text (Campo Testo)
        └── 📝 contatti_link (Campo Testo)
```

## 📁 File Modificati

### 1. `/functions.php`
**Funzioni aggiunte:**

#### `lesto_create_footer_settings_page()`
- Crea la pagina delle opzioni "Footer Settings" in WordPress Admin
- Utilizza ACF per gestire i campi personalizzati

#### `lesto_get_footer_navigation()`
- Legge i dati di navigazione da ACF
- Genera HTML per i link di navigazione
- Fallback su contenuti statici se ACF non disponibile

#### `lesto_get_footer_social()`
- Gestisce i link social media
- Legge da `social_menu → social_campi → social_text`
- Supporta fallback su WordPress Customizer

#### `lesto_get_footer_contacts()`
- Gestisce le informazioni di contatto
- **Riconoscimento automatico dei tipi di link:**
  - 📧 **Email**: Aggiunge automaticamente `mailto:`
  - 📞 **Telefono**: Aggiunge automaticamente `tel:`
  - 🌐 **URL**: Link diretto cliccabile
  - 🗺️ **Indirizzo**: Crea automaticamente link Google Maps
  - 📝 **Testo**: Visualizza come testo normale

### 2. `/footer.php`
**Sezioni modificate:**

#### Navigazione Footer
```php
<?php
// Prova a mostrare navigazione da ACF prima
if (function_exists('lesto_get_footer_navigation') && lesto_get_footer_navigation()) {
    // Navigazione dinamica mostrata
} else {
    // Mostra navigazione di fallback
}
?>
```

#### Social Media (Desktop + Mobile)
```php
<?php
// Prova a mostrare social da ACF prima
if (function_exists('lesto_get_footer_social') && lesto_get_footer_social()) {
    // Social dinamici mostrati
} else {
    // Mostra social di fallback da Customizer
}
?>
```

#### Contatti
```php
<?php
// Prova a mostrare contatti da ACF prima
if (function_exists('lesto_get_footer_contacts') && lesto_get_footer_contacts()) {
    // Contatti dinamici mostrati
} else {
    // Mostra contatti di fallback da Customizer
}
?>
```

## 🛠️ Setup e Configurazione

### Prerequisiti
- WordPress attivo
- Plugin **Advanced Custom Fields (ACF)** installato e attivato
- Tema `lesto-theme` attivo

### Passi per l'Installazione

1. **Verifica ACF**: Assicurati che ACF sia installato
2. **Codice già implementato**: Le funzioni sono già presenti nel tema
3. **Configura campi ACF**: Segui la struttura descritta sotto

### Configurazione Campi ACF

#### 1. Navigazione Footer
1. Vai in **WordPress Admin → Gruppi di campi**
2. Crea gruppo **"Footer Navigation"**
3. Aggiungi:
   - **Gruppo**: `navigation_menu`
   - **Ripetitore**: `navigation_campi` (dentro il gruppo)
   - **Testo**: `navigation_text` (dentro il ripetitore)
4. **Posizione**: Mostra se **Pagina delle opzioni** = **Footer Settings**

#### 2. Social Media
1. Crea gruppo **"Footer Social"**
2. Aggiungi:
   - **Gruppo**: `social_menu`
   - **Ripetitore**: `social_campi`
   - **Testo**: `social_text`
3. **Posizione**: Pagina delle opzioni = Footer Settings

#### 3. Contatti
1. Crea gruppo **"Footer Contatti"**
2. Aggiungi:
   - **Gruppo**: `contatti`
   - **Ripetitore**: `contatti_campi`
   - **Testo**: `contatti_text`
   - **Testo**: `contatti_link`
3. **Posizione**: Pagina delle opzioni = Footer Settings

## 📝 Come Utilizzare

### Gestione Contenuti
1. Vai in **WordPress Admin → Footer Settings**
2. Compila i campi secondo le tue esigenze:

#### Esempi Navigazione:
```
navigation_text: "Chi siamo"
navigation_text: "Servizi"
navigation_text: "Portfolio"
navigation_text: "Contatti"
```

#### Esempi Social:
```
social_text: "Facebook"
social_text: "Instagram"
social_text: "LinkedIn"
```

#### Esempi Contatti:
```
contatti_text: "Email:"
contatti_link: "info@example.com"
→ Risultato: Email: info@example.com (cliccabile con mailto:)

contatti_text: "Telefono:"
contatti_link: "+39 02 1234567"
→ Risultato: Telefono: +39 02 1234567 (cliccabile con tel:)

contatti_text: "Sede:"
contatti_link: "Via Roma 123, Milano"
→ Risultato: Sede: Via Roma 123, Milano (cliccabile con Google Maps)

contatti_text: "P.IVA:"
contatti_link: "12345678901"
→ Risultato: P.IVA: 12345678901 (solo testo)
```

## 🎯 Funzionalità Avanzate

### Riconoscimento Automatico Link Contatti
La funzione `lesto_get_footer_contacts()` riconosce automaticamente:

- **📧 Email**: `info@example.com` → `mailto:info@example.com`
- **📞 Telefono**: `+39 02 1234567` → `tel:+390212344567`  
- **🌐 URL**: `https://...` o `/page` → link diretto
- **🗺️ Indirizzo**: Testo con "Via", "Corso", CAP → Google Maps
- **📝 Altri**: P.IVA, codici, ecc. → solo testo

### Sistema di Fallback
Se ACF non è disponibile o i campi sono vuoti:
- **Navigazione**: Nessun fallback (campo vuoto)
- **Social**: Fallback su WordPress Customizer
- **Contatti**: Fallback su WordPress Customizer

## 🔧 Personalizzazioni Future

### Aggiungere Nuovi Campi
Per aggiungere nuovi tipi di contenuto:

1. **Crea nuovo gruppo ACF** con struttura simile
2. **Aggiungi funzione PHP** in `functions.php`:
```php
function lesto_get_footer_NOME() {
    // Logica per leggere campi ACF
    // Generare HTML
}
```
3. **Modifica footer.php** per chiamare la nuova funzione

### Estendere Riconoscimento Link
Per aggiungere nuovi tipi di link in `lesto_get_footer_contacts()`:
```php
} else if (preg_match('/PATTERN/', $link)) {
    // Nuovo tipo di riconoscimento
    echo '<a href="NUOVO_PREFISSO' . $link . '">' . esc_html($link) . '</a>';
```

## 🐛 Debug e Troubleshooting

### Problemi Comuni

1. **Campi non visualizzati**:
   - Verifica che ACF sia attivo
   - Controlla nomi dei campi (case-sensitive)
   - Verifica posizione gruppo campi

2. **Link non cliccabili**:
   - Controlla formato del `contatti_link`
   - Verifica regex di riconoscimento
   - Usa browser inspector per vedere HTML generato

3. **Fallback non funziona**:
   - Verifica impostazioni WordPress Customizer
   - Controlla che le funzioni di fallback siano corrette

### Debug Function
È presente una funzione di debug (commentata) per verificare i dati ACF:
```php
// Decommentare per debug
function lesto_debug_footer_fields() {
    // Mostra struttura dati ACF
}
```

## ✅ Risultati Ottenuti

- ✅ **Footer completamente dinamico**
- ✅ **Gestione tramite WordPress Admin**
- ✅ **Riconoscimento automatico tipi di link**
- ✅ **Sistema di fallback robusto**
- ✅ **Responsive (desktop + mobile)**
- ✅ **Compatibile con Bootstrap**
- ✅ **SEO-friendly con escape HTML**

## 📞 Supporto

Per modifiche o estensioni future, tutti i file sono documentati e la struttura è modulare per facilitare l'aggiunta di nuove funzionalità.

---

**Data implementazione**: Agosto 2025  
**Versione tema**: lesto-theme  
**Plugin richiesti**: Advanced Custom Fields (ACF)
