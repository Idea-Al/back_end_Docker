<?php
// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use App\Entity\Book;

class CreateBookPublication
{
    private $bookPublishingHandler;

    public function __construct(BookPublishingHandler $bookPublishingHandler)
    {
        $this->bookPublishingHandler = $bookPublishingHandler;
    }

    public function __invoke(Book $data): Book
    {
        $this->bookPublishingHandler->handle($data);

        return $data;
    }
}
