<?php
namespace TestTask\UploaderFile\Domain\Entities;

class File
{
    /** @var int */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $path;
    /** @var int */
    private $rev;
    /** @var string */
    private $hash;

    /**
     * File constructor.
     */
    private function __construct()
    {
    }

    public static function fromArray(array $data): self
    {
        $file = new self();
        $file->id = (int)$data['id'];
        $file->name = (string)$data['name'];
        $file->path = (string)$data['path'];
        $file->rev = (int)$data['rev'];
        $file->hash = (string)$data['hash'];

        return $file;
    }

    public static function from(int $id, string $name, string $path, string $rev, string $hash): self
    {
        $file = new self();
        $file->id = $id;
        $file->name = $name;
        $file->path = $path;
        $file->rev = $rev;
        $file->hash = $hash;

        return $file;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getRev(): int
    {
        return $this->rev;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }
}
