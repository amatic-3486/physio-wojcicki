# UI & Frontend Design Guidelines: Physiotherapie Wojcicki

## Technical Specifications

Please find below the technical details regarding the system environment:

- **WordPress Version:** 7.1.4
- **Language:** PHP 8.2+, HTML5, CSS3 / Tailwind CSS, JavaScript (ES6+)
- **Database Management System:** MySQL 8.4
- **Web Server:** Nginx
- **Use Tailwind CSS for styling and layout**
- **Scope:** Modern medical/healthcare landing page conversion from high-fidelity mockup.
- **Mobile-first design approach** !important
- **Responsive design approach** USe Hamburger Menu ...

## 2. Color Palette & Tokens
Apply these primary brand color codes across all UI components:
- **Primary Accent (Terracotta/Warm Rust):** `#C85A32` / `#BD4F28`
    - *Usage:* Primary CTA buttons ("Termin vereinbaren", "Termin anfragen"), active navigation underline, badge highlights.
- **Secondary Accent (Teal/Dark Slate):** `#1E4355` / `#163342`
    - *Usage:* Dark background cards (Footer Contact block), secondary outlined buttons, main body headlines.
- **Background Tones:**
    - **Off-White / Warm Cream:** `#F9F6F0` (Hero overlay card background, feature highlight sections).
    - **Soft Mint / Ice Blue:** `#E8F2F4` (USPs feature bar background).
    - **Light Card Border:** `#E5E7EB` (Subtle container outlines).
- **Text Color:** `#222222` (High-contrast body text), `#555555` (Subheaders & descriptions).

## 3. Typography Rules
- **Headings (Serif Font):** Use a elegant, clean Serif font (e.g., *Playfair Display*, *Cormorant Garamond*, or *Merriweather*).
    - *Primary Headline:* `font-serif`, weight `700` or `600`, line-height `1.15`.
- **Body & Controls (Sans-Serif):** Use a clean sans-serif (e.g., *Inter*, *Plus Jakarta Sans*, or *Roboto*).
    - *Labels & Eyebrows:* Uppercase, `letter-spacing: 0.1em`, font size `0.75rem` - `0.85rem` (`text-xs` / `text-sm`), primary accent color.
- **Content Text** must be manageable in the backend

## 4. Component Patterns & Rules

### Navigation Bar & Header
- Flexbox layout with spaced-between alignment.
- Contact info (Phone + CTA button) aligned to the far right.
- Active link item indicator: 2px terracotta border beneath the active route (`Startseite`).

### Hero Section
- Split-column layout: Text block on the left overlapping a full-height image on the right.
- Include floating badge ("Gesundheit in guten Händen") with custom badge styling (curved badge border with script/handwritten font style).
- Buttons: Dual action layout (Solid Terracotta Primary + Outlined Secondary with phone icon).

### Cards & Grid Layouts
- **Services Grid (`Gezielte Therapie`):** 5-column responsive grid (`grid-cols-1 md:grid-cols-3 lg:grid-cols-5`). Light background containers, circular icon badge, centered text, and round arrow hover buttons.
- **Gallery Grid (`Unsere Praxis`):** 4-column responsive grid with rounded image corners (`border-radius: 8px`), light overlay caption banners anchored at the bottom.
- **USPs Bar (`Ihr Weg zu mehr Lebensqualität`):** Horizontal flex container on soft mint background (`#E8F2F4`), circular icon badges in rust red.

### Footer & Contact Section
- 3-column structured grid:
    1. **Dark Teal Card:** Emergency contact & quick action buttons (`Call`, `Form`).
    2. **Opening Hours Block:** Clean table grid with clear separator lines between day blocks.
    3. **Location Card:** Address block with map CTA button and decorative subtle background watermark.

## 5. Coding Standards & Best Practices
- **Accessibility:** Ensure all color contrast ratios meet WCAG AA standards. Add `aria-label` to icon-only buttons (like circular arrow links).
- **Semantics:** Use HTML5 semantic structure (`<header>`, `<nav>`, `<main>`, `<section>`, `<footer>`).
- **Icons:** Use inline SVGs or SVG icon packages (e.g., Lucide/Heroicons) with consistent stroke widths (`1.5px` - `2px`).
- **Responsive Web Design:** Mobile-first approach. Enforce grid collapse to 1 column on `< 768px` viewports.
