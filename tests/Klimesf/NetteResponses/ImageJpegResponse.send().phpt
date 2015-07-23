<?php


use Nette\Http;

require __DIR__ . '/../bootstrap.php';

test(function () {
	$image = imagecreatefromjpeg(__DIR__ . '/../image.jpg');
	$response = new \Klimesf\NetteResponses\JpegImageResponse($image);
	$response->send(new Http\Request(new \Nette\Http\UrlScript()), $httpResponse = new Http\Response());
	Assert::same('image/jpeg', $httpResponse->getHeader('Content-type'));
});