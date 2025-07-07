# BEM-Based CSS Design System

This project uses a BEM (Block Element Modifier) methodology for CSS organization. BEM helps create reusable, maintainable, and scalable CSS.

## Structure

```
src/assets/css/
├── base/
│   ├── reset.css          # CSS reset
│   └── variables.css      # CSS custom properties
├── components/
│   ├── button.css         # Button component
│   ├── form.css           # Form components
│   ├── modal.css          # Modal component
│   ├── table.css          # Table component
│   ├── badge.css          # Badge, alert, spinner components
│   └── navigation.css     # Navigation components
└── main.css               # Main file importing everything
```

## BEM Naming Convention

- **Block**: `.block` - Standalone entity (e.g., `.btn`, `.modal`, `.table`)
- **Element**: `.block__element` - Part of a block (e.g., `.modal__header`, `.table__cell`)
- **Modifier**: `.block--modifier` - Variation of a block (e.g., `.btn--primary`, `.modal--large`)

## Usage Examples

### Buttons

```html
<!-- Basic button -->
<button class="btn">Default Button</button>

<!-- Primary button -->
<button class="btn btn--primary">Primary Button</button>

<!-- Large danger button -->
<button class="btn btn--danger btn--lg">Large Danger Button</button>

<!-- Loading button -->
<button class="btn btn--primary btn--loading">Loading...</button>
```

### Forms

```html
<form class="form">
  <div class="form__group">
    <label class="form__label form__label--required">Email</label>
    <input type="email" class="form__control" required>
    <div class="form__help">Enter your email address</div>
  </div>
  
  <div class="form__group">
    <label class="form__label">Password</label>
    <input type="password" class="form__control form__control--error">
    <div class="form__help form__help--error">Password is required</div>
  </div>
  
  <div class="form__actions">
    <button type="submit" class="btn btn--primary">Submit</button>
    <button type="button" class="btn btn--secondary">Cancel</button>
  </div>
</form>
```

### Tables

```html
<div class="table-container">
  <table class="table table--hover table--striped">
    <thead class="table__header">
      <tr class="table__row">
        <th class="table__cell table__cell--header">Name</th>
        <th class="table__cell table__cell--header">Status</th>
        <th class="table__cell table__cell--header table__cell--actions">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr class="table__row">
        <td class="table__cell">John Doe</td>
        <td class="table__cell">
          <div class="table__status">
            <span class="table__status-dot table__status-dot--success"></span>
            Active
          </div>
        </td>
        <td class="table__cell table__cell--actions">
          <div class="table__actions">
            <button class="table__action table__action--primary">Edit</button>
            <button class="table__action table__action--danger">Delete</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
```

### Modals

```html
<div class="modal modal--open">
  <div class="modal__content modal__content--md">
    <div class="modal__header">
      <h2 class="modal__title">Confirm Action</h2>
      <button class="modal__close">&times;</button>
    </div>
    <div class="modal__body">
      <p>Are you sure you want to delete this item?</p>
    </div>
    <div class="modal__footer">
      <button class="btn btn--secondary">Cancel</button>
      <button class="btn btn--danger">Delete</button>
    </div>
  </div>
</div>
```

### Navigation

```html
<nav class="nav">
  <a href="#" class="nav__brand">Brand</a>
  <div class="nav__menu">
    <div class="nav__item">
      <a href="#" class="nav__link nav__link--active">Home</a>
    </div>
    <div class="nav__item">
      <a href="#" class="nav__link">About</a>
    </div>
    <div class="nav__item">
      <a href="#" class="nav__link">Contact</a>
    </div>
  </div>
</nav>
```

### Badges and Alerts

```html
<!-- Badges -->
<span class="badge badge--primary">New</span>
<span class="badge badge--success badge--pill">Success</span>
<span class="badge badge--warning badge--sm">Warning</span>

<!-- Alerts -->
<div class="alert alert--success">
  <div class="alert__title">Success!</div>
  <div class="alert__content">Your action was completed successfully.</div>
</div>

<div class="alert alert--danger alert--dismissible">
  <div class="alert__title">Error</div>
  <div class="alert__content">Something went wrong. Please try again.</div>
  <button class="alert__close">&times;</button>
</div>
```

## Layout System

### Container

```html
<div class="container">        <!-- Max-width container -->
<div class="container--fluid"> <!-- Full-width container -->
<div class="container--sm">    <!-- Small container -->
```

### Grid System

```html
<div class="container">
  <div class="row">
    <div class="col-6">Half width</div>
    <div class="col-6">Half width</div>
  </div>
  <div class="row">
    <div class="col-4">One third</div>
    <div class="col-4">One third</div>
    <div class="col-4">One third</div>
  </div>
</div>
```

## Utility Classes

### Spacing

```html
<div class="m-3">       <!-- margin: 1rem -->
<div class="mt-2">      <!-- margin-top: 0.5rem -->
<div class="p-4">       <!-- padding: 1.5rem -->
<div class="pb-1">      <!-- padding-bottom: 0.25rem -->
```

### Display

```html
<div class="d-flex">         <!-- display: flex -->
<div class="d-none">         <!-- display: none -->
<div class="d-block">        <!-- display: block -->
<div class="d-md-none">      <!-- display: none on medium screens -->
```

### Flexbox

```html
<div class="d-flex justify-center align-center">
<div class="d-flex justify-between align-start">
<div class="d-flex flex-column">
```

### Typography

```html
<div class="text-center">         <!-- text-align: center -->
<div class="text-primary">        <!-- color: primary -->
<div class="text-lg">             <!-- font-size: large -->
<div class="font-bold">           <!-- font-weight: bold -->
```

## CSS Custom Properties

All colors, spacing, and other design tokens are defined as CSS custom properties:

```css
:root {
  --color-primary: #007bff;
  --color-success: #28a745;
  --spacing-sm: 0.5rem;
  --spacing-base: 1rem;
  --border-radius-base: 0.25rem;
  --transition-fast: 0.15s ease-in-out;
}
```

## Vue.js Integration

In your Vue components, use the BEM classes directly:

```vue
<template>
  <div class="container">
    <h1 class="text-2xl font-bold mb-4">Page Title</h1>
    <button @click="handleClick" class="btn btn--primary">
      Click Me
    </button>
  </div>
</template>

<script>
export default {
  methods: {
    handleClick() {
      // Handle click
    }
  }
}
</script>

<style scoped>
/* Component-specific styles if needed */
.custom-component {
  /* Use BEM methodology for component-specific styles */
}
</style>
```

## Best Practices

1. **Use BEM naming consistently** - Always follow Block__Element--Modifier pattern
2. **Prefer composition over inheritance** - Use multiple classes instead of nested selectors
3. **Keep specificity low** - Avoid nesting and use single classes
4. **Use utility classes for spacing** - Don't create custom margin/padding classes
5. **Leverage CSS custom properties** - Use variables for consistent theming
6. **Mobile-first approach** - Start with mobile styles and add desktop enhancements

## Customization

To customize the design system:

1. **Colors**: Update CSS custom properties in `base/variables.css`
2. **Spacing**: Modify spacing variables in `base/variables.css`
3. **Components**: Add new components in `components/` directory
4. **Utilities**: Add new utility classes in `main.css`

## File Organization

- **Base**: Foundation styles (reset, variables)
- **Components**: Reusable UI components
- **Utilities**: Helper classes for common patterns
- **Main**: Import everything and organize the cascade 