<?php

declare(strict_types=1);

namespace App\Card\Storage;

use App\Card\Factory\CardFactoryInterface;

class YamlCardStorage implements CardStorageInterface
{
    private $cardFactory;
    private $cardsData;

    public function __construct(CardFactoryInterface $cardFactory, array $cardsData)
    {
        $this->cardFactory = $cardFactory;
        $this->cardsData = $cardsData;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): \Generator
    {
        foreach ($this->cardsData as $cardData) {
            yield $this->cardFactory->createFromData($cardData);
        }
    }
}
