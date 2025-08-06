# ZenStaging - Search Engine Blocker

## Descrizione

Questo plugin WordPress forza l'opzione "Scoraggia i motori di ricerca" con la massima priorità e mostra un avviso rosso nella dashboard di wp-admin per confermare che il plugin sia attivo.

## Caratteristiche

- **Forza l'opzione "Scoraggia i motori di ricerca"** con priorità massima (PHP_INT_MAX)
- **Impedisce la modifica** dell'opzione tramite l'interfaccia admin
- **Mostra un avviso rosso** prominente nella dashboard admin
- **Sicurezza**: Non riabilita automaticamente i motori di ricerca alla disattivazione

## Installazione

1. Copia la cartella `zenstaging` nella directory `/wp-content/plugins/`
2. Attiva il plugin dal menu "Plugin" in WordPress
3. Il plugin inizierà immediatamente a funzionare

## Come funziona

Il plugin utilizza diversi hook e filtri per garantire che l'opzione rimanga forzata:

- `wp_loaded` con priorità massima per forzare l'opzione
- `option_blog_public` per filtrare sempre il valore a '0'
- `pre_update_option_blog_public` per impedire modifiche tramite admin
- `admin_notices` per mostrare l'avviso

## Avviso di sicurezza

⚠️ **IMPORTANTE**: Quando disattivi il plugin, l'opzione "Scoraggia i motori di ricerca" NON viene automaticamente riabilitata. Questo è intenzionale per motivi di sicurezza. Se desideri permettere l'indicizzazione, devi manualmente modificare l'impostazione in Impostazioni > Lettura.

## File del plugin

- `zenstaging.php` - File principale del plugin
- `README.md` - Questo file di documentazione

## Versione

1.0.0

## Licenza

GPL v2 or later
