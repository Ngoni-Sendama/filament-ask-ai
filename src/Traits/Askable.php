<?php

namespace CodewithNgoni\FilamentAskAI\Traits;

use Filament\Forms\Components\Actions\Action;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Set;


trait Askable
{
    protected function askWithAI(string $provider, string $model)
    {
        return $this->hintActions([
            Action::make("askWithAi_{$provider}")
                ->label("Ask with " . ucfirst($provider))
                ->icon('heroicon-m-sparkles')
                ->form([
                    Textarea::make('prompt')
                        ->label('Prompt')
                        ->required(),
                ])
                ->action(function (\Filament\Forms\Set $set, array $data) use ($provider, $model) {
                    $rawEndpoint = config("filament-ask-ai.endpoints.{$provider}");
                    $endpoint = str_replace('{model}', $model, $rawEndpoint);
                    
                    $apiKey   = env(strtoupper($provider) . '_API_KEY');
                    $response = Http::withHeaders([
                        'Authorization' => "Bearer {$apiKey}",
                        'Content-Type'  => 'application/json',
                    ])->post($endpoint, [
                        'model'    => $model,
                        'messages' => [['role' => 'user', 'content' => $data['prompt']]],
                    ]);

                    $content = data_get($response->json(), 'choices.0.message.content', 'No response');
                    $set($this->getName(), $content);
                }),
        ]);
    }
}