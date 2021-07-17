<?php


namespace App\Logic;


class D2iDecoder implements IDecoder
{
	private $filename;
	private $reader;
	private $stream;

	private $indexTable;

	public function __construct(string $filename = "")
	{
		$this->reader = new D2oReader();
		$this->filename = $filename;

		$this->indexTable = [];
	}

	public function getIndexTable(): array
	{
		return $this->indexTable;
	}

	public function begin(string $filename)
	{
		$this->filename = $filename;
		$this->stream = fopen($this->filename, 'r');
	}

	public function end()
	{
		fclose($this->stream);
	}

	public function initIndexTable()
	{
		$this->reader->setStream($this->stream);
		$this->reader->setPosition(0);

		$dataSize = $this->reader->readInt();
		$this->reader->setPosition($dataSize);
		$sizeIndex = $this->reader->readInt();

		$this->readObjectPointerTable($dataSize, $sizeIndex);
	}

	public function searchById(int $id): array
	{
		$res = [];
		$info = $this->indexTable[$id];

		$this->reader->setPosition($info['strPtr']);
		$res[] = $this->reader->readUtf8();

		if ($info['hasDiacritical']) {
			$this->reader->setPosition($info['diaPtr']);
			$res[] = $this->reader->readUtf8();
		}

		return $res;
	}

	private function readObjectPointerTable(int $dataSize, int $sizeIndex)
	{
		while ($this->reader->getPosition() < $dataSize + $sizeIndex) {

			$id = $this->reader->readInt();
			$hasDiacritical = $this->reader->readBool();
			$valIdx = $this->reader->readInt();

			if ($hasDiacritical) {
				$diaIxd = $this->reader->readInt();
			}

			$this->indexTable[$id] = [
				'hasDiacritical' => $hasDiacritical,
				'strPtr' => $valIdx,
				'diaPtr' => $diaIxd ?? null
			];

		}
	}
}