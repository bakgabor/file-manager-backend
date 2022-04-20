<?php

namespace App\Entity\Files;

use App\Entity\Interfaces\TimestampedInterface;
use App\Entity\Traits\FileTrait;
use App\Entity\Traits\IdTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FilesStatic
 *
 * @ORM\Table(name="app_simple_file")
 * @ORM\Entity(repositoryClass="App\Repository\SimpleFileRepository")
 * @ORM\EntityListeners({
 *  "App\Listener\Entity\TimestampedListener",
 * })
 */

class SimpleFile implements TimestampedInterface
{

    use IdTrait;
    use TimestampableTrait;
    use FileTrait;

}