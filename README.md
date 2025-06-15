# Contao News API (intermedia.io)

API‑Endpunkt `/api/news` zur automatisierten Erstellung von News‑Beiträgen via n8n oder Zapier.

## Installation

```bash
composer config repositories.contao-news-api vcs https://github.com/intermediaio/contao-news-api
composer require intermediaio/contao-news-api
```

## Konfiguration

Im Contao-Backend unter **System > Einstellungen**:

- News-Archiv für API auswählen
- Optional: „API‑Beiträge sofort veröffentlichen“ aktivieren

## Nutzung

Beispiel mit `curl`:

```bash
curl -X POST https://deine-domain/api/news \
  -H "X-API-KEY: DEIN-GEHEIMER-KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "title":"Beitrag per API",
    "text":"Automatisch erstellt",
    "published": true
  }'
```