<?php

namespace App\Entity\Group;

use App\Entity\Files\File;
use App\Entity\Interfaces\TimestampedInterface;
use App\Entity\Traits\DataTitleTrait;
use App\Entity\Traits\IdTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * VersionGroup
 *
 * @ORM\Table(name="app_version_group")
 * @ORM\Entity(repositoryClass="FileRepository")
 * @ORM\EntityListeners({
 *  "App\Listener\Entity\TimestampedListener",
 * })
 */

class VersionGroup implements TimestampedInterface
{

    use IdTrait;
    use TimestampableTrait;
    use DataTitleTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Files\File", mappedBy="versionGroup", cascade={"persist"})
     */
    private $files;

    public function addFiles(File $file): self
    {
        $this->files[] = $file;
        return $this;
    }

    public function removeArticle(File $file): self
    {
        $this->files->removeElement($file);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

}