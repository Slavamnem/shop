<?php

namespace App\Listeners;

use App\Client;
use App\EmailTemplate;
use App\Events\TriggerEvent;
use App\Jobs\SendEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class TriggerEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TriggerEvent  $event
     * @return void
     */
    public function handle(TriggerEvent $event)
    {
        foreach ($event->getReceivers() as $clientReceiverId) {
            if ($emailTemplateId = $event->getEmailTemplateId()) {
                (new SendEmail(
                    Client::find($clientReceiverId),
                    "Уведомление от MilanShop",
                    $this->renderEmailMessage($event->getEmailTemplateId(), $event->getDataForTemplate())
                ))->handle();
            }

            if ($smsTemplateId = $event->getSmsTemplateId()) {
                // TODO
            }
        }
    }

    /**
     * @param $emailTemplateId
     * @param $dataForTemplate
     * @return string
     */
    private function renderEmailMessage($emailTemplateId, $dataForTemplate)
    {
        return preg_replace_callback(Lang::get('other.template-item-regex'), function ($matches) use($dataForTemplate){
            $items = explode(".", $matches[1]);

            $result = $dataForTemplate[$items[0]];
            for ($i = 1; $i < count($items); $i++){
                $result = $result[$items[$i]];
            }

            return $result;
        }, EmailTemplate::find($emailTemplateId)->template);
    }
}



//                Artisan::call("send-emails", [
//                    '--client_id' => $clientReceiverId,
//                    '--template'  => $event->getEmailTemplateId()
//                ]);
