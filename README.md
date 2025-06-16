# Contao News API Bundle

Dieses Bundle stellt eine einfache API bereit, mit der automatisiert News-Beiträge in Contao erstellt werden können – z. B. über Tools wie [n8n](https://n8n.io/).

## Features

- Erstellt News über einen REST-Endpunkt
- Konfigurierbar im Contao-Backend (`Einstellungen`)
- Optional: sofortige Veröffentlichung
- Auswahl des Ziel-Newsarchivs

## Installation

```bash
composer require intermediaio/contao-news-api
```

Falls Composer das Repository nicht automatisch findet:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/intrio/contao-news-api"
    }
  ]
}
```

## Konfiguration

Im Contao-Backend unter **System > Einstellungen**:

- **News-Archiv (API)**: Ziel-Archiv für automatisch erstellte Beiträge
- **API‑Beiträge sofort veröffentlichen**: aktiviert die sofortige Veröffentlichung neuer Einträge

## API-Endpunkt

```http
POST /api/news
```

### Beispiel JSON-Body:

```json
{
  "title": "Beispielartikel",
  "teaser": "Kurzer Teasertext",
  "text": "<p>Volltext mit HTML</p>",
  "author": "Redaktion",
  "date": "2025-06-15 13:00:00"
}
```

Authentifizierung & Auth-Mechanismus können je nach Bedarf ergänzt werden.

## Lizenz

MIT License
