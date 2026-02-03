# Custom Enhanced

Joomla 5 site module that extends the core Custom module with responsive image support and optional content preparation.

Developed by [Altea Software Srl](https://www.altea.it).

## Features

- WYSIWYG editor for custom content
- Repeatable images with desktop/mobile variants (responsive `<picture>` output)
- Alt text for each image (accessibility)
- Optional content preparation (process plugins like loadmodule, shortcodes, etc.)
- Multi-language support (English, German, Italian)

## Requirements

- Joomla 5.x
- PHP 8.1+

## Installation

1. Download or build `mod_custom_enhanced-1.0.0.zip`
2. In Joomla admin, go to **System > Install > Extensions**
3. Upload and install the ZIP package

## Usage

1. Create a new module of type **Custom Enhanced**
2. Add your content in the WYSIWYG editor
3. Configure module options:
   - **Prepare Content**: enable to process plugins in module content
   - **Images**: add one or more images, each with optional mobile variant and alt text

### Output

The module generates semantic HTML with responsive images:

```html
<div id="mod-custom-enhanced-{id}" class="mod-custom-enhanced custom">
    <div class="mod-custom-enhanced__media">
        <picture class="mod-custom-enhanced__picture">
            <source media="(max-width: 768px)" srcset="mobile.jpg">
            <img src="desktop.jpg" alt="..." width="1200" height="800" loading="lazy">
        </picture>
    </div>
    <div class="mod-custom-enhanced__content">
        <!-- WYSIWYG content -->
    </div>
</div>
```

## Project Structure

```
custom_enhanced/
├── build/                      # Build script
├── src/                        # Module source (flat structure)
│   ├── services/               # DI provider
│   ├── src/Dispatcher/         # Module logic
│   ├── tmpl/                   # Templates
│   ├── forms/                  # Subform definitions
│   ├── language/               # Translations (en-GB, it-IT, de-DE)
│   └── mod_custom_enhanced.xml # Module manifest
└── dist/                       # Build output (gitignored)
```

## Build

Run `./build/build.sh` to create the installable ZIP in `dist/`.

## License

GNU General Public License v2 or later — see [LICENSE.txt](https://www.gnu.org/licenses/gpl-2.0.html).
