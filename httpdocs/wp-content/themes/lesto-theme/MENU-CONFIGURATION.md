# Configurazione Menu Header - Lesto Theme

## Come configurare il menu dall'admin di WordPress

### 1. Accedere al pannello admin
- Vai su `Aspetto > Menu` nel pannello admin di WordPress

### 2. Creare un nuovo menu
- Clicca su "Crea un nuovo menu"
- Assegna un nome al menu (es. "Header Menu")
- Clicca "Crea menu"

### 3. Aggiungere voci al menu
Puoi aggiungere diversi tipi di voci:

#### A) Pagine personalizzate (Custom Links)
- Clicca su "Link personalizzato" nel pannello sinistro
- URL: inserisci l'URL della pagina (es. `/settori`, `/servizi`)
- Testo del link: inserisci il nome che vuoi visualizzare (es. "Settori", "Servizi")
- Clicca "Aggiungi al menu"

#### B) Pagine esistenti
- Seleziona le pagine dal pannello "Pagine"
- Clicca "Aggiungi al menu"

#### C) Post personalizzati (Settori, Servizi, Realizzazioni)
- Seleziona gli elementi dai pannelli "Settori", "Servizi", "Realizzazioni" 
- Clicca "Aggiungi al menu"

### 4. Creare sottomenu (dropdown)
- Trascina una voce di menu leggermente a destra sotto un'altra voce
- Questo creerà un sottomenu dropdown
- Puoi avere più livelli di sottomenu

### 5. Esempio di struttura consigliata:
```
Header Menu
├── Settori
│   ├── Settore 1
│   ├── Settore 2
│   └── Settore 3
├── Servizi
│   ├── Servizio 1
│   ├── Servizio 2
│   └── Servizio 3
├── Realizzazioni
│   ├── Realizzazione 1
│   ├── Realizzazione 2
│   └── Realizzazione 3
└── Contatti
```

### 6. Assegnare il menu alla posizione
- In fondo alla pagina, nella sezione "Posizioni del tema"
- Seleziona "Header Menu" per la posizione "Header Menu"
- Clicca "Salva menu"

### 7. Menu mobile
Il menu mobile verrà generato automaticamente basandosi sul menu desktop configurato.

## Note tecniche

### Stili mantenuti
- Tutti gli stili CSS esistenti sono stati mantenuti
- I bottoni mantengono lo stesso aspetto visivo
- Le animazioni e transizioni funzionano come prima
- I dropdown mantengono lo stesso comportamento

### Fallback
Se non è configurato nessun menu, il sistema mostrerà i bottoni di default:
- Settori
- Servizi  
- Realizzazioni
- Contatti

### Personalizzazione avanzata
Il walker personalizzato (`Header_Menu_Walker`) può essere modificato in:
`/wp-content/themes/lesto-theme/inc/class-header-menu-walker.php`

### JavaScript
La logica JavaScript è stata aggiornata per funzionare con il sistema di menu di WordPress mantenendo tutte le funzionalità esistenti.

## Vantaggi del nuovo sistema

1. **Gestione dal backend**: Non serve più modificare codice per cambiare i menu
2. **Flessibilità**: Puoi aggiungere, rimuovere, riordinare le voci facilmente
3. **SEO friendly**: I link sono veri link HTML, non JavaScript
4. **Compatibilità**: Funziona con plugin SEO e di cache
5. **Mantenibilità**: Separazione tra contenuto e presentazione
