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
 * @ORM\Table(name="app_files")
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 * @ORM\EntityListeners({
 *  "App\Listener\Entity\TimestampedListener",
 * })
 */

class File implements TimestampedInterface
{

    use IdTrait;
    use DataTitleTrait;
    use TimestampableTrait;
    use FileTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group\VersionGroup", inversedBy="files")
     * @ORM\JoinColumn(name="version_group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $versionGroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group\FileGroup", inversedBy="files")
     * @ORM\JoinColumn(name="file_group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $fileGroup;

}