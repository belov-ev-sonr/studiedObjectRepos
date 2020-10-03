<?php
namespace TestTask\UploaderFile\App\Builder;

use TestTask\UploaderFile\Domain\Entities\File;

class FileBuilder
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

    public function withId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function withRev(string $rev): self
    {
        $this->rev = $rev;
        return $this;
    }

    public function withHash(string $hash): self
    {
        $this->hash = $hash;
        return $this;
    }

    public function build(): File
    {
        $file = File::from(
            $this->id,
            $this->name,
            $this->path,
            $this->rev,
            $this->hash
            );
        $this->reset();

        return $file;
    }

    private function reset(): void
    {
        $this->id = 0;
        $this->name = '';
        $this->path = '';
        $this->rev = 0;
        $this->hash = '';
    }
}
