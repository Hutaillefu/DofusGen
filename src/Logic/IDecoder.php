<?php


namespace App\Logic;


interface IDecoder
{
	/**
	 * Initialise stream resource
	 */
	public function begin(string $filename);

	/**
	 * Release stream resource
	 */
	public function end();

	/**
	 * Initialise index Table
	 */
	public function initIndexTable();

	/**
	 * Get the index table
	 */
	public function getIndexTable(): array;

	/**
	 * @param int $id
	 * @return array
	 */
	public function searchById(int $id): array;
}