<?php

declare(strict_types=1);

namespace App\Command;

use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Attribute\Message;
use Astaroth\Commands\BaseCommands;
use Astaroth\DataFetcher\Events\MessageNew as Data;

#[Conversation(Conversation::PERSONAL_DIALOG)]
#[MessageNew]
class Notice extends BaseCommands
{
    /**
     * @throws \Throwable
     */
    #[Message("", Message::CONTAINS)]
    public function iWorkOnlyChat(Data $data): void
    {
        $this->message($data->getPeerId(), "Я работаю только в беседах!\nТикет закрыт");
    }
}