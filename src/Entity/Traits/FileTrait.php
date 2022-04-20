<?php


namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait FileTrait
{

    /**
     * @ORM\Column(name="originalName", type="string", length=255)
     */
    private $originalName;

    /**
     * @ORM\Column(name="mimeType", type="string", length=255)
     */
    private $mimeType;

    /**
     * @ORM\Column(name="path", type="text", nullable=true)
     */
    private $path;

    /**
     * @return mixed
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * @param mixed $originalName
     */
    public function setOriginalName($originalName): self
    {
        $this->originalName = $originalName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param mixed $mimeType
     */
    public function setMimeType($mimeType): self
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): self
    {
        $this->path = $path;
        return $this;
    }
}