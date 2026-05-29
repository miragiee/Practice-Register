TODO: UI fixes and small backend improvements

- Fix styles in company profile (responsive spacing, button alignment)
  - Files: [resources/css/company-profile.css](resources/css/company-profile.css#L1-L1), [resources/views/company-profile.blade.php](resources/views/company-profile.blade.php#L1-L1)

- Fix "Подробнее" button in company requests (ensure navigation works)
  - Files: [resources/views/company-request.blade.php](resources/views/company-request.blade.php#L1-L1), [resources/js/company-request.js](resources/js/company-request.js#L1-L1)

- Make calendar clearer and prettier (progress bar, availability colors)
  - Files: [resources/views/company/calendar.blade.php](resources/views/company/calendar.blade.php#L1-L1)

- Add document versioning (DB + model + controller)
  - Files: [database/migrations/2026_05_29_000000_add_version_to_documents_table.php](database/migrations/2026_05_29_000000_add_version_to_documents_table.php#L1-L100), [app/Models/Document.php](app/Models/Document.php#L1-L50), [app/Http/Controllers/DocumentController.php](app/Http/Controllers/DocumentController.php#L1-L50)
