# Tab System Implementation in Lesto Theme

## Overview
This document describes how to implement a tab system in your WordPress theme using HTML, SCSS, and JavaScript. The example is based on the code used in the `lesto-theme`.

---

## 1. HTML Structure

```html
<section class="lesto-help d-flex flex-column align-items-center justify-content-center">
  <div class="container mt-5">
    <h2>Lesto ti aiuta</h2>
  </div>
  <hr class="footer-divider border-2 opacity-75 w-100">
  <div class="container mt-3 mb-5">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <p class="desktop-p">Lorem ipsum dolor sit amet...</p>
      </div>
      <div class="col-lg-8 col-md">
        <div class="tabcontent fade-content show" data-tab="Tab1">
          <!-- Tab1 content here -->
        </div>
        <div class="tabcontent fade-content" data-tab="Tab2">
          <!-- Tab2 content here -->
        </div>
      </div>
    </div>
  </div>
  <hr class="footer-divider border-2 opacity-75 d-none d-md-block w-100">
  <section class="tabs-container mt-4 button-container">
    <div class="container buttons-container mb-5">
      <div class="tab">
        <button class="tablinks btn btn-custom" data-tab="Tab1" id="btn-franchise">
          <img class="icon" src="/wp-content/themes/lesto-theme/images/Icon.png" alt="icon" />
          <span>Catena</span>
        </button>
        <button class="tablinks btn btn-custom active" data-tab="Tab2" id="btn-locale">
          <img class="icon" src="/wp-content/themes/lesto-theme/images/Icon.png" alt="icon" />
          <span>Nuovo locale</span>
        </button>
      </div>
    </div>
  </section>
</section>
```

---

## 2. SCSS Styles

```scss
.tabcontent {
  display: none;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.4s ease;
  border-top: none;
  position: relative;
}

.tabcontent.show {
  display: block;
  opacity: 1;
  visibility: visible;
}

.tablinks {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0;
  transition: gap 2s ease;
  position: relative;
  overflow: hidden;
}

.tablinks .icon {
  width: 1rem;
  height: 0.5rem;
  display: inline-block;
  opacity: 0;
  max-width: 0;
  transition: opacity 1s ease, max-width 1s ease-in-out;
}

.tablinks:hover {
  gap: 8px;
}

.tablinks.active,
.tablinks:active {
  gap: 8px;
}

.tablinks:hover .icon {
  opacity: 1;
  max-width: 20px;
}

.tablinks.active .icon,
.tablinks:active .icon {
  opacity: 1;
  max-width: 20px;
}
```

---

## 3. JavaScript Logic

```js
function openTab(evt, tabName) {
  // Hide all tab contents
  document.querySelectorAll('.tabcontent').forEach(content => {
    content.classList.remove('show');
  });

  // Remove active state from all buttons
  document.querySelectorAll('.tablinks').forEach(btn => {
    btn.classList.remove('active');
  });

  // Show selected tab content
  document.querySelectorAll(`.tabcontent[data-tab="${tabName}"]`).forEach(content => {
    content.classList.add('show');
  });

  // Set button as active
  evt.currentTarget.classList.add('active');
}

document.addEventListener('DOMContentLoaded', () => {
  const tablinks = document.querySelectorAll('.tablinks');

  // Attach click events
  tablinks.forEach(btn => {
    btn.addEventListener('click', evt => {
      const tabName = btn.getAttribute('data-tab');
      openTab(evt, tabName);
    });
  });

  // Activate first tab by default
  if (tablinks.length > 0) {
    tablinks[0].click();
  }
});
```

---

## 4. Usage Notes
- Each tab button must have a `data-tab` attribute matching the corresponding `.tabcontent[data-tab]`.
- The `.show` class is used to display the active tab content.
- The first tab is activated by default on page load.

---

## 5. Customization
- You can add more tabs by duplicating the button and content blocks, updating the `data-tab` values.
- Style the tabs and content as needed in your SCSS.

---

## 6. Reference
- See `main.scss` for style details.
- See your HTML template for structure.
- See the JavaScript snippet for tab switching logic.
