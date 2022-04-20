<?php

namespace App\Entity\Files;

use App\Entity\Interfaces\TimestampedInterface;
use App\Entity\Traits\DataTitleTrait;
use App\Entity\Traits\FileTrait;
use App\Entity\Traits\IdTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * FilesStatic
 *
 * @ORM\Table(name="app_images")
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 * @ORM\EntityListeners({
 *  "App\Listener\Entity\TimestampedListener",
 * })
 */

class Images implements TimestampedInterface
{

    use IdTrait;
    use DataTitleTrait;
    use TimestampableTrait;
    use FileTrait;

}