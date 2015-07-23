<?php


namespace Klimesf\NetteResponses;

use Nette;
use Nette\Application\IResponse;

/**
 * @package   Klimesf\NetteResponses
 * @author    Filip Klimes <filipklimes@startupjobs.cz>
 */
class PdfResponse implements IResponse
{

	/**
	 * @var string
	 */
	private $filePath;

	/**
	 * PdfResponse constructor.
	 * @param string $filePath Path to the PDF file.
	 */
	public function __construct($filePath)
	{
		$this->filePath = $filePath;
	}

	/**
	 * Sends response to output.
	 * @param Nette\Http\IRequest  $httpRequest
	 * @param Nette\Http\IResponse $httpResponse
	 */
	function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse)
	{
		$httpResponse->setContentType('application/pdf');
		$httpResponse->setHeader('Content-Disposition', 'inline; filename="' . basename($this->filePath) . '"');
		$httpResponse->setHeader('Content-Description', 'File Transfer');
		$httpResponse->setHeader('Connection', 'Keep-Alive');
		$httpResponse->setHeader('Expires', '0');
		$httpResponse->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
		$httpResponse->setHeader('Pragma', 'public');
		$httpResponse->setHeader('Content-Length', filesize($this->filePath));
		readfile($this->filePath);
	}

}