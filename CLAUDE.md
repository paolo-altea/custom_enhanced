# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Joomla 5 site module **mod_custom_enhanced** by Altea Software Srl — extends the core Custom module with responsive image support (desktop/mobile variants) and optional content preparation.

**Namespace:** `Jexit\Module\CustomEnhanced`

## Repository Structure

```
├── src/                           # Module source (flat structure)
│   ├── src/Dispatcher/            # PHP classes (namespace path, without Site/)
│   ├── services/                  # DI provider
│   ├── tmpl/                      # Templates
│   ├── forms/                     # Subform definitions
│   ├── language/                  # Translations (en-GB, it-IT, de-DE)
│   └── mod_custom_enhanced.xml    # Module manifest
├── build/                         # Build scripts
└── dist/                          # Build output (gitignored)
```

**Note:** Joomla modules use `src/Dispatcher/` path (not `src/Site/Dispatcher/`) even though the namespace includes `\Site\Dispatcher`. The ModuleDispatcherFactory handles this mapping automatically.

## Architecture

Single-context module following Joomla 5 conventions:

- **`services/provider.php`** — DI container registration, wires dispatcher factory
- **`src/Dispatcher/Dispatcher.php`** — Module logic, optionally prepares content via `HTMLHelper::content.prepare`
- **`tmpl/default.php`** — Template output, renders `<picture>` elements with responsive images
- **`forms/images.xml`** — Subform definition for repeatable image entries

### Data Flow

1. `provider.php` registers the dispatcher with Joomla's DI container
2. `Dispatcher::getLayoutData()` processes content if "Prepare Content" is enabled
3. `default.php` receives `$module`, `$params` and renders images + content

## Build

```bash
./build/build.sh    # Creates dist/mod_custom_enhanced-{VERSION}.zip
```

## Development

Install or symlink `src/` contents into your Joomla `modules/mod_custom_enhanced/` directory. Clear Joomla cache after template or language changes.

## Key Conventions

- Language keys: `MOD_CUSTOM_ENHANCED_*` prefix in `language/<locale>/*.ini`
- CSS classes: BEM-style `.mod-custom-enhanced__*`
- PHP: Joomla coding standards, 4-space indentation
- Keep manifest (`mod_custom_enhanced.xml`) in sync with new parameters or files
