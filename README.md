# Filament Ask AI: Build AI-powered Filament forms

**Filament Ask AI is a Laravel package that adds AI-powered hint actions to Filament form fields. It integrates with AI models (like Mistral, Gemini, and Claude) to provide a "hint action" in your form fields, allowing users to interact with AI directly within your Laravel Filament forms.**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithngoni/filament-ask-ai)](https://packagist.org/packages/codewithngoni/filament-ask-ai)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/Ngoni-Sendama/filament-ask-ai/Tests)](https://github.com/Ngoni-Sendama/filament-ask-ai/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithngoni/filament-ask-ai)](https://packagist.org/packages/codewithngoni/filament-ask-ai)

## Installation

To install the package, run the following command:

```bash
composer require codewithngoni/filament-ask-ai
```

## Usage

After installing, run the package installation command:

```bash
php artisan vendor:publish --tag=filament-ask-ai-config
```

This command will:

Publish the configuration file for Filament AI settings.

Publish the configuration file for openai-php/laravel settings.

Create a symbolic link for storage.

We use Gemini and Mistral for API keys. Add the following to your .env file:

```bash
MISTRAL_API_KEY=your_mistral_api_key
GEMINI_API_KEY=your_gemini_api_key
```

## Configuration

You can configure the AI keys by modifying the config/filament-ask-ai.php file. Ensure that the correct API keys for Mistral, Gemini, and Claude are set.

## Usage for Developers

Adding AI to Built-in Filament Form Fields
You can add AI generation capabilities to TextInput, Textarea, and RichEditor fields using the AskMistral(), AskGemini(), or AskClaude() methods:

Without Options

```php
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;

TextInput::make('title')
    ->AskMistral()

Textarea::make('description')
    ->AskGemini()

```

With Options

```php
TextInput::make('title')
    ->AskMistral([
        'model' => 'mistral-large-latest',
        'temperature' => 0.7,
    ])

Textarea::make('description')
    ->AskGemini([
        'model' => 'gemini-2.0-flash',
        'max_tokens' => 200,
    ])

RichEditor::make('content')
    ->AskClaude([
        'model' => 'claude-2',
        'temperature' => 0.8,
    ])

```

## Credits

- Ngoni Sendama [CodeWithNgoni](https:/www.codewithngoni.com)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
