<?php

namespace App\Handler;
use Illuminate\Http\Request;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\Exceptions\InvalidConfig as WebhookFailed;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;

class PaystackWebhookSignature implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->header($config->signatureHeaderName);
        if(!$signature) return false;

        $signingSecret = $config->signingSecret;
        if(empty($signingSecret)) throw WebhookFailed::signingSecretNotSet();

        $computedSignature = hash_hmac('sha512', $request->getContent(), $signingSecret);

        return hash_equals($signature, $computedSignature);
    }
}