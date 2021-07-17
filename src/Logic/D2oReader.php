<?php


namespace App\Logic;


class D2oReader
{
	/**
	 * Position actuelle sur le stream
	 * @var int
	 */
	private $position;

	/**
	 * Ressource stream
	 */
	private $stream;

	public function setStream($stream)
	{
		$this->stream = $stream;
	}

	public function setPosition(int $position)
	{
		$this->position = $position;
	}

	public function getPosition(): int
	{
		return $this->position;
	}

	public function readBool(): bool
	{
		$raw = unpack('C', strrev(stream_get_contents($this->stream, 1, $this->position)))[1];
		$this->position++;
		return $raw;
	}

	public function readAscii(int $nbBytes): string
	{
		$binary = stream_get_contents($this->stream, $nbBytes, $this->position);
		$this->position += $nbBytes;
		return $binary;
	}

	public function readInt(): int
	{
		$raw = unpack('l', strrev(stream_get_contents($this->stream, 4, $this->position)))[1];
		$this->position += 4;
		return $raw;
	}

	public function readUtf8(): string
	{
		$len = $this->readUShort();
		$res = $this->readAscii($len);
		return $res;
	}

	public function readUShort()
	{
		$raw = unpack('n', stream_get_contents($this->stream, 2, $this->position))[1];
		$this->position += 2;
		return $raw;
	}

	public function readDouble()
	{
		$raw = unpack('E', stream_get_contents($this->stream, 8, $this->position))[1];
		$this->position += 8;
		return $raw;
	}

	public function readUInt()
	{
		$raw = unpack('N', stream_get_contents($this->stream, 4, $this->position))[1];
		$this->position += 4;
		return $raw;
	}

}