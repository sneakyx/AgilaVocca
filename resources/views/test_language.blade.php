<!DOCTYPE html>
<html>
<head>
    <title>{{ __('settings.language-settings') }}</title>
</head>
<body>
    <h1>{{ __('settings.language-settings') }}</h1>
    
    <form method="POST" action="{{ url('/settings/language') }}">
        @csrf
        @method('PUT')
        
        <select name="native_language">
            <option value="de">Deutsch</option>
            <option value="en">English</option>
            <option value="fr">Français</option>
            <option value="es">Español</option>
        </select>
        
        <button type="submit">{{ __('settings.save') }}</button>
    </form>
</body>
</html>