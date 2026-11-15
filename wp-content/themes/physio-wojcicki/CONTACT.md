# Kontaktformular

Die Kontaktseite verwendet **Contact Form 7**. Unter **Formulare → Kontakt – Physiotherapie Wojcicki** sind Felder, Meldungen und E-Mail-Einstellungen bearbeitbar. Empfänger ist zunächst `info@physiotherapie-wojcicki.de`, Antworten gehen an die eingegebene Besucheradresse.

## Einrichtung auf einer weiteren Installation

Contact Form 7 und das Theme aktivieren, danach im WordPress-Verzeichnis ausführen:

```sh
php bin/setup-contact-form.php
php bin/test-contact-form.php
php bin/test-contact-form.php empty
php bin/test-contact-form.php invalid-email
php bin/test-contact-form.php valid
```

Die Einrichtung erstellt ein eigenes Formular, ohne andere Formulare zu verändern. Wiederholte Ausführung überschreibt keine Backend-Änderungen. Die Zuordnung zur Kontaktseite erfolgt über den internen Slug `physio-kontakt`, nicht über eine fest codierte Datenbank-ID. Wird das Formular gelöscht oder das Plugin deaktiviert, zeigt die Seite stattdessen einen Hinweis auf Telefon und E-Mail.

Tailwind übernimmt Layout und Grundgestaltung. Für Formularfelder nur einfache Klassen in den CF7-Tags verwenden: Contact Form 7 entfernt Sonderzeichen in Klassennamen. Fokuszustände und Plugin-Meldungen sind deshalb in `style.css` auf das Kontaktformular begrenzt.

Rückmeldungen sind unter **Formulare → Kontakt – Physiotherapie Wojcicki → Meldungen** bearbeitbar. Erfolg erscheint auf Mint, Eingabehinweise auf Creme und Versandfehler auf hellem Terrakotta. Neue Formulare erhalten die angepassten deutschen Texte automatisch. Bei bestehenden Installationen übernimmt `php bin/setup-contact-form.php --update-messages` diese Texte einmalig; dabei werden die entsprechenden Meldungstexte ersetzt, Felder und E-Mail-Einstellungen bleiben unverändert. Ohne diese Option bleiben eigene Texte erhalten.

Der initiale Absender entspricht dem Contact-Form-7-Standard auf der jeweiligen Website-Domain. Vor Livebetrieb den tatsächlichen E-Mail-Eingang prüfen und gegebenenfalls Absenderpostfach, SMTP sowie SPF/DKIM für die Domain einrichten. Die automatisierten Prüfungen versenden keine E-Mails; im Testfall `valid` wird nach erfolgreicher Eingabeprüfung vor dem Versand gestoppt.