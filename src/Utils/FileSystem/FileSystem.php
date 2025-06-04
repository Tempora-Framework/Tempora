<?php

namespace Tempora\Utils\FileSystem;

use Exception;

class FileSystem {

	private string $fileName;
	private string $fileExtension;
	private string $filePath;
	private int $filePermissions = 0777;
	private string $fileContent;

	public function __construct(string $filename = null) {
		if ($filename) {
			$this->fileName = pathinfo(path: $filename, flags: PATHINFO_FILENAME);
			$this->fileExtension = pathinfo(path: $filename, flags: PATHINFO_EXTENSION);
			$this->filePath = pathinfo(path: $filename, flags: PATHINFO_DIRNAME);
		}
	}

	public function getHumanRedeablePermissions(): string {
		return substr(string: sprintf('%o', $this->filePermissions), offset: -4);
	}

	public function getFullPath(): string {
		return $this->filePath . DIRECTORY_SEPARATOR . $this->fileName . '.' . $this->fileExtension;
	}

	public function createFile(): void {
		$fullPath = $this->getFullPath();

		if (file_exists(filename: $fullPath))
			throw new Exception(message: "File already exists: $fullPath");

		if (!is_dir(filename: $this->filePath)) {
			try {
				mkdir(directory: $this->filePath, permissions: $this->filePermissions, recursive: true);
			} catch (Exception $e) {
				throw new Exception(message: "Failed to create directory: {$this->filePath}. Error: " . $e->getMessage());
			}
		}

		if (!is_writable(filename: $this->filePath))
			throw new Exception(message: "Directory not writable: {$this->filePath}");
		if (!is_readable(filename: $this->filePath))
			throw new Exception(message: "Directory not readable: {$this->filePath}");
		if (!is_dir(filename: $this->filePath))
			throw new Exception(message: "Path is not a directory: {$this->filePath}");

		file_put_contents(filename: $fullPath, data: $this->fileContent ?? "");
		chmod(filename: $fullPath, permissions: $this->filePermissions ?? 0777);
	}

	public function getFileContent(): string {
		return file_get_contents(filename: $this->getFullPath());
	}

	public function getFileSize(): int {
		$filename = $this->getFullPath();
		if (!file_exists(filename: $filename))
			throw new Exception(message: "File does not exist: $filename");

		return filesize(filename: $filename);
	}

	/**
	 * Get the value of fileName
	 *
	 * @return string
	 */
	public function getFileName(): string {
		return $this->fileName;
	}

	/**
	 * Set the value of fileName
	 *
	 * @param string $fileName
	 *
	 * @return self
	 */
	public function setFileName(string $fileName): self {
		$this->fileName = $fileName;

		return $this;
	}

	/**
	 * Get the value of fileExtension
	 *
	 * @return string
	 */
	public function getFileExtension(): string {
		return $this->fileExtension;
	}

	/**
	 * Set the value of fileExtension
	 *
	 * @param string $fileExtension
	 *
	 * @return self
	 */
	public function setFileExtension(string $fileExtension): self {
		$this->fileExtension = $fileExtension;

		return $this;
	}

	/**
	 * Get the value of filePath
	 *
	 * @return string
	 */
	public function getFilePath(): string {
		return $this->filePath;
	}

	/**
	 * Set the value of filePath
	 *
	 * @param string $filePath
	 *
	 * @return self
	 */
	public function setFilePath(string $filePath): self {
		$this->filePath = $filePath;

		return $this;
	}

	/**
	 * Get the value of filePermissions
	 *
	 * @return int
	 */
	public function getFilePermissions(): int {
		return $this->filePermissions;
	}

	/**
	 * Set the value of filePermissions
	 *
	 * @param int $filePermissions
	 *
	 * @return self
	 */
	public function setFilePermissions(int $filePermissions): self {
		$this->filePermissions = $filePermissions;

		return $this;
	}

	/**
	 * Set the value of fileContent
	 *
	 * @param string $fileContent
	 *
	 * @return self
	 */
	public function setFileContent(string $fileContent): self {
		$this->fileContent = $fileContent;

		return $this;
	}
}
