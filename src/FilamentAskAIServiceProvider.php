<?php

namespace CodewithNgoni\FilamentAskAI;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use CodewithNgoni\FilamentAskAI\Traits\Askable;
use Filament\Notifications\Notification;

class FilamentAskAIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/Config/filament-ask-ai.php' => config_path('filament-ask-ai.php'),
        ], 'filament-ask-ai-config');

        // Register macros
        foreach ([TextInput::class, Textarea::class, RichEditor::class, MarkdownEditor::class] as $component) {
            $component::macro('AskMistral', function (string $model = 'mistral-large-latest') {
                return $this->askWithAI('mistral', $model);
            });
            $component::macro('AskGemini', function (string $model = 'gemini-2.0-flash') {
                return $this->askWithAI('gemini', $model);
            });
           
        }

        // Mixin the Askable trait
        TextInput::mixin(new Askable());
        Textarea::mixin(new Askable());
        RichEditor::mixin(new Askable());
        MarkdownEditor::mixin(new Askable());
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/filament-ask-ai.php',
            'filament-ask-ai'
        );

        // Notify missing API keys
        foreach (['mistral', 'gemini'] as $provider) {
            $key = config("filament-ask-ai.keys.{$provider}");
            if (empty($key)) {
                Notification::make()
                    ->title("Missing {$provider} API Key")
                    ->warning()
                    ->send();
            }
        }
    }
}
