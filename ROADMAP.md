# AgilaVocca ROADMAP

## 🚀 Geplante Features

### 1. **Import/Export von Lektionen & Büchern**
- **Artisan-Command:**
  ```bash
  php artisan vocab:import --file=vocab.json --format=json
  php artisan vocab:export --book=1 --format=csv
  ```
- **Oberfläche:**
  - Button in der Buch/Lektionen-Ansicht: "Exportieren" / "Importieren".
  - Unterstützte Formate: JSON, CSV, Excel.
- **Akzeptanzkriterien:**
  - [ ] Import/Export für alle unterstützten Formate funktioniert fehlerfrei.
  - [ ] Validierung der Eingabedateien (z. B. JSON-Schema).
  - [ ] Unit- und Feature-Tests für die Logik.

### 2. **Technische Verbesserungen**
- **Code-Qualität:**
  - [ ] SOLID-Prinzipien prüfen (z. B. Dependency Injection in Services).
  - [ ] PHPStan-Analyse einrichten (`ddev composer require --dev phpstan/phpstan`).
  - [ ] Upgrade auf Laravel 11.x durchführen.
- **Dokumentation:**
  - [ ] README.md aktualisieren (Installationsanleitung für DDEV).
  - [ ] API-Dokumentation (Swagger/OpenAPI).
- **Testing:**
  - [ ] Unit- und Feature-Tests für kritische Komponenten (z. B. Services, Import/Export).
  - [ ] Testabdeckung von mindestens 80% für neue Features.

### 3. **Bugfixes & UX**
- [ ] **Performance** optimieren (z. B. Caching für Vokabelabfragen).
- [ ] **Fehlerbehandlung** verbessern (z. B. bei Datenbankfehlern).

## 📅 Priorisierung
| Feature                     | Status      | Verantwortlich |
|-----------------------------|-------------|----------------|
| Import/Export (Artisan)     | ⏳ Geplant   | Lukas          |
| Import/Export (UI)          | ⏳ Geplant   | Lukas          |
| SOLID-Refactoring           | ⏳ Geplant   | Lukas          |
| PHPStan-Integration         | ⏳ Geplant   | Lukas          |
| Laravel 11.x Upgrade        | ⏳ Geplant   | Lukas          |
| Unit- und Feature-Tests     | ⏳ Geplant   | Lukas          |
| Performance-Optimierung     | ⏳ Geplant   | Lukas          |

## 🔍 Analyse-Ergebnisse
- **Aktueller Stand:**
  - Laravel 10.x, PHP 8.2, MySQL.
  - **Stärken:** Saubere MVC-Struktur, gute Testabdeckung für bestehende Features.
  - **Schwächen:** Keine Dependency Injection in Services, fehlende API-Dokumentation, keine Unit-Tests für neue Features.

- **Empfehlungen:**
  1. **Dependency Injection** in `app/Services/` nachrüsten (SOLID-Prinzipien).
  2. **PHPStan** einrichten (`ddev composer require --dev phpstan/phpstan`) und in CI integrieren.
  3. **Upgrade auf Laravel 11.x** durchführen (inkl. Anpassung der Konfiguration und Tests).
  4. **Unit- und Feature-Tests** für kritische Komponenten (z. B. Import/Export, Services) ergänzen.
  5. **Import/Export-Logik** als separates Package (`app/Imports/`, `app/Exports/`) aufbauen und testen.