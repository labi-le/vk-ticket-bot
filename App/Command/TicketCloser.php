<?php

declare(strict_types=1);

namespace App\Command;

use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Attribute\Message;
use Astaroth\Attribute\MessageRegex;
use Astaroth\Commands\BaseCommands;
use Astaroth\DataFetcher\Events\MessageNew as Data;

#[Conversation(Conversation::CHAT)]
#[MessageNew]
class TicketCloser extends BaseCommands
{
    /**
     * @throws \Throwable
     */
    #[
        /**
         * Поиск предложений по регулярному выражению
         */
        MessageRegex("/[\wа-яА-ЯёЁ\-\s]+\?+/u"),

        /**
         * Слова содержащиеся в начале предложения
         */
        Message("помогите", Message::START_AS), Message("подскажите", Message::START_AS),
        Message("как", Message::START_AS), Message("а как", Message::START_AS),
        Message("почему", Message::START_AS), Message("а почему", Message::START_AS),

        /**
         *  Слова содержащиеся в предложении
         */
        Message("как сделать", Message::CONTAINS),
        Message("не могу", Message::CONTAINS),
        Message("не получается", Message::CONTAINS),
        Message("у меня такая проблема", Message::CONTAINS),

    ]
    public function close(Data $data)
    {
        $sarcasm = [
            "Тикет закрыт", "В данной ситуации я могу только закрыть тикет",
            "Я закрываю тикет", "Тикет закрыт по причине гомосексуальности автора", "Ну нихуя себе, тикет закрыт",
            "/ticket_closed", "Ну и что это за вопрос? Тикет закрыт"
        ];
        $this->message($data->getPeerId(), $sarcasm[array_rand($sarcasm)]);
    }
}
