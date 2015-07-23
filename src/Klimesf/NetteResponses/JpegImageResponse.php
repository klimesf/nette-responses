<?php


namespace Klimesf\NetteResponses;

use Nette;
use Nette\Application\IResponse;

/**
 * @package   Klimesf\NetteResponses
 * @author    Filip Klimes <filipklimes@startupjobs.cz>
 */
class JpegImageResponse implements IResponse
{

	/**
	 * @var
	 */
	private $image;

	/**
	 * @var null
	 */
	private $filename;

	/**
	 * @var int
	 */
	private $quality;

	/**
	 * JpegResponse constructor.
	 * @param resource $image <p>
	 * The JPEG image which will be outputed. The resource will be destroyed. In order
	 * to save the image, plase use $filename parameter.
	 * </p>
	 * @param string   $filename [optional] <p>
	 * The path to save the file to. If not set or &null;, the raw image stream
	 * will be outputted directly.
	 * </p>
	 * <p>
	 * To skip this argument in order to provide the
	 * quality parameter, use &null;.
	 * </p>
	 * @param int      $quality  [optional] <p>
	 * quality is optional, and ranges from 0 (worst
	 * quality, smaller file) to 100 (best quality, biggest file). The
	 * default is the default IJG quality value (about 75).
	 * </p>
	 * @see http://php.net/manual/en/function.imagejpeg.php
	 */
	public function __construct($image, $filename = null, $quality = null)
	{
		$this->image = $image;
		$this->filename = $filename;
		$this->quality = $quality;
	}


	/**
	 * Sends response to output.
	 * @param Nette\Http\IRequest  $httpRequest
	 * @param Nette\Http\IResponse $httpResponse
	 * @return void
	 */
	public function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse)
	{
		$httpResponse->setHeader('Content-type', 'image/jpeg');
		imagejpeg($this->image, $this->filename, $this->quality);
		imagedestroy($this->image);
	}

}