# LOG.md - Issue #5: Application is available in other languages

## 07.03.2026

### **Umgesetzte Akzeptanzkriterien**
- [x] **Sprachdateien angelegt** (`resources/lang/{de,en,fr,es}/messages.php` + `general.php`).
- [x] **Hartcodierte Strings in Blade-Templates ersetzt** (z. B. `navigation.blade.php`, `dashboard.blade.php`).

### **Aktueller Stand**
- [ ] **User-Modell erweitern** (`native_language`-Feld).
- [ ] **Einstellungen-Seite erstellen** (Sprachauswahl).
- [ ] **Tests schreiben** (Nutzer kann Sprache ändern).
- [ ] **Dokumentation ergänzen** (`README.md`).

### **Nächste Schritte**
1. **Migration für `native_language` erstellen** (String-Feld, max. 5 Zeichen, z. B. `"de"`).
2. **User-Modell anpassen** (`$fillable` + ggf. Accessor/Mutator).
3. **Einstellungen-Seite** (Route, Controller, Blade-View).
4. **Sprache in Session speichern** (Middleware oder Controller).
5. **Tests für Sprachwechsel** (Feature-Tests).
6. **Dokumentation in `README.md`** (Kapitel "Adding new application languages").

### **Probleme & Lösungen**
- **Problem:** Einige Blade-Templates nutzen bereits `__('key')`, aber die Sprachdateien fehlten.
  **Lösung:** Sprachdateien `general.php` für alle Sprachen angelegt.
- **Problem:** Dynamische Strings (z. B. `"Welcome, :name!")` erfordern Platzhalter.
  **Lösung:** `@lang('messages.welcome', ['name' => $user->name])` verwendet.