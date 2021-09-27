<?php

declare(strict_types=1);

namespace App\Command;

use Astaroth\Attribute\Action;
use Astaroth\Attribute\Conversation;
use Astaroth\Attribute\Event\MessageNew;
use Astaroth\Commands\BaseCommands;
use Astaroth\DataFetcher\Events\MessageNew as Data;
use Astaroth\Support\Facades\Request;

#[Conversation(Conversation::CHAT)]
#[MessageNew]
class Actions extends BaseCommands
{
    #[Action(Action::CHAT_UNPIN_MESSAGE)]
    public function unpin(Data $data): void
    {
        $this->message($data->getPeerId(), "Не важно что ты закрепил - важно что тикет закрыт");
    }

    #[Action(Action::CHAT_PIN_MESSAGE)]
    public function pin(Data $data): void
    {
        $this->message($data->getPeerId(), "Этот закреп достоин хлопка жопой. Тикет закрыт");
    }

    #[Action(Action::CHAT_CREATE)]
    public function chatCreate(Data $data): void
    {
        $this->message($data->getPeerId(), "Ахуеть спасибо папаша");
    }

    #[
        Action(Action::CHAT_INVITE_USER),
        Action(Action::CHAT_INVITE_USER_BY_LINK)
    ]
    public function invite(Data $data): void
    {
        $botId = current(Request::call("groups.getById"))["id"] ?? 0;
        $memberId = $data->getAction()->member_id ?? null;
        if (-$botId === $memberId) {
            $message = "♂ Dungeon Ticket Master ♂ приветствует тебя ♂ slave-нёнок ♂ \n\n♂ Master ♂ ждёт доступ к переписке и ♂ three hundred bucks ♂";
            $attachments[] = "doc259166248_570145956_fc7995fc04e39c3fd7";
        } else {
            $messages =
                [
                    "Добро пожаловать в ♂ cumюнити ♂, первое правило gay club - ♂ suck some dick ♂",
                    "Привет ♂ fucking slave ♂, как дела в ♂ gym ♂?",
                    "Ещё один ♂ fucking slave ♂ пришёл ♂ gym ♂"
                ];

            $message = $messages[array_rand($messages)];
            $attachments[] = "photo-190405359_457242070_caa05edd978ea30f9c";
        }

        $this->message(
            $data->getPeerId(),
            $message,
            $attachments,
        );
    }

    #[Action(Action::CHAT_KICK_USER)]
    public function kickUser(Data $data): void
    {
        $initiatorId = $data->getFromId();
        $idExitOrKicked = $data->getAction()->member_id ?? null;

        if ($initiatorId === $idExitOrKicked) {
            $message = "Ну вышел и вышел, чо бубнить. Тикет закрыт";
        } else {
            $message = "А когда это для кика нужна была причина? Тикет закрыт";
        }

        $this->message($data->getPeerId(), $message);
    }

    #[Action(Action::CHAT_PHOTO_UPDATE)]
    public function photoUpdate(Data $data): void
    {
        $this->message($data->getPeerId(), "Картинка со звуком. Тикет закрыт");
    }

    #[Action(Action::CHAT_PHOTO_REMOVE)]
    public function photoRemove(Data $data): void
    {
        $this->message($data->getPeerId(), "Картинка без звука. Тикет закрыт");
    }

    #[Action(Action::CHAT_TITLE_UPDATE)]
    public function titleUpdate(Data $data): void
    {
        $this->message($data->getPeerId(), "Классное название. Тикет закрыт");
    }
}