<?php

namespace App\Events;

use App\Enums\EmailTemplatesEnum;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Collection;

class TriggerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Collection
     */
    private $receivers;
    /**
     * @var
     */
    private $emailTemplateId;
    /**
     * @var
     */
    private $smsTemplateId;
    /**
     * @var
     */
    private $dataForTemplate;

    /**
     * TriggerEvent constructor.
     * @param array $dataForTemplate
     */
    public function __construct($dataForTemplate = [])
    {
        $this->dataForTemplate = $dataForTemplate;
        $this->receivers = collect();
    }

    /**
     * @param $order
     * @return TriggerEvent
     */
    public static function createOrderCreatedEvent($order)
    {
        return (new self())
            ->addReceiver($order->client->id)
            ->setDataForTemplate([
                'order' => [
                    'id' => $order->id,
                    'phone' => $order->client->phone
                ]
            ])
            ->setEmailTemplateId(EmailTemplatesEnum::ORDER_CREATED);
    }

    /**
     * @param $dataForTemplate
     * @return $this
     */
    public function setDataForTemplate($dataForTemplate)
    {
        $this->dataForTemplate = $dataForTemplate;
        return $this;
    }

    /**
     * @return array
     */
    public function getDataForTemplate()
    {
        return $this->dataForTemplate;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setEmailTemplateId($id)
    {
        $this->emailTemplateId = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailTemplateId()
    {
        return $this->emailTemplateId;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setSmsTemplateId($id)
    {
        $this->smsTemplateId = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmsTemplateId()
    {
        return $this->smsTemplateId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @param $id
     * @return $this
     */
    public function addReceiver($id)
    {
        $this->receivers->push($id);
        return $this;
    }

    /**
     * @return array
     */
    public function getReceivers()
    {
        return $this->receivers->toArray();
    }
}
